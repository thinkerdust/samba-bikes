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
use Illuminate\Support\Facades\Mail;
use App\Mail\SendEmailRegistrasi;
use Carbon\Carbon;
use Yajra\DataTables\DataTables;
use App\Exports\PesertaExport;
use Maatwebsite\Excel\Facades\Excel;
use App\Models\Peserta;
use App\Models\Event;

class PesertaController extends BaseController
{
    protected $peserta;

    function __construct(Peserta $peserta, Event $event)
    {
        $this->peserta = $peserta;
        $this->event = $event;
    }

    public function index()
    {
        $title  = 'Peserta';
        $js     = 'assets/js/apps/peserta/index.js?_='.rand();
        return view('peserta.index', compact('js', 'title'));
    }

    public function datatable_peserta(Request $request)
    {
        $event  = $request->event;
        $status = $request->status;
        $data   = $this->peserta->dataTablePeserta($event, $status); 
        return Datatables::of($data)->addIndexColumn()
            ->addColumn('action', function($row) {
                $btn = '';
                if(Gate::allows('crudAccess', 'PESERTA', $row)) {
                    $btn = '<div class="drodown">
                                <a href="#" class="dropdown-toggle btn btn-icon btn-trigger" data-bs-toggle="dropdown"><em class="icon ni ni-more-h"></em></a>
                                <div class="dropdown-menu dropdown-menu-end">
                                    <ul class="link-list-opt no-bdr">
                                        <li><a class="btn" onclick="detailOrEdit(\'' . $row->id . '\')"><em class="icon ni ni-eye"></em><span>Detail / Edit</span></a></li>
                                        <li><a class="btn" onclick="resendEmail(\'' . $row->id_event . '\', \'' . $row->nomor_order . '\', \'' . $row->email . '\')"><em class="icon ni ni-mail"></em><span>Resend Email</span></a></li>
                                    </ul>
                                </div>
                            </div>';
                }
                return $btn;
            })
            ->make(true);
    }

    public function edit_peserta(Request $request) 
    {
        $id     = $request->id;
        $data   = $this->peserta->editPeserta($id);

        return $this->ajaxResponse(true, 'Success!', $data);
    }

    public function store_peserta(Request $request)
    {
        $id             = $request->input('id');
        $id_komunitas   = $request->input('id_komunitas');

        $rulePersonal   = empty($id_komunitas) ? 'required' : 'nullable';   
        $ruleKomunitas  = $id_komunitas ? 'required' : 'nullable';  

        $validator = Validator::make($request->all(), [
            'nama'                  => 'required|max:255',
            'nama_komunitas'        => $ruleKomunitas . '|max:255',
            'phone'                 => $rulePersonal . '|max:20',
            'telp_emergency'        => 'required|max:20',
            'hubungan_emergency'    => 'required|max:100',
            'email'                 => 'required|email|max:255',
            'nik'                   => 'required|max:255',
            'kota'                  => $rulePersonal . '|max:100',
            'tanggal_lahir'         => 'required',
            'blood'                 => 'required',
            'gender'                => 'required',
            'alamat'                => $rulePersonal,
        ], validation_message());

        if($validator->stopOnFirstFailure()->fails()){
            return $this->ajaxResponse(false, $validator->errors()->first());        
        }

        $user = Auth::user();

        try {
            DB::beginTransaction();

            $data = [
                'nama'                  => $request->nama,
                'telp_emergency'        => $request->telp_emergency,
                'hubungan_emergency'    => $request->hubungan_emergency,
                'nik'                   => $request->nik,
                'kota'                  => $request->kota,
                'tgl_lahir'             => $request->tanggal_lahir,
                'blood'                 => $request->blood,
                'gender'                => $request->gender,
                'size_jersey'           => $request->size_jersey,
                'alamat'                => $request->alamat,
                'update_at'             => Carbon::now(),
                'update_by'             => $user->id
            ];

            if(empty($id_komunitas)) {
                $data['nama_komunitas'] = $request->nama_komunitas;
                $data['email'] = $request->email;
                $data['phone'] = $request->phone;
            }

            DB::table('peserta')->updateOrInsert(
                ['id' => $id],
                $data
            );

            if(!empty($id_komunitas)) {
                DB::table('komunitas')->where('id', $id_komunitas)->update(['nama' => $request->nama_komunitas, 'email' => $request->email, 'phone' => $request->phone, 'update_by' => $user->id, 'update_at' => Carbon::now()]);
            }

            DB::table('order')->where('nomor', $request->nomor_order)->update(['email' => $request->email,'update_by' => $user->id, 'update_at' => Carbon::now()]);

            DB::commit();
            return $this->ajaxResponse(true, 'Data berhasil disimpan');
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            DB::rollback();
            return $this->ajaxResponse(false, 'Data gagal disimpan', $e);
        }
    }

    public function export_peserta(Request $request)
    {
        $event  = $request->id;
        $status = $request->status;
        return Excel::download(new PesertaExport($event, $status), 'data_peserta.xlsx');
    }

    public function resend_email(Request $request)
    {
        $recipientMail = $request->email;
        $idEvent = $request->id_event;
        $nomorOrder = $request->nomor_order;
        $event = Event::findOrFail($idEvent);

        try {
            
            $dataEmail = [
                'nomor_order'   => $nomorOrder,
                'event'         => $event->nama,
                'email'         => $event->email
            ];

            Mail::to($recipientMail)->send(new SendEmailRegistrasi($dataEmail));
            return $this->ajaxResponse(true, 'Resend Email Berhasil!');
        } catch (\Throwable $e) {
            Log::error('Resend Email Regist Error: ' . $e->getMessage());
            return $this->ajaxResponse(false, 'Resend Email Gagal : '. $e->getMessage());
        }
    }
}
