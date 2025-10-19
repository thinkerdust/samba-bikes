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
            ['nama' => '3XS'],
            ['nama' => '2XS'],
            ['nama' => 'XS'],
            ['nama' => 'S'],
            ['nama' => 'M'],
            ['nama' => 'L'],
            ['nama' => 'XL'],
            ['nama' => '2XL'],
            ['nama' => '3XL'],
            ['nama' => '4XL'],
            ['nama' => '5XL'],
        ]);
    }
}
