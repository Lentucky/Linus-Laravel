<?php

namespace App\Http\Controllers\Guest;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Movie;
use Carbon\Carbon;

class UpcomingController extends Controller
{
    //
    public function index()
    {
        $movies = Movie::whereHas('showtimes', function ($query) {
            $query->where('screening_date', '>', Carbon::today()->addWeeks(4));
        })->get();

        return view('guest.upcoming', compact('movies'));
    }
}
