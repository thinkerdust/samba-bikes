<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RoleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('role')->insert([
            [
                'id' => 1,
                'nama' => 'programmer',
                'status' => 1,
                'insert_at' => '2024-11-16 14:27:14',
                'insert_by' => '1',
                'update_at' => '2024-12-27 22:44:22',
                'update_by' => '1',
            ],
            [
                'id' => 2,
                'nama' => 'superadmin',
                'status' => 1,
                'insert_at' => '2024-11-26 15:20:11',
                'insert_by' => '1',
                'update_at' => '2024-12-27 22:43:29',
                'update_by' => '1',
            ]
        ]);
    }
}
