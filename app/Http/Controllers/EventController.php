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
use App\Models\Event;
use Carbon\Carbon;
use Yajra\DataTables\DataTables;

class EventController extends BaseController
{
    protected $event;

    function __construct(Event $event)
    {
        $this->event = $event;
    }

    public function index()
    {
        $title  = 'Event';
        $js     = 'assets/js/apps/event/index.js?_='.rand();
        return view('event.index', compact('js', 'title'));
    }

    public function datatable_event(Request $request)
    {
        $start_date = $request->start_date;
        $end_date = $request->end_date;
        $data = $this->event->dataTableEvent($start_date, $end_date); 
        return Datatables::of($data)->addIndexColumn()
            ->addColumn('action', function($row) {
                $btn = '';
                if(Gate::allows('crudAccess', 'EV', $row)) {
                    $btn = '<div class="drodown">
                                <a href="#" class="dropdown-toggle btn btn-icon btn-trigger" data-bs-toggle="dropdown"><em class="icon ni ni-more-h"></em></a>
                                <div class="dropdown-menu dropdown-menu-end">
                                    <ul class="link-list-opt no-bdr">
                                        <li><a class="btn" onclick="detail(\'' . $row->id . '\')"><em class="icon ni ni-eye"></em><span>Detail</span></a></li>
                                        <li><a href="/admin/event/form/'.$row->id.'" class="btn"><em class="icon ni ni-edit"></em><span>Edit</span></a></li>
                                        <li><a class="btn" onclick="hapus(\'' . $row->id . '\')"><em class="icon ni ni-trash"></em><span>Hapus</span></a></li>
                                    </ul>
                                </div>
                            </div>';
                }
                return $btn;
            })
            ->make(true);
    }

    public function store_event(Request $request)
    {
        $id = $request->input('id');

        $validator = Validator::make($request->all(), [
            'nama' => 'required|max:255',
            'tanggal' => 'required',
            'lokasi' => 'required',
            'tanggal_mulai_tiket' => 'required',
            'tanggal_selesai_tiket' => 'required',
            'harga' => 'required',
            'stok' => 'required',
        ], validation_message());

        if($validator->stopOnFirstFailure()->fails()){
            return $this->ajaxResponse(false, $validator->errors()->first());        
        }

        $user = Auth::user();

        try {
            DB::beginTransaction();
            $harga = Str::replace('.', '', $request->harga);
            $stok = Str::replace('.', '', $request->stok);

            $data = [
                'nama' => $request->nama,
                'lokasi' => $request->lokasi,
                'tanggal' => Carbon::createFromFormat('d/m/Y', $request->tanggal)->format('Y-m-d'),
                'tanggal_mulai' => Carbon::createFromFormat('d/m/Y', $request->tanggal_mulai_tiket)->format('Y-m-d'),
                'tanggal_selesai' => Carbon::createFromFormat('d/m/Y', $request->tanggal_selesai_tiket)->format('Y-m-d'),
                'deskripsi' => $request->deskripsi,
                'harga' => $harga,
                'stok' => $stok
            ];

            // insert order
            if(!empty($id)) {
                $data['update_at']  = Carbon::now();
                $data['update_by']  = $user->id;
            } else {
                $data['insert_at']  = Carbon::now();
                $data['insert_by']  = $user->id;
            }

            DB::table('event')->updateOrInsert(
                ['id' => $id],
                $data
            );

            DB::commit();
            return $this->ajaxResponse(true, 'Data berhasil disimpan');
        } catch (\Exception $e) {
            dd($e);
            Log::error($e->getMessage());
            DB::rollback();
            return $this->ajaxResponse(false, 'Data gagal disimpan', $e);
        }
    }

    public function form_event(Request $request)
    {
        $title      = 'Form Event';
        $id         = $request->id;
        $js         = 'assets/js/apps/event/form.js?_='.rand();

        return view('event.form', compact('title', 'js', 'id'));
    }

    public function edit_event(Request $request) 
    {
        $id     = $request->id;
        $data   = $this->event->editEvent($id);

        return $this->ajaxResponse(true, 'Success!', $data);
    }

    public function delete_event(Request $request)
    {
        $id     = $request->id;
        $user   = Auth::user();

        try {
            DB::beginTransaction();

            DB::table('event')->where('id', $id)->update(['status' => 0, 'update_at' => Carbon::now(), 'update_by' => $user->id]);

            DB::commit();
            return $this->ajaxResponse(true, 'Data berhasil dihapus');
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            DB::rollback();
            return $this->ajaxResponse(false, 'Data gagal dihapus', $e);
        }
    }
}
