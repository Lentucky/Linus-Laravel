<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

use App\Models\Movie;
use Carbon\Carbon;
class ShowingController extends Controller
{
    public function index()
    {
        $movies = Movie::whereHas('showtimes', function ($query) {
            $query->whereDate('showtimes.screening_date', Carbon::today()); // Change `date` to your actual column
        })
        ->get();
        //dd($movies);
        return view('customer.showing', compact('movies'));
    }
}
