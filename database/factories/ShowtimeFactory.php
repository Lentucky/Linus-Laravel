<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Showtime>
 */
class ShowtimeFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'movie_id' => fake()->unique()->numberBetween(1,100),
            'screening_date' => fake()->date($format = 'Y-m-d', $max = 'now'),
            'start_time' => fake()->time($format = 'H:i:s', $max = 'now')
        ];
    }
}
