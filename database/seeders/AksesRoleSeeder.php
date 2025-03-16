<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AksesRoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('akses_role')->insert([
            [
                'id' => 1,
                'id_role' => 1,
                'kode_menu' => 'UM1',
                'flag_access' => 1,
                'insert_at' => '2024-06-08 00:18:47',
                'insert_by' => '1',
                'update_at' => null,
                'update_by' => null
            ],
            [
                'id' => 2,
                'id_role' => 1,
                'kode_menu' => 'UM2',
                'flag_access' => 1,
                'insert_at' => '2024-06-08 00:18:47',
                'insert_by' => '1',
                'update_at' => null,
                'update_by' => null
            ],
            [
                'id' => 3,
                'id_role' => 1,
                'kode_menu' => 'UM3',
                'flag_access' => 1,
                'insert_at' => '2024-06-08 00:18:47',
                'insert_by' => '1',
                'update_at' => null,
                'update_by' => null
            ],
            [
                'id' => 4,
                'id_role' => 1,
                'kode_menu' => 'EV',
                'flag_access' => 1,
                'insert_at' => '2024-06-08 00:18:47',
                'insert_by' => '1',
                'update_at' => null,
                'update_by' => null
            ],
            [
                'id' => 5,
                'id_role' => 1,
                'kode_menu' => 'PESERTA',
                'flag_access' => 1,
                'insert_at' => '2024-06-08 00:18:47',
                'insert_by' => '1',
                'update_at' => null,
                'update_by' => null
            ]
        ]);
    }
}
