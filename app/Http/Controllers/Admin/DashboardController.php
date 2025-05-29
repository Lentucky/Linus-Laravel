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
        $movies = Movie::all();
        $showtimes = Showtime::all();
        $currentshowing = Showtime::whereDate('screening_date', Carbon::today())->get();
        //dd(Carbon::today());
        $upcomingshowing = Showtime::where('screening_date', '>', Carbon::today())->get();
        $pastshowing = Showtime::where('screening_date', '<', Carbon::today())->orderBy('movie_id', 'ASC')->paginate(3);

        $seats = Seat::all();
        return view('admin.dashboard', compact('movies', 'showtimes' , 'currentshowing', 'upcomingshowing', 'pastshowing', 'seats'));
    }
}
