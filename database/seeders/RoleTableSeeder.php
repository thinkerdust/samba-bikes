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
                'nama' => 'programmer',
                'status' => 1,
                'insert_at' => now(),
                'insert_by' => 1
            ],
            [
                'nama' => 'superadmin',
                'status' => 1,
                'insert_at' => now(),
                'insert_by' => 1
            ]
        ]);
    }
}
