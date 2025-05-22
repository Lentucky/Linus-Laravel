<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Showtime;
class ShowtimeController extends Controller
{
    public function index(){
        $showtimes = Showtime::orderBy('created_at', 'DESC')->paginate(10);
        return view('admin.showtimes.index',[ 'showtimes' => $showtimes]);
    }    
}
