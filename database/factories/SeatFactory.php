<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\Showtime;
/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class SeatFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'showtime_id' => Showtime::inRandomOrder()->first()->id,
            'seat_number' => fake()->unique()->randomDigit(),
            'is_booked' => fake()->boolean()
        ];
    }
}
