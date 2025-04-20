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
                'kota' => 'Jakarta',
                'lokasi' => 'Jl. Janglidalam No. 1, Jakarta',
                'jarak' => 42,
                'tanggal_racepack' => date('Y-m-01'),
                'jam_mulai_racepack' => '08:00',
                'jam_selesai_racepack' => '17:00',
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
                'tagline_banner1' => 'Feel Your Burn',
                'tagline_banner2' => 'Feel Your Muscle',
                'tagline_banner3' => 'Feel Your Power',
                'status' => 2,
                'insert_at' => now(),
                'insert_by' => 1,
            ],
            [
                'nama' => 'Trail Run 2025',
                'tanggal' => date('Y-m-01'),
                'deskripsi' => 'Event lari lintas alam.',
                'kota' => 'Bandung',
                'lokasi' => 'Jl. Gunung No. 1, Bandung',
                'jarak' => 21,
                'tanggal_racepack' => date('Y-m-01'),
                'jam_mulai_racepack' => '08:00',
                'jam_selesai_racepack' => '17:00',
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
                'tagline_banner1' => 'Feel Your Burn',
                'tagline_banner2' => 'Feel Your Muscle',
                'tagline_banner3' => 'Feel Your Power',
                'status' => 1,
                'insert_at' => now(),
                'insert_by' => 1,
            ],
        ]);
    }
}
