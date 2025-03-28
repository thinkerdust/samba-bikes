<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class EventSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('event')->insert([
            [
                'nama' => 'Marathon 2025',
                'tanggal' => date('Y-m-t'),
                'deskripsi' => 'Event marathon tahunan.',
                'lokasi' => 'Jakarta',
                'tanggal_mulai' => date('Y-m-01'),
                'tanggal_selesai' => date('Y-m-t'),
                'harga' => 250000,
                'stok' => 500,
                'nomor_rekening' => '1234567890',
                'nama_rekening' => 'John Doe',
                'bank' => 'BCA',
                'phone' => '081234567890',
                'email' => 'admin@example.com',
                'banner' => null,
                'size_chart' => null,
                'rute' => null,
                'status' => 1,
                'insert_at' => now(),
                'insert_by' => 1,
                'update_at' => null,
                'update_by' => null,
            ],
            [
                'nama' => 'Trail Run 2025',
                'tanggal' => date('Y-m-t'),
                'deskripsi' => 'Event lari lintas alam.',
                'lokasi' => 'Bandung',
                'tanggal_mulai' => date('Y-m-01'),
                'tanggal_selesai' => date('Y-m-t'),
                'harga' => 300000,
                'stok' => 300,
                'nomor_rekening' => '0987654321',
                'nama_rekening' => 'Jane Doe',
                'bank' => 'Mandiri',
                'phone' => '081298765432',
                'email' => 'admin2@example.com',
                'banner' => null,
                'size_chart' => null,
                'rute' => null,
                'status' => 1,
                'insert_at' => now(),
                'insert_by' => 1,
                'update_at' => null,
                'update_by' => null,
            ],
        ]);
    }
}
