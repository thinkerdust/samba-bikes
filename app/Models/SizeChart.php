<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SizeChart extends Model
{
    public $timestamps = false;
    protected $table = 'size_chart';
    protected $fillable = [
        'id',
        'nama',
        'status'
    ];

    public function dataTableSizeChart()
    {
        return self::select('id', 'nama', 'status')->orderBy('nama', 'asc')->get();
    }
}
