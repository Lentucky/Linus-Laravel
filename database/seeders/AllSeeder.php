<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Genre;
use App\Models\Movie;
use App\Models\User;
use App\Models\Showtime;
use App\Models\Seat;
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
        Movie::create([
            'title' => 'The Shawshank Redemption',
            'description' => 'Two imprisoned men bond over a number of years, finding solace and eventual redemption through acts of common decency.',
            'duration' => 142,
            'genre_id' => 8 // Drama
        ]);

        Movie::create([
            'title' => 'The Godfather',
            'description' => 'The aging patriarch of an organized crime dynasty transfers control of his clandestine empire to his reluctant son.',
            'duration' => 175,
            'genre_id' => 6 // Crime
        ]);

        Movie::create([
            'title' => 'The Dark Knight',
            'description' => 'When the menace known as the Joker emerges, Batman must accept one of the greatest psychological and physical tests of his ability to fight injustice.',
            'duration' => 152,
            'genre_id' => 1 // Action
        ]);

        Movie::create([
            'title' => 'Pulp Fiction',
            'description' => 'The lives of two mob hitmen, a boxer, a gangster and his wife intertwine in tales of violence and redemption.',
            'duration' => 154,
            'genre_id' => 6 // Crime
        ]);

        Movie::create([
            'title' => 'Schindler\'s List',
            'description' => 'In German-occupied Poland, Oskar Schindler becomes concerned for his Jewish workforce after witnessing their persecution by the Nazis.',
            'duration' => 195,
            'genre_id' => 11 // History
        ]);

        Movie::create([
            'title' => 'Inception',
            'description' => 'A thief who steals corporate secrets through dream-sharing technology is given the inverse task of planting an idea into a CEO\'s mind.',
            'duration' => 148,
            'genre_id' => 16 // Sci-Fi
        ]);

        Movie::create([
            'title' => 'Fight Club',
            'description' => 'An insomniac office worker and a soapmaker form an underground fight club that evolves into something much more.',
            'duration' => 139,
            'genre_id' => 8 // Drama
        ]);

        Movie::create([
            'title' => 'Forrest Gump',
            'description' => 'The life journey of Forrest Gump, a slow-witted but kind-hearted man from Alabama who witnesses and unwittingly influences several historical events.',
            'duration' => 142,
            'genre_id' => 15 // Romance
        ]);

        Movie::create([
            'title' => 'The Matrix',
            'description' => 'A computer hacker learns the true nature of his reality and his role in the war against its controllers.',
            'duration' => 136,
            'genre_id' => 16 // Sci-Fi
        ]);

        Movie::create([
            'title' => 'The Lord of the Rings: The Return of the King',
            'description' => 'Gandalf and Aragorn lead the World of Men against Sauron\'s army to draw his gaze from Frodo and Sam as they approach Mount Doom with the One Ring.',
            'duration' => 201,
            'genre_id' => 10 // Fantasy
        ]);
      
        Showtime::factory()->count(10)->create();
         
        //Seat::factory()->create(); 
        
    }
}
