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
use App\Models\Sponsor;
use App\Models\EventImages;
use App\Models\EventSchedule;
use Carbon\Carbon;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\Storage;

class EventController extends BaseController
{
    protected $event;
    protected $sponsor;
    protected $event_images;

    function __construct(Event $event, Sponsor $sponsor, EventImages $event_images)
    {
        $this->event        = $event;
        $this->sponsor      = $sponsor;
        $this->event_images = $event_images;
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
                if(Gate::allows('crudAccess', 'EVENT', $row)) {

                    $release    = '';
                    $delete     = '';
                    
                    if($row->status != 2 && $row->status != 0) {
                        $release    = '<li><a class="btn" onclick="release(' . $row->id . ')"><em class="icon ni ni-send"></em><span>Release</span></a></li>';
                        $delete     = '<li><a class="btn" onclick="hapus(\'' . $row->id . '\')"><em class="icon ni ni-trash"></em><span>Hapus</span></a></li>';
                    }

                    $btn = '<div class="drodown">
                                <a href="#" class="dropdown-toggle btn btn-icon btn-trigger" data-bs-toggle="dropdown"><em class="icon ni ni-more-h"></em></a>
                                <div class="dropdown-menu dropdown-menu-end">
                                    <ul class="link-list-opt no-bdr">
                                        '.$release.'
                                        <li><a class="btn" onclick="detail(\'' . $row->id . '\')"><em class="icon ni ni-eye"></em><span>Detail</span></a></li>
                                        <li><a href="/admin/event/form/'.$row->id.'" class="btn"><em class="icon ni ni-edit"></em><span>Edit</span></a></li>
                                        '.$delete.'
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
            'nama'                  => 'required|max:255',
            'phone'                 => 'required|max:20',
            'email'                 => 'required|email|max:255',
            'tanggal'               => 'required',
            'bank'                  => 'required',
            'nomor_rekening'        => 'required|max:255',
            'nama_rekening'         => 'required|max:255',
            'kota'                  => 'required|max:255',
            'lokasi'                => 'required',
            'jarak'                 => 'required|max:255',
            'tanggal_racepack'      => 'required',
            'jam_mulai_racepack'    => 'required',
            'jam_selesai_racepack'  => 'required',
            'tanggal_mulai_tiket'   => 'required',
            'tanggal_selesai_tiket' => 'required',
            'harga'                 => 'required',
            'stok'                  => 'required',
            'banner_desktop'        => 'required_if:id,0|max:2048',
            'banner_tablet'         => 'required_if:id,0|max:2048',
            'banner_mobile'         => 'required_if:id,0|max:2048',
            'tagline'               => 'required_if:id,0|max:20',
            'size_chart'            => 'required_if:id,0|max:2048',
            'rute'                  => 'required_if:id,0|max:2048',
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
                'nama'              => $request->nama,
                'phone'             => $request->phone,
                'email'             => $request->email,
                'bank'              => $request->bank,
                'nama_rekening'     => $request->nama_rekening,
                'nomor_rekening'    => $request->nomor_rekening,
                'kota'              => $request->kota,
                'lokasi'            => $request->lokasi,
                'jarak'             => $request->jarak,
                'tanggal_racepack'  => Carbon::createFromFormat('d/m/Y', $request->tanggal_racepack)->format('Y-m-d'),
                'jam_mulai_racepack'    => Carbon::createFromFormat('H:i', $request->jam_mulai_racepack)->format('H:i'),
                'jam_selesai_racepack'  => Carbon::createFromFormat('H:i', $request->jam_selesai_racepack)->format('H:i'),
                'lat_start'         => $request->lat_start,
                'long_start'        => $request->long_start,
                'lat_end'           => $request->lat_end,
                'long_end'          => $request->long_end,
                'link_rute'         => $request->link_rute,
                'deskripsi'         => $request->deskripsi,
                'deskripsi_internal'    => $request->deskripsi_internal,
                'tanggal'           => Carbon::createFromFormat('d/m/Y', $request->tanggal)->format('Y-m-d'),
                'tanggal_mulai'     => Carbon::createFromFormat('d/m/Y', $request->tanggal_mulai_tiket)->format('Y-m-d'),
                'tanggal_selesai'   => Carbon::createFromFormat('d/m/Y', $request->tanggal_selesai_tiket)->format('Y-m-d'),
                'harga'             => $harga,
                'stok'              => $stok,
                'facebook'          => $request->facebook,
                'twitter'           => $request->twitter,
                'instagram'         => $request->instagram,
                'youtube'           => $request->youtube,
                'tagline'           => $request->tagline,
            ];

            if($request->file('banner_desktop')) {
                $banner_desktop         = $request->file('banner_desktop');
                $extBannerDesktop       = $banner_desktop->getClientOriginalExtension();
                $filenameBannerDesktop  = 'BANNER_DESKTOP_' . time() . '.' . $extBannerDesktop;
                $banner_desktop->storeAs('uploads', $filenameBannerDesktop, 'public');
                $data['banner_desktop'] = $filenameBannerDesktop;

                $filePathBannerDesktop = 'uploads/'.$request->old_banner_desktop;
                if (Storage::disk('public')->exists($filePathBannerDesktop)) {
                    Storage::disk('public')->delete($filePathBannerDesktop);
                }
            }

            if($request->file('banner_tablet')) {
                $banner_tablet          = $request->file('banner_tablet');
                $extBannerTablet        = $banner_tablet->getClientOriginalExtension();
                $filenameBannerTablet   = 'BANNER_TABLET_' . time() . '.' . $extBannerTablet;
                $banner_tablet->storeAs('uploads', $filenameBannerTablet, 'public');
                $data['banner_tablet'] = $filenameBannerTablet;

                $filePathBannerTablet = 'uploads/'.$request->old_banner_tablet;
                if (Storage::disk('public')->exists($filePathBannerTablet)) {
                    Storage::disk('public')->delete($filePathBannerTablet);
                }
            }

            if($request->file('banner_mobile')) {
                $banner_mobile          = $request->file('banner_mobile');
                $extBannerMobile        = $banner_mobile->getClientOriginalExtension();
                $filenameBannerMobile   = 'BANNER_MOBILE_' . time() . '.' . $extBannerMobile;
                $banner_mobile->storeAs('uploads', $filenameBannerMobile, 'public');
                $data['banner_mobile'] = $filenameBannerMobile;

                $filePathBannerMobile = 'uploads/'.$request->old_banner_mobile;
                if (Storage::disk('public')->exists($filePathBannerMobile)) {
                    Storage::disk('public')->delete($filePathBannerMobile);
                }
            }

            if($request->file('size_chart')) {
                $size_chart         = $request->file('size_chart');
                $extSizeChart       = $size_chart->getClientOriginalExtension();
                $filenameSizeChart  = 'SIZE_CHART_' . time() . '.' . $extSizeChart;
                $size_chart->storeAs('uploads', $filenameSizeChart, 'public');
                $data['size_chart'] = $filenameSizeChart;

                $filePathSizeChart = 'uploads/'.$request->old_size_chart;
                if (Storage::disk('public')->exists($filePathSizeChart)) {
                    Storage::disk('public')->delete($filePathSizeChart);
                }
            }

            if($request->file('rute')) {
                $rute           = $request->file('rute');
                $extRute        = $rute->getClientOriginalExtension();
                $filenameRute   = 'RUTE_' . time() . '.' . $extRute;
                $rute->storeAs('uploads', $filenameRute, 'public');
                $data['rute'] = $filenameRute;

                $filePathRute = 'uploads/'.$request->old_rute;
                if (Storage::disk('public')->exists($filePathRute)) {
                    Storage::disk('public')->delete($filePathRute);
                }
            }

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
        try {
            DB::beginTransaction();

            $id     = $request->id;
            $user   = Auth::user();

            DB::table('event')->where('id', $id)->update(['status' => 0, 'update_at' => Carbon::now(), 'update_by' => $user->id]);

            DB::commit();
            return $this->ajaxResponse(true, 'Data berhasil dihapus');
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            DB::rollback();
            return $this->ajaxResponse(false, 'Data gagal dihapus', $e);
        }
    }

    public function release_event(Request $request)
    {
        try {
            DB::beginTransaction();
            
            $id     = $request->id;
            $user   = Auth::user();

            DB::table('event')->where('status', 2)->update(['status' => 1, 'update_at' => Carbon::now(), 'update_by' => $user->id]);

            DB::table('event')->where('id', $id)->update(['status' => 2, 'update_at' => Carbon::now(), 'update_by' => $user->id]);

            DB::commit();
            return $this->ajaxResponse(true, 'Data berhasil di-release');
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            DB::rollback();
            return $this->ajaxResponse(false, 'Data gagal di-release', $e);
        }
    }

    public function datatable_schedule(Request $request)
    {
        $id_event = $request->id_event;
        $data = $this->event->dataTableEventSchedule($id_event); 
        return Datatables::of($data)->addIndexColumn()
            ->addColumn('action', function($row) {
                $btn = '';
                if(Gate::allows('crudAccess', 'EVENT', $row)) {

                    $btn = '
                        <a class="btn btn-warning" onclick="edit_schedule(\'' . $row->id . '\')"><span>Edit</span></a>
                        <a class="btn btn-danger" onclick="hapus_schedule(\'' . $row->id . '\')"></em><span>Hapus</span></a>
                    ';

                }
                return $btn;
            })
            ->make(true);
    }

    public function edit_schedule(Request $request) 
    {
        $id     = $request->id;
        $data   = $this->event->editSchedule($id);

        return $this->ajaxResponse(true, 'Success!', $data);
    }

    public function store_schedule(Request $request)
    {
        $id         = $request->input('id');
        $id_event   = $request->input('id_event');

        $validator = Validator::make($request->all(), [
            'nama'         => 'required|max:100',
            'deskripsi'    => 'required|max:255',
            'jam'          => 'required',
        ], validation_message());

        if($validator->stopOnFirstFailure()->fails()){
            return $this->ajaxResponse(false, $validator->errors()->first());        
        }

        $user = Auth::user();

        try {
            DB::beginTransaction();

            $data = [
                'id_event'  => $id_event,
                'nama'      => $request->nama,
                'deskripsi' => $request->deskripsi,
                'jam'       => $request->jam,
            ];

            if(!empty($id)) {
                $data['update_at']  = Carbon::now();
                $data['update_by']  = $user->id;
            } else {
                $data['insert_at']  = Carbon::now();
                $data['insert_by']  = $user->id;
            }

            EventSchedule::updateOrCreate(
                ['id' => $id], 
                $data         
            );            

            DB::commit();
            return $this->ajaxResponse(true, 'Data berhasil disimpan');
        } catch (\Exception $e) {
            DB::rollback();
            Log::error($e->getMessage());
            return $this->ajaxResponse(false, 'Data gagal disimpan', $e);
        }
    }

    public function delete_schedule(Request $request)
    {
        try {
            DB::beginTransaction();

            $id     = $request->id;
            $user   = Auth::user();

            EventSchedule::where('id', $id)->delete();

            DB::commit();
            return $this->ajaxResponse(true, 'Data berhasil dihapus');
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            DB::rollback();
            return $this->ajaxResponse(false, 'Data gagal dihapus', $e);
        }
    }

    public function list_sponsor($id_event)
    {
        $data = $this->sponsor->where('id_event', $id_event)->get();
        return $this->ajaxResponse(true, 'Success!', $data);
    }

    public function store_sponsor(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'file' => 'required|image|mimes:jpg,png,jpeg,gif,svg|max:2048',
        ], validation_message());

        if($validator->stopOnFirstFailure()->fails()){
            return $this->ajaxResponse(false, $validator->errors()->first());        
        }

        $id_event = $request->input('id_event');

        // check validasi max 10 file
        $count = Sponsor::where('id_event', $id_event)->count();
        if($count >= 10) {
            return $this->ajaxResponse(false, 'Maksimal 10 file');
        }

        if ($request->hasFile('file')) {
            $file       = $request->file('file');
            $extFile    = $file->getClientOriginalExtension();
            $filename   = 'SPONSOR_' . time() . '.' . $extFile;
            $path       = $file->storeAs('public/uploads', $filename);
            $auth       = Auth::user();

            $sponsor = Sponsor::create([
                'id_event'  => $id_event, 
                'filename'  => $filename, 
                'size'      => $file->getSize(),
                'insert_at' => Carbon::now(), 
                'insert_by' => $auth->id
            ]);

            return $this->ajaxResponse(true, 'Berhasil upload file', $sponsor->id);
        }
        return $this->ajaxResponse(false, 'Gagal upload file');
    }

    public function delete_sponsor($id)
    {
        $file = Sponsor::find($id);

        if ($file) {
            Storage::disk('public')->delete("uploads/" . $file->filename);
            $file->delete();
            return $this->ajaxResponse(true, 'Berhasil hapus file');
        }

        return $this->ajaxResponse(false, 'Gagal hapus file');
    }

    public function list_event_images($id_event)
    {
        $data = $this->event_images->where('id_event', $id_event)->get();
        return $this->ajaxResponse(true, 'Success!', $data);
    }

    public function store_event_images(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'file' => 'required|image|mimes:jpg,png,jpeg,gif,svg|max:2048',
        ], validation_message());

        if($validator->stopOnFirstFailure()->fails()){
            return $this->ajaxResponse(false, $validator->errors()->first());        
        }

        $id_event = $request->input('id_event');

        // check validasi max 10 file
        $count = EventImages::where('id_event', $id_event)->count();
        if($count >= 10) {
            return $this->ajaxResponse(false, 'Maksimal 10 file');
        }

        if ($request->hasFile('file')) {
            $file       = $request->file('file');
            $extFile    = $file->getClientOriginalExtension();
            $filename   = 'EVENT_IMAGES_' . time() . '.' . $extFile;
            $path       = $file->storeAs('public/uploads', $filename);
            $auth       = Auth::user();

            $event_images = EventImages::create([
                'id_event'  => $id_event, 
                'filename'  => $filename, 
                'size'      => $file->getSize(),
                'insert_at' => Carbon::now(), 
                'insert_by' => $auth->id
            ]);

            return $this->ajaxResponse(true, 'Berhasil upload file', $event_images->id);
        }
        return $this->ajaxResponse(false, 'Gagal upload file');
    }

    public function delete_event_images($id)
    {
        $file = EventImages::find($id);

        if ($file) {
            Storage::disk('public')->delete("uploads/" . $file->filename);
            $file->delete();
            return $this->ajaxResponse(true, 'Berhasil hapus file');
        }

        return $this->ajaxResponse(false, 'Gagal hapus file');
    }
}
