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
                'id_role' => 1,
                'kode_menu' => 'UM1',
                'flag_access' => 1,
                'insert_at' => now(),
                'insert_by' => 1,
            ],
            [
                'id_role' => 1,
                'kode_menu' => 'UM2',
                'flag_access' => 1,
                'insert_at' => now(),
                'insert_by' => 1
            ],
            [
                'id_role' => 1,
                'kode_menu' => 'UM3',
                'flag_access' => 1,
                'insert_at' => now(),
                'insert_by' => 1
            ],
            [
                'id_role' => 1,
                'kode_menu' => 'MS1',
                'flag_access' => 1,
                'insert_at' => now(),
                'insert_by' => 1
            ],
            [
                'id_role' => 1,
                'kode_menu' => 'EVENT',
                'flag_access' => 1,
                'insert_at' => now(),
                'insert_by' => 1
            ],
            [
                'id_role' => 1,
                'kode_menu' => 'PESERTA',
                'flag_access' => 1,
                'insert_at' => now(),
                'insert_by' => 1
            ],
            [
                'id_role' => 1,
                'kode_menu' => 'ORDER',
                'flag_access' => 1,
                'insert_at' => now(),
                'insert_by' => 1
            ],
            [
                'id_role' => 2,
                'kode_menu' => 'UM1',
                'flag_access' => 1,
                'insert_at' => now(),
                'insert_by' => 1,
            ],
            [
                'id_role' => 2,
                'kode_menu' => 'UM2',
                'flag_access' => 1,
                'insert_at' => now(),
                'insert_by' => 1
            ],
            [
                'id_role' => 2,
                'kode_menu' => 'UM3',
                'flag_access' => 1,
                'insert_at' => now(),
                'insert_by' => 1
            ],
            [
                'id_role' => 2,
                'kode_menu' => 'EVENT',
                'flag_access' => 1,
                'insert_at' => now(),
                'insert_by' => 1
            ],
            [
                'id_role' => 2,
                'kode_menu' => 'PESERTA',
                'flag_access' => 1,
                'insert_at' => now(),
                'insert_by' => 1
            ],
            [
                'id_role' => 2,
                'kode_menu' => 'ORDER',
                'flag_access' => 1,
                'insert_at' => now(),
                'insert_by' => 1
            ]
        ]);
    }
}
