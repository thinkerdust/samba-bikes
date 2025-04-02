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
                'tanggal' => date('Y-m-01'),
                'deskripsi' => 'Event marathon tahunan.',
                'lokasi' => 'Jakarta',
                'jarak' => 42,
                'lat_start' => '-6.200000',
                'long_start' => '106.816666',
                'lat_end' => '-6.200000',
                'long_end' => '106.816666',
                'tanggal_mulai' => date('Y-m-01'),
                'tanggal_selesai' => date('Y-m-t'),
                'harga' => 250000,
                'stok' => 500,
                'nomor_rekening' => '1234567890',
                'nama_rekening' => 'John Doe',
                'bank' => 'BCA',
                'phone' => '081234567890',
                'email' => 'admin@example.com',
                'status' => 1,
                'insert_at' => now(),
                'insert_by' => 1,
            ],
            [
                'nama' => 'Trail Run 2025',
                'tanggal' => date('Y-m-01'),
                'deskripsi' => 'Event lari lintas alam.',
                'lokasi' => 'Bandung',
                'jarak' => 21,
                'lat_start' => '-6.914744',
                'long_start' => '107.609810',
                'lat_end' => '-6.914744',
                'long_end' => '107.609810',
                'tanggal_mulai' => date('Y-m-01'),
                'tanggal_selesai' => date('Y-m-t'),
                'harga' => 300000,
                'stok' => 300,
                'nomor_rekening' => '0987654321',
                'nama_rekening' => 'Jane Doe',
                'bank' => 'Mandiri',
                'phone' => '081298765432',
                'email' => 'admin2@example.com',
                'status' => 1,
                'insert_at' => now(),
                'insert_by' => 1,
            ],
        ]);
    }
}
