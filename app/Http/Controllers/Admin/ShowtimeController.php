<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Showtime;
use App\Models\Genre;
class ShowtimeController extends Controller
{
    public function index(){
        $showtimes = Showtime::with('movie')->orderBy('created_at', 'DESC')->paginate(10);
        return view('admin.showtimes.index',[ 'showtimes' => $showtimes]);
    } 
    public function edit($id)
    {
        $showtime = Showtime::findOrFail($id);


        return view('admin.showtimes.edit', compact('showtime'));
    }
   
}
