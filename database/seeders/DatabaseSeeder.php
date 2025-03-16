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
        $this->call([
            MenuSeeder::class,
            RoleTableSeeder::class,
            UsersTableSeeder::class,
            AksesRoleSeeder::class,
            BankSeeder::class,
            SizeChartSeeder::class
        ]);
    }
}
