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
use App\Models\Order;
use Carbon\Carbon;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\Storage;

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
                    if($row->status == 1) {
                        $btn = '<div class="drodown">
                                <a href="#" class="dropdown-toggle btn btn-icon btn-trigger" data-bs-toggle="dropdown"><em class="icon ni ni-more-h"></em></a>
                                <div class="dropdown-menu dropdown-menu-end">
                                    <ul class="link-list-opt no-bdr">
                                        <li><a class="btn" onclick="konfirmasi(' . $row->id . ')"><em class="icon ni ni-send"></em><span>Konfirmasi</span></a></li>
                                        <li><a class="btn" onclick="detail(\'' . $row->id . '\')"><em class="icon ni ni-eye"></em><span>Detail</span></a></li>
                                        <li><a class="btn" onclick="hapus(\'' . $row->id . '\')"><em class="icon ni ni-trash"></em><span>Hapus</span></a></li>
                                    </ul>
                                </div>
                            </div>';
                    } else {
                        $btn = '<div class="drodown">
                                <a href="#" class="dropdown-toggle btn btn-icon btn-trigger" data-bs-toggle="dropdown"><em class="icon ni ni-more-h"></em></a>
                                <div class="dropdown-menu dropdown-menu-end">
                                    <ul class="link-list-opt no-bdr">
                                        <li><a class="btn" onclick="detail(\'' . $row->id . '\')"><em class="icon ni ni-eye"></em><span>Detail</span></a></li>
                                        <li><a class="btn" onclick="hapus(\'' . $row->id . '\')"><em class="icon ni ni-trash"></em><span>Hapus</span></a></li>
                                    </ul>
                                </div>
                            </div>';
                    }
                }
                return $btn;
            })
            ->make(true);
    }

    public function detail_order(Request $request) 
    {
        $id     = $request->id;
        $data   = $this->order->detailOrder($id);

        return Datatables::of($data)->addIndexColumn()->make(true);
    }

    public function edit_order(Request $request) 
    {
        $id     = $request->id;
        $data   = $this->order->editOrder($id);

        return $this->ajaxResponse(true, 'Success!', $data);
    }

    public function delete_order(Request $request)
    {
        try {
            DB::beginTransaction();

            $id     = $request->id;
            $user   = Auth::user();

            // get nomor_order
            $nomor_order = DB::table('order')->where('id', $id)->value('nomor');

            // set status order to 0 (non-aktif)
            DB::table('order')->where('id', $id)->update(['status' => 0]);

            // set status order detail to 0 (non-aktif)
            DB::table('order_detail')->where('nomor_order', $nomor_order)->update(['status' => 0]);

            DB::commit();
            return $this->ajaxResponse(true, 'Data berhasil dihapus');
        } catch (\Exception $e) {
            dd($e);
            Log::error($e->getMessage());
            DB::rollback();
            return $this->ajaxResponse(false, 'Data gagal dihapus', $e);
        }
    }

    public function konfirmasi_order(Request $request)
    {
        try {   

            // validasi
            $validator = Validator::make($request->all(), [
                'id_order'  => 'required',
                'tgl_bayar' => 'required',
            ]);

            if ($validator->fails()) {
                return $this->ajaxResponse(false, 'Data tidak valid', $validator->errors());
            }

            $id         = $request->id_order;
            $tgl_bayar  = $request->tgl_bayar;
            $user       = Auth::user();

            DB::table('order')->where('status', 1)->where('id', $id)->update(['status' => 2, 'tanggal_bayar' => $tgl_bayar, 'approve_at' => Carbon::now(), 'approve_by' => $user->id]);

            return $this->ajaxResponse(true, 'Data berhasil di-konfirmasi');
        } catch (\Exception $e) {   
            Log::error($e->getMessage());
            DB::rollback();
            return $this->ajaxResponse(false, 'Data gagal di-release', $e);
        }
    }
}
