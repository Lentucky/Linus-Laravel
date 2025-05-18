<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Movie;

class MovieController extends Controller
{
    public function index(Request $request)
    {
        //Optional: search and filter
        $query = Movie::query();

        if ($request->has('genre')) {
            $query->where('genre_id', $request->input('genre'));
        }

        if ($request->has('search')) {
            $query->where('title', 'like', '%' . $request->input('search') . '%');
        }

        $movies = $query->with('genre', 'showtimes')->get();

        return view('customer.movies', compact('movies'));
    }
}
