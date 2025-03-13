<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class Peserta extends Model
{
    public $timestamps = false;
    protected $table = 'peserta';

    public function dataTablePeserta($gender)
    {
        
        $query = DB::table('peserta as p')
                    ->select('p.id', 'p.nama_komunitas as nama_komunitas_personal', 'k.nama as nama_komunitas', 'p.nama', 'p.gender', 'p.phone', 'p.telp_emergency', 'p.hubungan_emergency', 'p.kota')
                    ->leftJoin('komunitas as k', 'p.id_komunitas', '=', 'k.id')
                    ->where('p.delete_at', null);

        if($gender) {
            $query->where('p.gender', $gender);
        }

        return $query;
    }

    public function editPeserta($id)
    {
        $query = DB::table('peserta as p')
                    ->select('p.*', 'p.nama_komunitas as nama_komunitas_personal', 'k.nama as nama_komunitas')
                    ->leftJoin('komunitas as k', 'p.id_komunitas', '=', 'k.id')
                    ->first();

        return $query;
    }
}
