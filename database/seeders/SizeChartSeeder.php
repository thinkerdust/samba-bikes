<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SizeChartSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('size_chart')->insert([
            ['nama' => 'XS'],
            ['nama' => 'S'],
            ['nama' => 'M'],
            ['nama' => 'L'],
            ['nama' => 'XL'],
            ['nama' => 'XXL'],
        ]);
    }
}
