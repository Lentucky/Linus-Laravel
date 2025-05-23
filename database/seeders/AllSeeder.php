<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Genre;
use App\Models\Movie;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
class AllSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {   
        User::updateOrCreate([
            'email' => 'admin@example.com',
        ], [
            'name' => 'Admin Tester',
            'password' => Hash::make('password'),
            'role' => 'admin',
        ]);
        User::updateOrCreate([
            'email' => 'customer@example.com',
        ], [
            'name' => 'customer Tester',
            'password' => Hash::make('password'),
            'role' => 'customer',
        ]);        
        Genre::create([
            'name' => 'Action'
        ]);

        Genre::create([
            'name' => 'Adventure'
        ]);

        Genre::create([
            'name' => 'Animation'
        ]);

        Genre::create([
            'name' => 'Biography'
        ]);

        Genre::create([
            'name' => 'Comedy'
        ]);

        Genre::create([
            'name' => 'Crime'
        ]);

        Genre::create([
            'name' => 'Documentary'
        ]);

        Genre::create([
            'name' => 'Drama'
        ]);

        Genre::create([
            'name' => 'Family'
        ]);

        Genre::create([
            'name' => 'Fantasy'
        ]);

        Genre::create([
            'name' => 'History'
        ]);

        Genre::create([
            'name' => 'Horror'
        ]);

        Genre::create([
            'name' => 'Musical'
        ]);

        Genre::create([
            'name' => 'Mystery'
        ]);

        Genre::create([
            'name' => 'Romance'
        ]);

        Genre::create([
            'name' => 'Sci-Fi'
        ]);

        Genre::create([
            'name' => 'Sport'
        ]);

        Genre::create([
            'name' => 'Thriller'
        ]);

        Genre::create([
            'name' => 'War'
        ]);

        Genre::create([
            'name' => 'Western'
        ]);
        //Showtime::factory()->count(10)->create();
        //Seat::factory()->count(10)->create(); 
        
    }
}
