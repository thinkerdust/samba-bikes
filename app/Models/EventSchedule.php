<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EventSchedule extends Model
{
    public $timestamps = false;
    protected $table = 'event_schedule';

    protected $fillable = [
        'id_event',
        'nama', 
        'deskripsi',
        'jam',
        'insert_at',
        'insert_by',
        'update_at',
        'update_by',
    ];
}
