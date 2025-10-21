<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Bank extends Model
{
    public $timestamps = false;
    protected $table = 'bank';
    protected $fillable = [
        'id',
        'nama'
    ];

    public function dataTableBank()
    {
        return self::select('id', 'nama');
    }
}
