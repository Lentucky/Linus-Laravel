<?php
namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Models\Movie;
use Carbon\Carbon;
class UpcomingController extends Controller
{
    public function index()
    {
        $movies = Movie::whereHas('showtimes', function ($query) {
            $query->where('showtimes.screening_date', '>', Carbon::today()); // Change `date` to your actual column
        })
        ->get();
        //dd($movies);
        return view('customer.upcoming', compact('movies'));
    }
}
