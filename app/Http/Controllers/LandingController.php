<?php

namespace App\Http\Controllers;

use App\Http\Controllers\BaseController as BaseController;
use Illuminate\Http\Request;

class LandingController extends BaseController {

    public function index() {
        $js = 'assets/js/apps/landing/landing.js?_='.rand();
        return view('landing.index', compact('js'));
    }
    
}
