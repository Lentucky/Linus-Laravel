<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Seat;
use App\Models\Showtime;
class SeatSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $rows = range('A', 'J'); // Letters A to J for rows
        $columns = range(1, 10); // Numbers 1 to 10 for columns
        foreach (Showtime::all() as $showtime) {
            foreach ($rows as $row) {
                foreach ($columns as $col) {
                    Seat::create([
                        'showtime_id' => $showtime->id,
                        'seat_number' => $row . $col,
                        'is_booked' => fake()->boolean(),
                    ]);
                }
            }
        }
    }
}
