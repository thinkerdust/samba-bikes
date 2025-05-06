<?php

namespace App\Http\Controllers;

use App\Http\Controllers\BaseController as BaseController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Mail;
use App\Models\Counters;
use App\Models\Peserta;
use DB;
use Carbon\Carbon;
use App\Mail\SendEmailRegistrasi;

class LandingController extends BaseController 
{

    protected $counters;
    protected $peserta;

    function __construct(Counters $counters, Peserta $peserta) 
    {
        $this->peserta = $peserta;
        $this->counters = $counters;
    }

    public function index() {
        $js         = 'assets/js/apps/landing/landing.js?_='.rand();
        $data       = DB::table('event')->where('status', 2)->first();
        $schedules  = DB::table('event_schedule')->where('id_event', $data->id)->orderBy('jam', 'asc')->get();
        $images     = DB::table('event_images')->where('id_event', $data->id)->get();
        $sponsors   = DB::table('sponsor')->where('id_event', $data->id)->get();

        $today = Carbon::today();

        $statistik = DB::table('statistik')
            ->selectRaw('
                IFNULL(SUM(view), 0) as totalView,
                IFNULL(SUM(CASE WHEN YEAR(tanggal) = ? THEN view ELSE 0 END), 0) as counterTahun,
                IFNULL(SUM(CASE WHEN YEAR(tanggal) = ? AND MONTH(tanggal) = ? THEN view ELSE 0 END), 0) as counterBulan,
                IFNULL(SUM(CASE WHEN tanggal = ? THEN view ELSE 0 END), 0) as counterHari
            ', [
                $today->year,
                $today->year,
                $today->month,
                $today->toDateString(),
            ])
            ->first();

        return view('landing.index', compact('js', 'data', 'schedules', 'images', 'sponsors', 'statistik'));
    }

    public function get_harga() 
    {
        $data = DB::table('event')->where('status', 2)->select('harga')->first();
        return response()->json($data);
    }

    // check peserta by nik (input array)
    public function check_peserta(Request $request) 
    {
        $nik  = $request->input('nik');
        $data = DB::table('event as e')
                    ->join('order as o', 'e.id', '=', 'o.id_event')
                    ->join('order_detail as od', function ($join) {
                        $join->on('od.nomor_order', '=', 'o.nomor')
                            ->where('od.status', '=', 1);
                    })
                    ->join('peserta as p', function ($join) {
                        $join->on('p.id', '=', 'od.id_peserta')
                            ->where('p.status', '=', 1);
                    })
                    ->where('e.status', '=', 2)
                    ->where('o.status', '<>', 0)
                    ->whereIn('p.nik', $nik)
                    ->select('p.id', 'p.nama', 'p.nik', 'o.status', DB::raw("case when curdate() between e.tanggal_mulai and e.tanggal_selesai then 1 else 0 end as flag_tanggal"))
                    ->get();

        return $this->ajaxResponse(true, 'Berhasil mengambil data peserta', $data);
    }    

    public function register_peserta(Request $request) 
    {
        $type = $request->input('type');
        $jumlah = ($type == 'komunitas') ? count($request->nama): 1;
        $today = date('Y-m-d');

        $event =  DB::table('event as e')
                    ->leftJoin('order as o', function ($join) {
                        $join->on('e.id', '=', 'o.id_event')
                            ->whereIn('o.status', [1, 2]);
                    })
                    ->select(
                        'e.id',
                        'e.nama',
                        'e.email',
                        'e.harga',
                        'e.stok',
                        'e.tanggal_mulai',
                        'e.tanggal_selesai',
                        DB::raw('(e.stok - SUM(IFNULL(o.jumlah, 0))) as sisa_stok')
                    )
                    ->where('e.status', 2)
                    ->groupBy('e.id')
                    ->first();
        
        if (!$event) {
            return $this->ajaxResponse(false, 'Event tidak ditemukan.');
        }elseif ($today < $event->tanggal_mulai){
            return $this->ajaxResponse(false, 'Event belum dimulai. Silakan cek kembali pada tanggal ' . date('d M Y', strtotime($event->tanggal_mulai)) . '.');
        }elseif ($today > $event->tanggal_selesai) {
            return $this->ajaxResponse(false, 'Event telah berakhir. Event telah berakhir. Nantikan event menarik kami berikutnya!');
        }elseif (($event->sisa_stok - $jumlah) < 0) {
            return $this->ajaxResponse(false, 'Stok tiket event ' . $event->nama . ' sudah habis.');
        }
    
        try {
            DB::beginTransaction();
        
            $nomor_order = $this->counters->generateKode();

            $dataEmail = [
                'nomor_order'   => $nomor_order,
                'event'         => $event->nama,
                'email'         => $event->email
            ];

            $dataOrder = [
                'nomor'     => $nomor_order,
                'email'     => $request->email,
                'id_event'  => $event->id,
            ];
    
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
                            ->where([['id_event', $event->id], ['status', 1]])
                            ->first();

                if ($peserta) {
                    $peserta->update(['status' => 0]);

                    $oldOrder = DB::table('order_detail')
                                    ->join('order', 'order_detail.nomor_order', '=', 'order.nomor')
                                    ->where([['order_detail.id_peserta', $peserta->id], ['order_detail.status', 1], ['order.id_event', $event->id]])
                                    ->first();

                    DB::table('order_detail')
                        ->where([['id_peserta', $peserta->id], ['nomor_order', $oldOrder->nomor_order]])
                        ->update(['status' => 0]);

                    if ($oldOrder->jumlah == 1) {
                        DB::table('order')
                            ->where('nomor', $oldOrder->nomor_order)
                            ->update(['status' => 0, 'jumlah' => 0, 'total' => 0]);
                    } else {
                        $summary = DB::table('order_detail')
                            ->where([['nomor_order', $oldOrder->nomor_order], ['status', 1]])
                            ->selectRaw('COUNT(id) as jumlah, SUM(subtotal) as total')
                            ->first();

                        DB::table('order')
                            ->where('nomor', $oldOrder->nomor_order) 
                            ->update([
                                'jumlah' => $summary->jumlah,
                                'total'  => $summary->total,
                            ]);
                    }                
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
    
                $lastNomorUrut = DB::table('order_detail')
                                ->join('order', 'order_detail.nomor_order', '=', 'order.nomor')
                                ->where('order.id_event', $event->id)
                                ->max('order_detail.nomor_urut');

                $nextNomorUrut = $lastNomorUrut ? $lastNomorUrut + 1 : 1;
                $total = $event->harga + $nextNomorUrut;

                $dataOrder['jumlah'] = 1;
                $dataOrder['total'] = $total;
                $dataOrderDetail[] = [
                    'nomor_order'   => $nomor_order,
                    'id_peserta'    => $id_peserta,
                    'nomor_urut'    => $nextNomorUrut,
                    'subtotal'      => $total
                ];

                $recepientMail      = $request->email;

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

                $recepientMail = $request->email;
                $total = 0;
                $jumlah = 0;

                $lastNomorUrut = DB::table('order_detail')
                                ->join('order', 'order_detail.nomor_order', '=', 'order.nomor')
                                ->where('order.id_event', $event->id)
                                ->max('order_detail.nomor_urut');

                $nextNomorUrut = $lastNomorUrut ? $lastNomorUrut + 1 : 1;

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
                                    ->where([['order_detail.id_peserta', $peserta->id], ['order_detail.status', 1], ['order.id_event', $event->id]])
                                    ->first();

                        DB::table('order_detail')
                            ->where('id_peserta', $peserta->id)
                            ->update(['status' => 0]);

                        if ($oldOrder->jumlah == 1) {
                            DB::table('order')
                                ->where('nomor', $oldOrder->nomor_order)
                                ->update(['status' => 0, 'jumlah' => 0, 'total' => 0]);
                        } else {
                            $summary = DB::table('order_detail')
                                        ->where([['nomor_order', $oldOrder->nomor_order], ['status', 1]])
                                        ->selectRaw('COUNT(id) as jumlah, SUM(subtotal) as total')
                                        ->first();

                            DB::table('order')
                                ->where('nomor', $oldOrder->nomor_order) 
                                ->update([
                                    'jumlah' => $summary->jumlah,
                                    'total'  => $summary->total,
                                ]);
                        }
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

                    
                    $subtotal = $event->harga + $nextNomorUrut;
                    $total += $subtotal;
                    $jumlah += 1;
                    
                    $dataOrderDetail[] = [
                        'nomor_order'   => $nomor_order,
                        'id_peserta'    => $id_peserta,
                        'nomor_urut'    => $nextNomorUrut,
                        'subtotal'      => $subtotal
                    ];

                    $nextNomorUrut ++;
                }

                $dataOrder['jumlah'] = $jumlah;
                $dataOrder['total'] = $total;

            }

            DB::table('order')->insert($dataOrder);
            DB::table('order_detail')->insert($dataOrderDetail);

            DB::commit();

            try {

                Mail::to($recepientMail)->send(new SendEmailRegistrasi($dataEmail));
    
            } catch (\Throwable $e) {
                Log::error($e->getMessage());
            }

            return $this->ajaxResponse(true, 'Data berhasil disimpan');
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            DB::rollback();
            return $this->ajaxResponse(false, 'Data gagal disimpan', $e);
        }
    }

}
