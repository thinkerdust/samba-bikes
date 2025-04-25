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
        $event = DB::table('event')->where('status', 2)->first();
        $id_event = isset($event) ? $event->id : 0;
        $order = DB::table('order')
                ->where('id_event', $id_event)->where('status', 2)
                ->selectRaw("SUM(jumlah) as jumlah, SUM(subtotal) as revenue, COUNT(id) as total_order")
                ->groupBy('id_event')
                ->first();
        $komunitas = DB::table('order as o')
                        ->join('order_detail as od', 'o.nomor', '=', 'od.nomor_order')
                        ->join('peserta as p', 'od.id_peserta', '=', 'p.id')
                        ->join('komunitas as k', 'p.id_komunitas', '=', 'k.id')
                        ->where([['o.id_event', $id_event], ['o.status', 2]])
                        ->selectRaw("SUM(k.id) as total_komunitas")
                        ->groupBy('o.id_event')
                        ->first();
        $data = [
            'total_peserta' => isset($order) ? $order->jumlah : 0 ,
            'total_order' => isset($order) ? $order->total_order : 0 ,
            'total_revenue' => isset($order) ? $order->revenue : 0 ,
            'total_komunitas' => isset($komunitas) ? $komunitas->total_komunitas : 0 ,
        ];
        return $this->ajaxResponse(true, 'Berhasil', $data);
    }
}
