<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // automatically generated menu seeder
        $this->call(MenuSeeder::class);

        // automatically generated role seeder
        $this->call(RoleTableSeeder::class);

        // automatically generated user seeder
        $this->call(UsersTableSeeder::class);

        // automatically generated akses role seeder
        $this->call(AksesRoleSeeder::class);

    }
}
