<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Master;

class MasterController extends Controller
{
    function __construct()
    {
        $this->master = new Master();
    }

    public function list_data_role(Request $request)
    {
        $q = $request->get('q');
        $data = $this->master->listDataRole($q);
        return response()->json($data);
    }

    public function list_data_size_chart(Request $request)
    {
        $q = $request->get('q');
        $data = $this->master->listDataSizeChart($q);
        return response()->json($data);
    }

    public function list_data_bank(Request $request)
    {
        $q = $request->get('q');
        $data = $this->master->listDataBank($q);
        return response()->json($data);
    }

    public function list_data_event(Request $request)
    {
        $q          = $request->get('q');
        $release    = $request->get('release');

        $data = $this->master->listDataEvent($q, $release);
        return response()->json($data);
    }
}
