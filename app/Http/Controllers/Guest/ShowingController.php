<?php

namespace App\Http\Controllers\Guest;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Movie;
use Carbon\Carbon;

class ShowingController extends Controller
{
    //
        public function index()
    {
        $movies = Movie::whereHas('showtimes', function ($query) {
            $query->whereBetween('screening_date', [Carbon::today(), Carbon::today()->addWeeks(4)]);
        })->get();

        return view('guest.showing', compact('movies'));
    }
}
