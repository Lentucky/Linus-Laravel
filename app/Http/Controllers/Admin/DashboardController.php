<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Movie;
use App\Models\Showtime;
use App\Models\Seat;
use Carbon\Carbon;
class DashboardController extends Controller
{
    public function index()
    {   
        //$movies = Movie::all();
        $showtimes = Showtime::all();
        $currentshowing = Movie::whereHas('showtimes', function ($query) {
            $query->whereBetween('screening_date', [Carbon::today(), Carbon::today()->addWeeks(4)]);
        })->get();
        //dd(Carbon::today());

        $upcomingshowing = Movie::whereHas('showtimes', function ($query) {
            $query->where('screening_date', '>', Carbon::today()->addWeeks(4));
        })->get();

        //$pastshowing = Showtime::where('screening_date', '<', Carbon::today())->orderBy('movie_id', 'ASC')->paginate(3);

        $seats = Seat::all();
        return view('admin.dashboard.dashboard', compact( 'showtimes' , 'currentshowing', 'upcomingshowing', 'seats'));
    }

    public function selectShowtime($movieId)
    {
        $movie = \App\Models\Movie::findOrFail($movieId);
        $showtimes = \App\Models\Showtime::where('movie_id', $movieId)->orderBy('screening_date')->get();

        return view('admin.dashboard.select-showtime', compact('movie', 'showtimes'));
    }
    public function selectSeat($showtimeId)
    {
        $showtime = \App\Models\Showtime::with('movie')->findOrFail($showtimeId);
        $seats = \App\Models\Seat::where('showtime_id', $showtimeId)->get();

        return view('admin.dashboard.select-seat', compact('showtime', 'seats'));
    }
    public function edit(Seat $seat)
    {
        return view('admin.dashboard.edit', compact('seat'));
    }
}
