<?php

namespace App\Http\Controllers;

use App\Http\Controllers\BaseController as BaseController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use App\Mail\SendEmailPembayaran;
use App\Models\Order;
use Carbon\Carbon;
use Yajra\DataTables\DataTables;

class OrderController extends BaseController
{
    protected $order;

    function __construct(Order $order)
    {
        $this->order = $order;
    }

    public function index()
    {
        $title  = 'Order';
        $js     = 'assets/js/apps/order/index.js?_='.rand();
        return view('order.index', compact('js', 'title'));
    }

    public function datatable_order(Request $request)
    {
        $start_date = $request->start_date;
        $end_date   = $request->end_date;
        $event      = $request->event;

        $data = $this->order->dataTableOrder($start_date, $end_date, $event); 

        return Datatables::of($data)->addIndexColumn()
            ->addColumn('action', function($row) {
                $btn = '';
                if(Gate::allows('crudAccess', 'ORDER', $row)) {
                    $btn_delete = '<li><a class="btn" onclick="hapus(\'' . $row->nomor . '\')"><em class="icon ni ni-trash"></em><span>Hapus</span></a></li>';
                    $btn_payment = '<li><a class="btn" onclick="payment(\'' . $row->nomor . '\')"><em class="icon ni ni-money"></em><span>Payment</span></a></li>';
                    $btn_racepack = '<li><a href="/admin/order/racepack?nomor='.$row->nomor.'" class="btn"><em class="icon ni ni-package"></em></em><span>Racepack</span></a></li>';
                    $btn_action = '';

                    if($row->status == 1) {
                        $btn_action .= $btn_delete . ' ' . $btn_payment;
                    }elseif($row->status == 2) {
                        $btn_action .= $btn_racepack;
                    }

                    $btn = '<div class="drodown">
                                <a href="#" class="dropdown-toggle btn btn-icon btn-trigger" data-bs-toggle="dropdown"><em class="icon ni ni-more-h"></em></a>
                                <div class="dropdown-menu dropdown-menu-end">
                                    <ul class="link-list-opt no-bdr">
                                        <li><a class="btn" onclick="detail(\'' . $row->nomor . '\')"><em class="icon ni ni-eye"></em><span>Detail</span></a></li>
                                        ' . $btn_action . '
                                    </ul>
                                </div>
                            </div>';
                }
                return $btn;
            })
            ->make(true);
    }

    public function detail_order(Request $request) 
    {
        $nomor  = $request->nomor;
        $data   = $this->order->detailOrder($nomor);

        return Datatables::of($data)->addIndexColumn()->make(true);
    }

    public function edit_order(Request $request) 
    {
        $nomor  = $request->nomor;
        $data   = Order::where('nomor', $nomor)->first();

        return $this->ajaxResponse(true, 'Success!', $data);
    }

    public function delete_order(Request $request)
    {
        try {
            DB::beginTransaction();

            $nomor  = $request->nomor;
            $user   = Auth::user();
            $order  = Order::where('nomor', $nomor)->first();

            $order->update(['status' => 0, 'update_at' => Carbon::now(), 'update_by' => $user->username]);

            DB::commit();
            return $this->ajaxResponse(true, 'Data berhasil dihapus');
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            DB::rollback();
            return $this->ajaxResponse(false, 'Data gagal dihapus', $e);
        }
    }

    public function payment_order(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'id_order'  => 'required',
            'tanggal_bayar' => 'required',
        ], validation_message());

        if($validator->stopOnFirstFailure()->fails()){
            return $this->ajaxResponse(false, $validator->errors()->first());        
        }

        try {  
            DB::beginTransaction(); 

            $id    = $request->id_order;
            $email = $request->email;
            $user  = Auth::user();

            $tanggal_bayar = Carbon::createFromFormat('d/m/Y', $request->tanggal_bayar);
            $tanggal_bayar = $tanggal_bayar->format('Y-m-d');

            $dataEmail = [
                'nomor_order' => $id,
            ];

            DB::table('order')->where('id', $id)->update(['status' => 2, 'tanggal_bayar' => $tanggal_bayar, 'approve_at' => Carbon::now(), 'approve_by' => $user->id]);

            DB::commit();

            try {

                Mail::to($email)->send(new SendEmailPembayaran($dataEmail));
    
            } catch (\Throwable $e) {
                Log::error($e->getMessage());
            }

            return $this->ajaxResponse(true, 'Data berhasil di-konfirmasi');
        } catch (\Exception $e) {   
            Log::error($e->getMessage());
            DB::rollback();
            return $this->ajaxResponse(false, 'Data gagal di-konfirmasi', $e);
        }
    }

    public function racepack(Request $request)
    {
        $nomor  = $request->nomor;
        $order  = Order::where('nomor', $nomor)->exists();
        if($order) {
            $title  = 'Pengambilan Racepack';
            $js     = 'assets/js/apps/order/racepack.js?_='.rand();
            return view('order.racepack', compact('js', 'title', 'nomor'));
        }

        abort(404);
    }

    public function datatable_racepack(Request $request)
    {
        $nomor = $request->nomor;
        $data = $this->order->dataTableRacepackOrder($nomor);
        return Datatables::of($data)->addIndexColumn()->make(true);
    }

    public function store_racepack(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'id_order_detail'   => 'required',
            'tanggal'           => 'required',
            'nama'              => 'required',
        ], validation_message());

        if($validator->stopOnFirstFailure()->fails()){
            return $this->ajaxResponse(false, $validator->errors()->first());        
        }

        try {  
            DB::beginTransaction();

            $id      = explode(',', $request->id_order_detail);
            $nama    = $request->nama;
            $tanggal = Carbon::createFromFormat('d/m/Y', $request->tanggal);
            $tanggal = $tanggal->format('Y-m-d');

            DB::table('order_detail')->whereIn('id', $id)->update(['racepack_at' => $tanggal, 'racepack_by' => $nama]);

            DB::commit();
            return $this->ajaxResponse(true, 'Data berhasil disimpan');
        } catch (\Exception $e) {   
            Log::error($e->getMessage());
            DB::rollback();
            return $this->ajaxResponse(false, 'Data gagal disimpan', $e);
        }
    }
}
