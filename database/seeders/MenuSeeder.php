<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MenuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('menu')->insert([
            [
                'id' => 1,
                'kode' => 'UM',
                'kode_parent' => '0',
                'nama' => 'User Management',
                'icon' => 'ni ni-users-fill',
                'url' => "/admin/user-management",
                'status' => 1,
                'insert_at' => '2024-06-07 23:54:42',
                'insert_by' => '1',
                'update_at' => '2024-11-16 16:04:51',
                'update_by' => '1',
            ],
            [
                'id' => 2,
                'kode' => 'UM1',
                'kode_parent' => 'UM',
                'nama' => 'User',
                'icon' => 'ni ni-single-02',
                'url' => '/admin/user-management',
                'status' => 1,
                'insert_at' => '2024-06-07 23:54:42',
                'insert_by' => '1',
                'update_at' => null,
                'update_by' => null,
            ],
            [
                'id' => 3,
                'kode' => 'UM2',
                'kode_parent' => 'UM',
                'nama' => 'Menu',
                'icon' => 'ni ni-bullet-list-67',
                'url' => '/admin/user-management/menu',
                'status' => 1,
                'insert_at' => '2024-06-07 23:57:35',
                'insert_by' => '1',
                'update_at' => null,
                'update_by' => null,
            ],
            [
                'id' => 4,
                'kode' => 'UM3',
                'kode_parent' => 'UM',
                'nama' => 'Role',
                'icon' => 'ni ni-key-25',
                'url' => '/admin/user-management/role',
                'status' => 1,
                'insert_at' => '2024-06-07 23:58:21',
                'insert_by' => '1',
                'update_at' => null,
                'update_by' => null,
            ],
            [
                'id' => 5,
                'kode' => 'EVENT',
                'kode_parent' => '0',
                'nama' => 'Event',
                'icon' => 'ni ni-bag-fill',
                'url' => '/event',
                'status' => 1,
                'insert_at' => '2024-11-16 22:14:04',
                'insert_by' => '1',
                'update_at' => '2024-11-16 22:21:15',
                'update_by' => '1',
            ],
        ]);
    }
}
