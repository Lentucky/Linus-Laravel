<?php

namespace App\Http\Controllers;
use App\Models\Movie;
use Carbon\Carbon;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    //
    public function index()
    {
        $today = Carbon::today();

        $showingMovies = Movie::whereHas('showtimes', function ($query) use ($today) {
            $query->whereBetween('screening_date', [$today, $today->copy()->addWeeks(4)]);
        })->with('genre')->get();

        $upcomingMovies = Movie::whereHas('showtimes', function ($query) use ($today) {
            $query->where('screening_date', '>', $today->copy()->addWeeks(4));
        })->with('genre')->get();

        return view('home', compact('showingMovies', 'upcomingMovies'));
    }
}
