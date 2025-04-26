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
                    ->select('id', 'nama', 'lokasi', 'jarak', 'lat_start', 'long_start', 'lat_end', 'long_end', 'harga', 'stok', 'status',
                        DB::raw("DATE_FORMAT(tanggal, '%d/%m/%Y') as tanggal"),
                        DB::raw("DATE_FORMAT(tanggal_mulai, '%d/%m/%Y') as tanggal_mulai"),
                        DB::raw("DATE_FORMAT(tanggal_selesai, '%d/%m/%Y') as tanggal_selesai")
                    )
                    ->orderBy('status', 'DESC');

        return $query;
    }

    public function editEvent($id)
    {
        $query = DB::table('event')
                    ->where('id', $id)
                    ->select('id', 'nama', 'kota', 'lokasi', 'jarak', DB::raw('DATE_FORMAT(jam_mulai_racepack, "%H:%i") as jam_mulai_racepack'), DB::raw('DATE_FORMAT(jam_selesai_racepack, "%H:%i") as jam_selesai_racepack'), 
                        'lat_start', 'long_start', 'lat_end', 'long_end', 'harga', 'stok', 'status', 'deskripsi', 'deskripsi_internal', 'bank', 'nomor_rekening', 'nama_rekening', 'phone', 'email', 'facebook', 'instagram', 'twitter', 'youtube',
                        'banner1', 'tagline_banner1', 'banner2', 'tagline_banner2', 'banner3', 'tagline_banner3', 'size_chart', 'rute',
                        DB::raw("DATE_FORMAT(tanggal, '%d/%m/%Y') as tanggal"),
                        DB::raw("DATE_FORMAT(tanggal_mulai, '%d/%m/%Y') as tanggal_mulai"),
                        DB::raw("DATE_FORMAT(tanggal_selesai, '%d/%m/%Y') as tanggal_selesai"),
                        DB::raw("DATE_FORMAT(tanggal_racepack, '%d/%m/%Y') as tanggal_racepack"),
                    )
                    ->first();

        return $query;
    }

    public function dataTableEventSchedule($id_event)
    {
        $query = DB::table('event_schedule')
                    ->where('id_event', [$id_event])
                    ->select('id', 'id_event', 'nama', 'deskripsi', DB::raw('DATE_FORMAT(jam, "%H:%i") as jam'))
                    ->orderBy('jam', 'ASC');

        return $query;
    }

    public function editSchedule($id)
    {
        $query = DB::table('event_schedule')
                    ->where('id', $id)
                    ->select('id', 'id_event', 'nama', 'deskripsi', DB::raw('DATE_FORMAT(jam, "%H:%i") as jam'))
                    ->first();

        return $query;
    }

}
