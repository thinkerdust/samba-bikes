<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class Order extends Model
{
    public $timestamps = false;
    protected $table = 'order';
    protected $primaryKey = 'id';
    protected $fillable = [
        'nomor',
        'id_event',
        'tanggal_bayar',
        'jumlah',
        'total',
        'status',
        'approve_at',
        'approve_by',
        'updated_at',
        'updated_by'
    ];

    public function dataTableOrder($start_date, $end_date, $event)
    {
        $start_date = Carbon::createFromFormat('d/m/Y', $start_date);
        $start_date = $start_date->format('Y-m-d');

        $end_date = Carbon::createFromFormat('d/m/Y', $end_date);
        $end_date = $end_date->format('Y-m-d');

        $query = DB::table('order')
                    ->join('event', 'order.id_event', '=', 'event.id')
                    ->whereBetween('order.insert_at', [$start_date, $end_date])
                    ->where('order.status', '!=', 0)
                    ->select('order.id', 'order.nomor', 'order.jumlah', 'order.total', 'order.status', 'event.nama as nama_event',
                        DB::raw("DATE_FORMAT(order.insert_at, '%d/%m/%Y') as tanggal_order")
                    );

        if($event) {
            $query->where('order.id_event', $event);
        }

        return $query;
    }

    public function detailOrder($nomor)
    {
        $query = DB::table('order')
                    ->join('order_detail as od', 'order.nomor', '=', 'od.nomor_order')
                    ->join('peserta as p', 'od.id_peserta', '=', 'p.id')
                    ->where('order.nomor', $nomor)
                    ->select('od.id', 'od.nomor_order', 'od.id_peserta', 'p.nama as nama_peserta', 'p.size_jersey', 'p.phone', 'p.email');

        return $query;
    }

    public function dataTableRacepackOrder($nomor)
    {
        $query = DB::table('order_detail as od')
                    ->select([
                        'od.id',
                        'p.nama as nama_peserta',
                        'p.size_jersey',
                        DB::raw("DATE_FORMAT(od.racepack_at, '%d/%m/%Y') as racepack_at"),
                        'od.racepack_by'
                    ])
                    ->join('peserta as p', 'od.id_peserta', '=', 'p.id')
                    ->where('od.nomor_order', $nomor);

        return $query;
    }
}
