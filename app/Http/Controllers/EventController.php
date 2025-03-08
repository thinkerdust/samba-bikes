<?php

namespace App\Http\Controllers;

use App\Http\Controllers\BaseController as BaseController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use App\Models\Event;
use Carbon\Carbon;
use Yajra\DataTables\DataTables;

class EventController extends BaseController
{
    protected $event;
    protected $order;
    protected $order_detail;

    function __construct(Event $event)
    {
        $this->event = $event;
    }

    public function index()
    {
        $title  = 'Event';
        $js     = 'js/apps/administrasi/index.js?_='.rand();
        return view('administrasi.index', compact('js', 'title'));
    }
}
