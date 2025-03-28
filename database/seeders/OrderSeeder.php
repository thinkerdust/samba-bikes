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
                'tanggal_bayar' => null,
                'jumlah' => 1,
                'total' => 250000,
                'status' => 1,
                'approve_at' => null,
                'approve_by' => null,
                'insert_at' => now(),
                'update_at' => now(),
                'update_by' => null,
            ],
            [
                'nomor' => 'ORD/250801/0002',
                'id_event' => 2,
                'tanggal_bayar' => null,
                'jumlah' => 1,
                'total' => 300000,
                'status' => 1,
                'approve_at' => null,
                'approve_by' => null,
                'insert_at' => now(),
                'update_at' => null,
                'update_by' => null,
            ],
        ]);
    }
}
