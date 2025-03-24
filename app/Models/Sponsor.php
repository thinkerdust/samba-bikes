<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Sponsor extends Model
{
    public $timestamps = false;
    protected $table = 'sponsor';

    protected $fillable = [
        'id_event',
        'filename', 
        'status', 
        'insert_at',
        'insert_by',
        'update_at', 
        'update_by' 
    ];
}
