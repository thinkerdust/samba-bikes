<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PesertaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('peserta')->insert([
            [
                'id_komunitas' => 1,
                'id_event' => 1,
                'nama' => 'Budi Santoso',
                'phone' => '081234567890',
                'email' => 'budi@example.com',
                'tgl_lahir' => '1990-05-15',
                'nik' => '1234567890123456',
                'blood' => 'O',
                'kota' => 'Jakarta',
                'alamat' => 'Jl. Merdeka No. 10',
                'gender' => 'L',
                'nama_komunitas' => null,
                'telp_emergency' => '081298765432',
                'hubungan_emergency' => 'Saudara',
                'size_jersey' => 'M',
                'status' => 1,
                'insert_at' => now(),
                'update_at' => now(),
                'update_by' => 1,
            ],
            [
                'id_komunitas' => 2,
                'id_event' => 2,
                'nama' => 'Siti Aminah',
                'phone' => '081345678901',
                'email' => 'siti@example.com',
                'tgl_lahir' => '1995-08-21',
                'nik' => '9876543210987654',
                'blood' => 'A',
                'kota' => 'Bandung',
                'alamat' => 'Jl. Dipatiukur No. 20',
                'gender' => 'P',
                'nama_komunitas' => 'Runners Bandung',
                'telp_emergency' => '081376543210',
                'hubungan_emergency' => 'Orang Tua',
                'size_jersey' => 'L',
                'status' => 1,
                'insert_at' => now(),
                'update_at' => now(),
                'update_by' => 2,
            ],
        ]);
    }
}
