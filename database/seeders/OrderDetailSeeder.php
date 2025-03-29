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
                'insert_at' => now()
            ],
            [
                'nomor_order' => 'ORD/250801/0002',
                'id_peserta' => 2,
                'insert_at' => now()
            ],
        ]);
    }
}
