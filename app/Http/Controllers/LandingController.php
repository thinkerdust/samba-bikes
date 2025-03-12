<?php

namespace App\Http\Controllers;

use App\Http\Controllers\BaseController as BaseController;
use Illuminate\Http\Request;
use DB;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

class LandingController extends BaseController {

    public function index() {
        $js = 'assets/js/apps/landing/landing.js?_='.rand();
        return view('landing.index', compact('js'));
    }

    public function get_harga(Request $request) {
        $data = DB::table('event')->where('status', 1)->first();
        return response()->json($data);
    }

    public function register_peserta(Request $request) {
    
        $type = $request->input('type');
        $event = DB::table('event')->where('status', 1)->first();
    
        if (!$event) {
            return $this->ajaxResponse(false, 'Event tidak ditemukan.');
        }
    
        try {
            DB::beginTransaction();
    
            $kode_order = 'OH-' . now()->format('YmdHisu');
            $dataOrder = [
                'kode_order' => $kode_order,
                'id_event' => $event->id,
                'total' => 0,
                'status' => 1,
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
                    'nama' => 'required',
                    'phone' => 'required',
                    'email' => 'required|email',
                    'tanggal_lahir' => 'required|date_format:d/m/Y',
                    'gender' => 'required',
                    'blood' => 'required',
                    'nik' => 'required',
                    'telp_emergency' => 'required',
                    'hubungan_emergency' => 'required',
                    'kota' => 'required',
                    'alamat' => 'required',
                    'jersey' => 'required',
                ], validation_message());
    
                if ($validator->stopOnFirstFailure()->fails()) {
                    return $this->ajaxResponse(false, $validator->errors()->first());
                }
    
                $id_peserta = DB::table('peserta')->insertGetId([
                    'nama' => $request->nama,
                    'phone' => phone_number_format($request->phone),
                    'email' => $request->email,
                    'tanggal_lahir' => Carbon::createFromFormat('d/m/Y', $request->tanggal_lahir)->format('Y-m-d'),
                    'gender' => $request->gender,
                    'blood' => $request->blood,
                    'nik' => $request->nik,
                    'telp_emergency' => phone_number_format($request->telp_emergency),
                    'hubungan_emergency' => $request->hubungan_emergency,
                    'kota' => $request->kota,
                    'nama_komunitas' => $request->nama_komunitas,
                    'alamat' => $request->alamat,
                ]);
    
                $dataOrder['total'] = $event->harga;
                $dataOrderDetail[] = [
                    'kode_order' => $kode_order,
                    'id_peserta' => $id_peserta,
                    'harga' => $event->harga,
                    'jumlah' => 1,
                    'jersey' => $request->jersey,
                    'status' => 1,
                    'insert_by' => $id_peserta,
                ];
            } else {
                $validator = Validator::make($request->all(), [
                    'nama_komunitas' => 'required',
                    'koordinator' => 'required',
                    'email' => 'required|email',
                    'kota' => 'required',
                    'phone' => 'required',
                    'nama.*' => 'required',
                    'gender.*' => 'required',
                    'tanggal_lahir.*' => 'required',
                    'nik.*' => 'required',
                    'telp_emergency.*' => 'required',
                    'hubungan_emergency.*' => 'required',
                    'blood.*' => 'required',
                    'jersey.*' => 'required',
                ], validation_message());
    
                if ($validator->stopOnFirstFailure()->fails()) {
                    return $this->ajaxResponse(false, $validator->errors()->first());
                }

                // insert data komunitas
                $dataKomunitas = [
                    'nama' => $request->nama_komunitas,
                    'koordinator' => $request->koordinator,
                    'email' => $request->email,
                    'kota' => $request->kota,
                    'phone' => phone_number_format($request->phone),
                ];

                $id_komunitas = DB::table('komunitas')->insertGetId($dataKomunitas);

                foreach ($request->nama as $key => $nama) {
                    $id_peserta = DB::table('peserta')->insertGetId([
                        'nama' => $nama,
                        'id_komunitas' => $id_komunitas,
                        'gender' => $request->gender[$key],
                        'tanggal_lahir' => $request->tanggal_lahir[$key],
                        'nik' => $request->nik[$key],
                        'telp_emergency' => phone_number_format($request->telp_emergency[$key]),
                        'hubungan_emergency' => $request->hubungan_emergency[$key],
                        'blood' => $request->blood[$key],
                    ]);

                    // loop pertama set koordinator
                    if($key == 0) {
                        $id_koordinator = $id_peserta;
                    }

                    $dataOrder['total'] += $event->harga;
                    $dataOrderDetail[] = [
                        'kode_order' => $kode_order,
                        'id_peserta' => $id_peserta,
                        'harga' => $event->harga,
                        'jumlah' => 1,
                        'jersey' => $request->jersey[$key],
                        'status' => 1,
                        'insert_by' => $id_koordinator,
                    ];
                }
            }

            DB::table('order')->insert($dataOrder);
            DB::table('order_detail')->insert($dataOrderDetail);
    
            DB::commit();
            return $this->ajaxResponse(true, 'Data berhasil disimpan');
        } catch (\Exception $e) {
            dd($e);
            Log::error($e->getMessage());
            DB::rollback();
            return $this->ajaxResponse(false, 'Data gagal disimpan', $e);
        }
    }
    
}
