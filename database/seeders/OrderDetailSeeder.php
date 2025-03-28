<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class OrderDetailSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('order_detail')->insert([
            [
                'nomor_order' => 'ORD/250601/0001',
                'id_peserta' => 1,
                'racepack_at' => '2025-06-10 08:00:00',
                'racepack_by' => 2,
                'insert_at' => now(),
                'update_at' => now(),
                'update_by' => 2,
            ],
            [
                'nomor_order' => 'ORD/250801/0002',
                'id_peserta' => 2,
                'racepack_at' => null,
                'racepack_by' => null,
                'insert_at' => now(),
                'update_at' => null,
                'update_by' => null,
            ],
        ]);
    }
}
