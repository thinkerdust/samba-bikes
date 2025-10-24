<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class Peserta extends Model
{
    public $timestamps = false;
    protected $table = 'peserta';
    protected $fillable = [
        'id_komunitas',
        'id_event',
        'nama',
        'phone',
        'email',
        'tgl_lahir',
        'nik',
        'blood',
        'kota',
        'alamat',
        'gender',
        'nama_komunitas',
        'telp_emergency',
        'hubungan_emergency',
        'size_jersey',
        'status',
        'insert_at',
        'update_at',
        'update_by',
    ];
    
    public function dataTablePeserta($event, $status)
    {
        
        $query = DB::table('peserta as p')
                    ->select('p.id', 'p.nama', 'p.gender', 'p.phone', 'p.telp_emergency', 
                        'p.hubungan_emergency', 'p.kota', 'p.id_event',
                        'e.nama as nama_event',
                        'od.nomor_order',
                        DB::raw("IFNULL(p.nama_komunitas, k.nama) as nama_komunitas"),
                        DB::raw("IFNULL(p.email, k.email) as email")
                    )
                    ->leftJoin('komunitas as k', 'p.id_komunitas', '=', 'k.id')
                    ->join('event as e', 'p.id_event', '=', 'e.id')
                    ->join('order as o', 'o.id_event', '=', 'e.id')
                    ->join('order_detail as od', function($join) {
                        $join->on('od.nomor_order', '=', 'o.nomor')
                            ->on('od.id_peserta', '=', 'p.id');
                    })
                    ->where('p.status', 1);

        if($event) {
            $query->where('p.id_event', $event);
        }

        if($status != 'all') {
            $query->where('o.status', $status);
        }

        return $query;
    }

    public function editPeserta($id)
    {
        $query = DB::table('peserta as p')
                    ->select('p.id', 'p.id_komunitas', 'p.nama', 'p.telp_emergency', 'p.hubungan_emergency', 'p.nik', 'p.kota', 'p.size_jersey', 'p.tgl_lahir',
                        'p.blood', 'p.gender', 'p.alamat',
                        'k.nama as nama_komunitas',
                        'od.nomor_order',
                        DB::raw("IFNULL(p.nama_komunitas, k.nama) as nama_komunitas"),
                        DB::raw("IFNULL(p.email, k.email) as email"),
                        DB::raw("IFNULL(p.phone, k.phone) as phone")
                    )
                    ->join('event as e', 'p.id_event', '=', 'e.id')
                    ->join('order as o', 'o.id_event', '=', 'e.id')
                    ->join('order_detail as od', function($join) {
                        $join->on('od.nomor_order', '=', 'o.nomor')
                            ->on('od.id_peserta', '=', 'p.id');
                    })
                    ->leftJoin('komunitas as k', 'p.id_komunitas', '=', 'k.id')
                    ->where('p.id', $id)
                    ->first();

        return $query;
    }
}
