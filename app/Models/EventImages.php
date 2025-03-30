<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EventImages extends Model
{
    public $timestamps = false;
    protected $table = 'event_images';

    protected $fillable = [
        'id_event',
        'filename', 
        'size',
        'insert_at',
        'insert_by'
    ];
}
