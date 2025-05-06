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
                'nomor_urut' => 11,
                'subtotal' => 250011,
                'insert_at' => now()
            ],
            [
                'nomor_order' => 'ORD/250801/0002',
                'id_peserta' => 2,
                'nomor_urut' => 122,
                'subtotal' => 300122,
                'insert_at' => now()
            ],
        ]);
    }
}
