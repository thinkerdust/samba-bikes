<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class KomunitasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('komunitas')->insert([
            [
                'nama' => 'Runners Jakarta',
                'koordinator' => 'Andi Wijaya',
                'email' => 'andi@runnersjakarta.com',
                'kota' => 'Jakarta',
                'phone' => '081234567890',
                'status' => 1,
                'insert_at' => now(),
                'update_at' => null,
                'update_by' => null
            ],
            [
                'nama' => 'Bandung Marathon Club',
                'koordinator' => 'Rina Suryani',
                'email' => 'rina@bandungmarathon.com',
                'kota' => 'Bandung',
                'phone' => '081345678901',
                'status' => 1,
                'insert_at' => now(),
                'update_at' => null,
                'update_by' => null
            ],
        ]);
    }
}
