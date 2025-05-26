<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Movie;
use App\Models\Showtime;
use App\Models\Seat;
class DashboardController extends Controller
{
    public function index()
    {
        $movies = Movie::all();
        $showtimes = Showtime::all();
        $seats = Seat::all();
        return view('admin.dashboard', compact('movies', 'showtimes', 'seats'));
    }
}
