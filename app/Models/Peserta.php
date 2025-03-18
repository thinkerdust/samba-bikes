<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class Peserta extends Model
{
    public $timestamps = false;
    protected $table = 'peserta';

    public function dataTablePeserta($event)
    {
        
        $query = DB::table('peserta as p')
                    ->select('p.id', 'p.nama_komunitas as nama_komunitas_personal', 'k.nama as nama_komunitas', 'p.nama', 'p.gender', 'p.phone', 'p.telp_emergency', 'p.hubungan_emergency', 'p.kota', 'e.nama as nama_event')
                    ->join('event as e', 'p.id_event', '=', 'e.id')
                    ->leftJoin('komunitas as k', 'p.id_komunitas', '=', 'k.id')
                    ->where('p.status', 1);

        if($event) {
            $query->where('p.id_event', $event);
        }

        return $query;
    }

    public function editPeserta($id)
    {
        $query = DB::table('peserta as p')
                    ->select('p.*', 'p.nama_komunitas as nama_komunitas_personal', 'k.nama as nama_komunitas')
                    ->leftJoin('komunitas as k', 'p.id_komunitas', '=', 'k.id')
                    ->where('p.id', $id)
                    ->first();

        return $query;
    }
}
