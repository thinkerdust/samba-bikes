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
                'kode' => 'UM',
                'kode_parent' => '0',
                'nama' => 'User Management',
                'icon' => 'ni ni-users-fill',
                'url' => '',
                'status' => 1,
                'insert_at' => now(),
                'insert_by' => 1,
            ],
            [
                'kode' => 'UM1',
                'kode_parent' => 'UM',
                'nama' => 'User',
                'icon' => '',
                'url' => '/admin/user-management',
                'status' => 1,
                'insert_at' => now(),
                'insert_by' => 1
            ],
            [
                'kode' => 'UM2',
                'kode_parent' => 'UM',
                'nama' => 'Menu',
                'icon' => '',
                'url' => '/admin/user-management/menu',
                'status' => 1,
                'insert_at' => now(),
                'insert_by' => 1
            ],
            [
                'kode' => 'UM3',
                'kode_parent' => 'UM',
                'nama' => 'Role',
                'icon' => '',
                'url' => '/admin/user-management/role',
                'status' => 1,
                'insert_at' => now(),
                'insert_by' => 1
            ],
            [
                'kode' => 'MS',
                'kode_parent' => '0',
                'nama' => 'Master Management',
                'icon' => 'ni ni-home-fill',
                'url' => '',
                'status' => 1,
                'insert_at' => now(),
                'insert_by' => 1,
            ],
            [
                'kode' => 'MS1',
                'kode_parent' => 'MS',
                'nama' => 'Size Chart',
                'icon' => '',
                'url' => '/admin/master-management/size-chart',
                'status' => 1,
                'insert_at' => now(),
                'insert_by' => 1
            ],
            [
                'kode' => 'MS2',
                'kode_parent' => 'MS',
                'nama' => 'Bank',
                'url' => '/admin/master-management/bank',
                'icon' => '',
                'status' => 1,
                'insert_at' => now(),
                'insert_by' => 1
            ],
            [
                'kode' => 'EVENT',
                'kode_parent' => '0',
                'nama' => 'Event',
                'icon' => 'ni ni-flag-fill',
                'url' => '/admin/event',
                'status' => 1,
                'insert_at' => now(),
                'insert_by' => 1
            ],
            [
                'kode' => 'PESERTA',
                'kode_parent' => '0',
                'nama' => 'Peserta',
                'icon' => 'ni ni-user-list-fill',
                'url' => '/admin/peserta',
                'status' => 1,
                'insert_at' => now(),
                'insert_by' => 1
            ],
            [
                'kode' => 'ORDER',
                'kode_parent' => '0',
                'nama' => 'Order',
                'icon' => 'ni ni-ticket-alt-fill',
                'url' => '/admin/order',
                'status' => 1,
                'insert_at' => now(),
                'insert_by' => 1
            ],
        ]);
    }
}
