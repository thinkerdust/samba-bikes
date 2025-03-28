<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->insert([
            [
                'username' => 'thinkerdust',
                'name' => 'Thinkerdust',
                'email' => 'thinkerdust.dev@gmail.com',
                'password' => '$2y$12$mClJu24M2AZigk3CDhK.7.d1fZHBr6sHwcKa4nUlCynfSKrHnnGJq', // Already hashed
                'id_role' => 1,
                'level' => 1,
                'status' => 1,
                'created_at' => now(),
                'created_by' => 1
            ],
            [
                'username' => 'beta',
                'name' => 'beta',
                'email' => 'beta@mail.com',
                'password' => '$2y$12$mClJu24M2AZigk3CDhK.7.d1fZHBr6sHwcKa4nUlCynfSKrHnnGJq', // Already hashed
                'id_role' => 1,
                'level' => 1,
                'status' => 1,
                'created_at' => now(),
                'created_by' => 1
            ]
        ]);
    }
}
