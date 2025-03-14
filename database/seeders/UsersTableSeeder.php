<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->insert([
            [
                'id' => 1,
                'username' => 'thinkerdust',
                'name' => 'Thinkerdust',
                'email' => 'thinkerdust.dev@gmail.com',
                'password' => '$2y$12$mClJu24M2AZigk3CDhK.7.d1fZHBr6sHwcKa4nUlCynfSKrHnnGJq', // Already hashed
                'id_role' => 1,
                'level' => 1,
                'status' => 1,
                'created_at' => '2025-02-22 16:33:57',
                'created_by' => '1',
                'updated_at' => '2024-11-16 16:01:32',
                'updated_by' => '1',
            ],
            [
                'id' => 2,
                'username' => 'beta',
                'name' => 'beta',
                'email' => 'beta@mail.com',
                'password' => '$2y$12$mClJu24M2AZigk3CDhK.7.d1fZHBr6sHwcKa4nUlCynfSKrHnnGJq', // Already hashed
                'id_role' => 1,
                'level' => 1,
                'status' => 1,
                'created_at' => '2025-02-22 16:33:57',
                'created_by' => '1',
                'updated_at' => '2025-02-22 16:33:57',
                'updated_by' => '1',
            ]
        ]);
    }
}
