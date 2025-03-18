<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class Order extends Model
{
    public $timestamps = false;
    protected $table = 'order';

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
                    ->select('order.id', 'order.nomor', 'order.jumlah', 'order.total', 'order.status', 'event.nama as nama_event');

        if($event) {
            $query->where('order.id_event', $event);
        }

        return $query;
    }

    public function detailOrder($id)
    {
        $query = DB::table('order')
                    ->join('order_detail as od', 'order.nomor', '=', 'od.nomor_order')
                    ->join('peserta as p', 'od.id_peserta', '=', 'p.id')
                    ->where('order.id', $id)
                    ->select('od.id', 'od.nomor_order', 'od.id_peserta', 'p.nama as nama_peserta', 'od.size', 'od.status')
                    ->get();

        return $query;
    }
    public function editOrder($id)
    {
        $query = DB::table('order')
                    ->where('order.id', $id)
                    ->select('order.*')
                    ->first();

        return $query;
    }
}
