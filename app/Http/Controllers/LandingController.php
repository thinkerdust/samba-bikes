<?php

namespace App\Http\Controllers;

use App\Http\Controllers\BaseController as BaseController;
use Illuminate\Http\Request;
use DB;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use App\Models\Counter;
use App\Models\Peserta;

class LandingController extends BaseController {

    protected $counter;
    protected $peserta;

    function __construct(Counter $counter, Peserta $peserta) {
        $this->peserta = $peserta;
        $this->counter = $counter;
    }

    public function index() {
        $js = 'assets/js/apps/landing/landing.js?_='.rand();
        return view('landing.index', compact('js'));
    }

    public function get_harga(Request $request) {
        $data = DB::table('event')->where('status', 1)->first();
        return response()->json($data);
    }

    // check peserta by nik (input array)
    public function check_peserta(Request $request) {
        $nik  = $request->input('nik');
        $type = $request->input('type');
    
        $query = DB::table('peserta')->select('id', 'nama')->whereIn('nik', $nik)->where('status', 1);
    
        return $this->ajaxResponse(true, 'Berhasil mengambil data peserta', $query->get());
    }    

    public function register_peserta(Request $request) {
    
        $type = $request->input('type');

        $event = DB::table('event')
                    ->select(
                        'event.id', 'event.nama', 'event.harga',
                        DB::raw('IFNULL(order.jumlah, 0) as total_order'),
                        DB::raw('event.stok - IFNULL(order.jumlah, 0) as sisa_stok') 
                    )
                    ->leftJoin('order', function ($join) {
                        $join->on('event.id', '=', 'order.id_event')
                            ->whereIn('order.status', [1, 2]);
                    })
                    ->where('event.status', 2)
                    ->first(); 
        
        if (!$event) {
            return $this->ajaxResponse(false, 'Event tidak ditemukan.');
        }
        
        if ($event->sisa_stok <= 0) {
            return $this->ajaxResponse(false, 'Stok event ' . $event->nama . ' sudah habis.');
        }
    
        try {
            DB::beginTransaction();

            $counter = DB::table('counter')
                        ->where('modul', 'ORDER')
                        ->value('count');
            $counter = $counter !== null ? $counter + 1 : 1;
        
            $nomor_order = 'ORD/' . Carbon::now()->format('ymd') . '/' . sprintf('%05d', $counter);

            Counter::updateOrCreate(
                ['modul' => 'ORDER'], // Condition to check if the row exists
                ['count' => $counter] // Data to update or insert
            );

            $dataOrder = [
                'nomor'     => $nomor_order,
                'id_event'  => $event->id,
                'total'     => 0,
                'jumlah'    => 0,
                'status'    => 1,
            ];
    
            if ($request->hasFile('bukti_transfer')) {
                $file = $request->file('bukti_transfer');
                $fileName = time() . '.' . $file->getClientOriginalExtension();
                $filePath = 'uploads/' . $fileName;
    
                if (Storage::disk('public')->put($filePath, file_get_contents($file))) {
                    $dataOrder['bukti_transfer'] = $fileName;
                }
            }
    
            $dataOrderDetail = [];
    
            if ($type === 'personal') {
                $validator = Validator::make($request->all(), [
                    'nama'              => 'required',
                    'phone'             => 'required',
                    'email'             => 'required|email',
                    'tanggal_lahir'     => 'required|date_format:d/m/Y',
                    'gender'            => 'required',
                    'blood'             => 'required',
                    'nik'               => 'required',
                    'telp_emergency'    => 'required',
                    'hubungan_emergency' => 'required',
                    'kota'              => 'required',
                    'alamat'            => 'required',
                    'jersey'            => 'required',
                ], validation_message());
    
                if ($validator->stopOnFirstFailure()->fails()) {
                    return $this->ajaxResponse(false, $validator->errors()->first());
                }

                $nik = $request->input('nik');

                $peserta = Peserta::where('nik', $nik)
                            ->where('id_event', $event->id)
                            ->where('status', 1)
                            ->first();

                if ($peserta) {
                    $peserta->update(['status' => 0]);

                    $oldOrder = DB::table('order_detail')
                                    ->join('order', 'order_detail.nomor_order', '=', 'order.nomor')
                                    ->where('order_detail.id_peserta', $peserta->id)
                                    ->where('order_detail.status', 1)
                                    ->first();

                    if ($oldOrder->jumlah == 1) {
                        DB::table('order')
                            ->where('nomor', $oldOrder->nomor_order)
                            ->update(['status' => 0]);
                    } else {
                        DB::table('order')
                            ->where('nomor', $oldOrder->nomor_order)
                            ->decrement('jumlah');
                    }

                    DB::table('order_detail')
                        ->where('id_peserta', $peserta->id)
                        ->update(['status' => 0]);
                
                }
    
                $id_peserta = DB::table('peserta')->insertGetId([
                    'id_event'          => $event->id,
                    'nama'              => $request->nama,
                    'phone'             => phone_number_format($request->phone),
                    'email'             => $request->email,
                    'tgl_lahir'         => Carbon::createFromFormat('d/m/Y', $request->tanggal_lahir)->format('Y-m-d'),
                    'gender'            => $request->gender,
                    'blood'             => $request->blood,
                    'nik'               => $request->nik,
                    'telp_emergency'    => phone_number_format($request->telp_emergency),
                    'hubungan_emergency' => $request->hubungan_emergency,
                    'kota'              => $request->kota,
                    'nama_komunitas'    => $request->nama_komunitas,
                    'alamat'            => $request->alamat,
                    'size_jersey'       => $request->jersey,
                ]);
    
                $dataOrder['total'] = $event->harga;
                $dataOrder['jumlah'] = 1;
                $dataOrderDetail[] = [
                    'nomor_order'   => $nomor_order,
                    'id_peserta'    => $id_peserta,
                ];
            } else {
                $validator = Validator::make($request->all(), [
                    'nama_komunitas'        => 'required',
                    'koordinator'           => 'required',
                    'email'                 => 'required|email',
                    'kota'                  => 'required',
                    'phone'                 => 'required',
                    'nama.*'                => 'required',
                    'gender.*'              => 'required',
                    'tanggal_lahir.*'       => 'required',
                    'nik.*'                 => 'required',
                    'telp_emergency.*'      => 'required',
                    'hubungan_emergency.*'  => 'required',
                    'blood.*'               => 'required',
                    'jersey.*'              => 'required',
                ], validation_message());
    
                if ($validator->stopOnFirstFailure()->fails()) {
                    return $this->ajaxResponse(false, $validator->errors()->first());
                }

                $dataKomunitas = [
                    'nama'          => $request->nama_komunitas,
                    'koordinator'   => $request->koordinator,
                    'email'         => $request->email,
                    'kota'          => $request->kota,
                    'phone'         => phone_number_format($request->phone),
                ];

                $id_komunitas = DB::table('komunitas')->insertGetId($dataKomunitas);

                foreach ($request->nama as $key => $nama) {
                    $nik = $request->nik[$key];

                    $peserta = Peserta::where('nik', $nik)
                                ->where('id_event', $event->id)
                                ->where('status', 1)
                                ->first();

                    if ($peserta) {

                        $peserta->update(['status' => 0]);

                        $oldOrder = DB::table('order_detail')
                                        ->join('order', 'order_detail.nomor_order', '=', 'order.nomor')
                                        ->where('order_detail.id_peserta', $peserta->id)
                                        ->where('order_detail.status', 1)
                                        ->first();

                        if ($oldOrder->jumlah == 1) {
                            DB::table('order')
                                ->where('nomor', $oldOrder->nomor_order)
                                ->update(['status' => 0]);
                        } else {
                            DB::table('order')
                                ->where('nomor', $oldOrder->nomor_order)
                                ->decrement('jumlah');
                        }

                        DB::table('order_detail')
                            ->where('id_peserta', $peserta->id)
                            ->update(['status' => 0]);
                    }

                    $id_peserta = DB::table('peserta')->insertGetId([
                        'nama'              => $nama,
                        'id_komunitas'      => $id_komunitas,
                        'id_event'          => $event->id,
                        'gender'            => $request->gender[$key],
                        'tgl_lahir'         => $request->tanggal_lahir[$key],
                        'nik'               => $request->nik[$key],
                        'telp_emergency'    => phone_number_format($request->telp_emergency[$key]),
                        'hubungan_emergency' => $request->hubungan_emergency[$key],
                        'blood'             => $request->blood[$key],
                        'size_jersey'       => $request->jersey[$key],
                    ]);

                    $dataOrder['total'] += $event->harga;
                    $dataOrder['jumlah'] += 1;
                    $dataOrderDetail[] = [
                        'nomor_order' => $nomor_order,
                        'id_peserta' => $id_peserta,
                    ];
                }
            }

            DB::table('order')->insert($dataOrder);
            DB::table('order_detail')->insert($dataOrderDetail);

            DB::commit();
            return $this->ajaxResponse(true, 'Data berhasil disimpan');
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            DB::rollback();
            return $this->ajaxResponse(false, 'Data gagal disimpan', $e);
        }
    }
    
}
