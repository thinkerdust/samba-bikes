<?php

namespace App\Http\Controllers;

use App\Http\Controllers\BaseController as BaseController;
use Illuminate\Http\Request;
use DB;

class LandingController extends BaseController {

    public function index() {
        $js = 'assets/js/apps/landing/landing.js?_='.rand();
        return view('landing.index', compact('js'));
    }

    public function get_harga(Request $request) {
        $data = DB::table('event')->where('status', 1)->first();
        return response()->json($data);
    }

    public function register_peserta(Request $request) {
        dd($request->all());
        $data = $this->insert_data('peserta', $request->all());
        return response()->json($data);
    }
    
}
