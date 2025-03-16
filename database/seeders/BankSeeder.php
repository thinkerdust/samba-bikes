<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BankSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('bank')->insert([
            ['nama' => 'MANDIRI'],
            ['nama' => 'BRI'],
            ['nama' => 'BNI'],
            ['nama' => 'BCA'],
            ['nama' => 'CIMB NIAGA'],
            ['nama' => 'DANAMON'],
        ]);
    }
}
