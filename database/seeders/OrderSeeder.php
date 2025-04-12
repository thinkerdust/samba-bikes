<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class OrderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('order')->insert([
            [
                'nomor' => 'ORD/250601/0001',
                'id_event' => 1,
                'jumlah' => 1,
                'subtotal' => 250000,
                'kode_unik' => 345,
                'total' => 250345,
                'status' => 1,
                'insert_at' => now(),
            ],
            [
                'nomor' => 'ORD/250801/0002',
                'id_event' => 2,
                'jumlah' => 1,
                'subtotal' => 300000,
                'kode_unik' => 122,
                'total' => 300122,
                'status' => 1,
                'insert_at' => now(),
            ],
        ]);
    }
}
