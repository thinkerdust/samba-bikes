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
                                        <li><a class="btn" onclick="detail(\'' . $row->id . '\')"><em class="icon ni ni-eye"></em><span>Detail</span></a></li>
                                        <li><a class="btn" onclick="hapus(\'' . $row->id . '\')"><em class="icon ni ni-trash"></em><span>Hapus</span></a></li>
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

    public function delete_peserta(Request $request)
    {
        $id     = $request->id;
        $user   = Auth::user();

        try {
            DB::beginTransaction();

            DB::table('peserta')->where('id', $id)->update(['status' => 0, 'delete_at' => Carbon::now(), 'delete_by' => $user->id]);

            DB::commit();
            return $this->ajaxResponse(true, 'Data berhasil dihapus');
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            DB::rollback();
            return $this->ajaxResponse(false, 'Data gagal dihapus', $e);
        }
    }
}
