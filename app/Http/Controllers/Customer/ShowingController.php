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
            $query->whereBetween('showtimes.screening_date', [
                Carbon::today(),
                Carbon::today()->addWeeks(4)
            ]);
        })->get();

        return view('customer.showing', compact('movies'));
    }
}
