<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class EventSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('events')->insert([
            [
                'title' => 'Laravel Conference',
                'venue' => 'Mumbai Convention Center',
                'seats_count' => 0,
                'event_date' => '2025-03-15 10:00:00',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'title' => 'PHP Meetup',
                'venue' => 'Delhi Tech Park',
                'seats_count' => 15,
                'event_date' => '2025-04-10 14:00:00',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'title' => 'Web Development Bootcamp',
                'venue' => 'Bangalore IT Hub',
                'seats_count' => 30,
                'event_date' => '2025-05-20 09:00:00',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'title' => 'AI & ML Workshop',
                'venue' => 'Hyderabad Innovation Hub',
                'seats_count' => 25,
                'event_date' => '2025-06-05 11:30:00',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'title' => 'Startup Pitch Event',
                'venue' => 'Chennai Business Hall',
                'seats_count' => 7,
                'event_date' => '2025-07-01 16:00:00',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
        ]);
        
    }
}
