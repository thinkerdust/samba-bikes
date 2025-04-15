<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;

class Counters extends Model
{
    public $timestamps = false;
    protected $table = 'counters';
    protected $fillable = [
        'id',
        'kode',
        'dates',
        'counters',
        'insert_at',
        'update_at'
    ];

    function generateKode($kode = 'ORD')
    {
        $currentDate = Carbon::now()->format('Ym'); 

        return DB::transaction(function () use ($kode, $currentDate) {
            $row = DB::table('counters')
                ->where('kode', $kode)
                ->where('dates', $currentDate)
                ->lockForUpdate() 
                ->first();

            if (!$row) {
                $counter = 1;
                DB::table('counters')->insert([
                    'kode' => $kode,
                    'dates' => $currentDate,
                    'counters' => str_pad($counter, 4, '0', STR_PAD_LEFT),
                    'insert_at' => now(),
                    'update_at' => now()
                ]);
            } else {
                $counter = (int)$row->counters + 1;

                DB::table('counters')
                    ->where('id', $row->id)
                    ->update([
                        'counters' => str_pad($counter, 4, '0', STR_PAD_LEFT),
                        'update_at' => now()
                    ]);
            }

            return $kode . '/' . $currentDate . '/' . str_pad($counter, 4, '0', STR_PAD_LEFT);
        });
    }
}
