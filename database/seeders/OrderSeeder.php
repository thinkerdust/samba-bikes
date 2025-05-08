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
                'nomor' => 'ORD/202504/0001',
                'email' => 'sambabikes@mail.com',
                'id_event' => 1,
                'jumlah' => 1,
                'total' => 250011,
                'status' => 1,
                'insert_at' => now(),
            ],
            [
                'nomor' => 'ORD/202504/0002',
                'email' => 'sambabikes@mail.com',
                'id_event' => 2,
                'jumlah' => 1,
                'total' => 300122,
                'status' => 1,
                'insert_at' => now(),
            ],
        ]);
    }
}
