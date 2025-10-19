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
use App\Models\Peserta;
use Carbon\Carbon;
use Yajra\DataTables\DataTables;

class PesertaController extends BaseController
{
    protected $peserta;

    function __construct(Peserta $peserta)
    {
        $this->peserta = $peserta;
    }

    public function index()
    {
        $title  = 'Peserta';
        $js     = 'assets/js/apps/peserta/index.js?_='.rand();
        return view('peserta.index', compact('js', 'title'));
    }

    public function datatable_peserta(Request $request)
    {
        $event = $request->event;
        $data = $this->peserta->dataTablePeserta($event); 
        return Datatables::of($data)->addIndexColumn()
            ->addColumn('action', function($row) {
                $btn = '';
                if(Gate::allows('crudAccess', 'PESERTA', $row)) {
                    $btn = '<div class="drodown">
                                <a href="#" class="dropdown-toggle btn btn-icon btn-trigger" data-bs-toggle="dropdown"><em class="icon ni ni-more-h"></em></a>
                                <div class="dropdown-menu dropdown-menu-end">
                                    <ul class="link-list-opt no-bdr">
                                        <li><a class="btn" onclick="detailOrEdit(\'' . $row->id . '\')"><em class="icon ni ni-eye"></em><span>Detail / Edit</span></a></li>
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
            'email'                 => $rulePersonal . '|email|max:255',
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
                'nama_komunitas'        => $request->nama_komunitas,
                'phone'                 => $request->phone,
                'telp_emergency'        => $request->telp_emergency,
                'hubungan_emergency'    => $request->hubungan_emergency,
                'email'                 => $request->email,
                'nik'                   => $request->nik,
                'kota'                  => $request->kota,
                'tgl_lahir'             => $request->tanggal_lahir,
                'blood'                 => $request->blood,
                'gender'                => $request->gender,
                'size_jersey'           => $request->size_jersey,
                'alamat'                => $request->alamat,
            ];

            if(!empty($id)) {
                $data['update_at']  = Carbon::now();
                $data['update_by']  = $user->id;
            } else {
                $data['insert_at']  = Carbon::now();
            }

            DB::table('peserta')->updateOrInsert(
                ['id' => $id],
                $data
            );

            $dataOrder = DB::table('order_detail')->where('id_peserta', $id)->first();

            if($dataOrder) {
                
            }

            DB::commit();
            return $this->ajaxResponse(true, 'Data berhasil disimpan');
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            DB::rollback();
            return $this->ajaxResponse(false, 'Data gagal disimpan', $e);
        }
    }
}
