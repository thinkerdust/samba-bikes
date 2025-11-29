<?php

namespace App\Http\Controllers;

use App\Http\Controllers\BaseController as BaseController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends BaseController
{
    public function index() 
    {
        $js_library = js_countup();
        $js         = 'assets/js/apps/dashboard/index.js?_='.rand();
        return view('dashboard.index', compact('js_library','js'));
    }

    public function data_dashboard()
    {
        $event      = DB::table('event')->where('status', 2)->first();
        $id_event   = isset($event) ? $event->id : 0;

        $order      = DB::table('order')
                        ->where('id_event', $id_event)->where('status', '<>', 0)
                        ->selectRaw("SUM(jumlah) as jumlah, COUNT(id) as total")
                        ->groupBy('id_event')
                        ->first();

        $revenue      = DB::table('order')
                        ->where('id_event', $id_event)->where('status', 2)
                        ->sum('total');

        $komunitas  = DB::table('order as o')
                        ->join('order_detail as od', 'o.nomor', '=', 'od.nomor_order')
                        ->join('peserta as p', 'od.id_peserta', '=', 'p.id')
                        ->join('komunitas as k', 'p.id_komunitas', '=', 'k.id')
                        ->where([['o.id_event', $id_event], ['o.status', '<>', 0], ['od.status', 1]])
                        ->selectRaw("COUNT(DISTINCT(k.id)) as total_komunitas")
                        ->first();

        $data = [
            'total_peserta'     => $order->jumlah ?? 0 ,
            'total_komunitas'   => $komunitas->total_komunitas ?? 0 ,
            'total_order'       => $order->total ?? 0 ,
            'total_revenue'     => $revenue
        ];
        return $this->ajaxResponse(true, 'Berhasil', $data);
    }
}
