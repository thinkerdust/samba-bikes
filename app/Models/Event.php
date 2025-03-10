<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class Event extends Model
{
    public $timestamps = false;
    protected $table = 'event';

    public function dataTableEvent($start_date, $end_date)
    {
        $start_date = Carbon::createFromFormat('d/m/Y', $start_date);
        $start_date = $start_date->format('Y-m-d');

        $end_date = Carbon::createFromFormat('d/m/Y', $end_date);
        $end_date = $end_date->format('Y-m-d');

        $query = DB::table('event')
                    ->whereBetween('tanggal', [$start_date, $end_date])
                    ->select('kode', 'nama', 'lokasi', 'harga', 'stok', 'status',
                        DB::raw("DATE_FORMAT(tanggal, '%d/%m/%Y') as tanggal"),
                        DB::raw("DATE_FORMAT(tanggal_mulai, '%d/%m/%Y') as tanggal_mulai"),
                        DB::raw("DATE_FORMAT(tanggal_selesai, '%d/%m/%Y') as tanggal_selesai")
                    );

        return $query;
    }

    public function editEvent($kode)
    {
        $query = DB::table('event')
                    ->where('kode', $kode)
                    ->select('kode', 'nama', 'lokasi', 'harga', 'stok', 'status', 'deskripsi',
                        DB::raw("DATE_FORMAT(tanggal, '%d/%m/%Y') as tanggal"),
                        DB::raw("DATE_FORMAT(tanggal_mulai, '%d/%m/%Y') as tanggal_mulai"),
                        DB::raw("DATE_FORMAT(tanggal_selesai, '%d/%m/%Y') as tanggal_selesai")
                    )
                    ->first();

        return $query;
    }
}
