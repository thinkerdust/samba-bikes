<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Master extends Model
{
    public function listDataRole($q)
    {
        $data = DB::table('role')->where('status', 1)->select('id', 'nama');
        if($q) {
            $data = $data->where('nama', 'like', '%'.$q.'%');
        }
        return $data->get();
    }

    public function listDataSizeChart($q)
    {
        $data = DB::table('size_chart')->select('nama as id', 'nama');
        if($q) {
            $data = $data->where('nama', 'like', '%'.$q.'%');
        }
        return $data->get();
    }

    public function listDataBank($q)
    {
        $data = DB::table('bank')->select('nama as id', 'nama');
        if($q) {
            $data = $data->where('nama', 'like', '%'.$q.'%');
        }
        return $data->get();
    }

    public function listDataEvent($q)
    {
        $data = DB::table('event')->select('id', 'nama');
        if($q) {
            $data = $data->where('nama', 'like', '%'.$q.'%');
        }
        return $data->get();
    }
}
