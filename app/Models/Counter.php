<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Counter extends Model
{
    public $timestamps = false;
    protected $table = 'counter';
    protected $fillable = [
        'id',
        'modul',
        'count'
    ];
}
