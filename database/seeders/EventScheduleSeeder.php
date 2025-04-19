<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class EventScheduleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('event_schedule')->insert([
            [
                'id_event'   => 1,
                'nama'       => 'Opening Ceremony & Warm-up',
                'deskripsi'  => 'Kick off the event with an energizing warm-up session, race briefing, and an inspiring welcome speech.',
                'jam'        => '09:00:00',
                'insert_at'  => '2025-04-19 06:22:03',
                'insert_by'  => 2,
                'update_at'  => null,
                'update_by'  => null,
            ],
            [
                'id_event'   => 1,
                'nama'       => 'Main Cycling Event',
                'deskripsi'  => 'Ride through scenic routes, challenge yourself, and enjoy the thrill of the race with fellow cyclists.',
                'jam'        => '11:00:00',
                'insert_at'  => '2025-04-19 06:23:13',
                'insert_by'  => 2,
                'update_at'  => null,
                'update_by'  => null,
            ],
            [
                'id_event'   => 1,
                'nama'       => 'Break & Refreshments',
                'deskripsi'  => 'Recharge with snacks and drinks while mingling with other participants and sharing experiences.',
                'jam'        => '13:00:00',
                'insert_at'  => '2025-04-19 06:23:29',
                'insert_by'  => 2,
                'update_at'  => null,
                'update_by'  => null,
            ],
            [
                'id_event'   => 1,
                'nama'       => 'Awards & Closing Ceremony',
                'deskripsi'  => 'Celebrate achievements with an award presentation and closing remarks, marking the end of an unforgettable event.',
                'jam'        => '14:00:00',
                'insert_at'  => '2025-04-19 06:23:53',
                'insert_by'  => 2,
                'update_at'  => null,
                'update_by'  => null,
            ],
        ]);
    }
}
