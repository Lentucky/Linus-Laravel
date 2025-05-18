<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CinemaSeats;
class CinemaSeatsController extends Controller
{


    // connect to frontend
    public function index(){

        return view('cinemaseats.index'); //to be renamed
    }
    //display database data cinemaseats
    public function cinemaseats(){

        $cinemaseats = CinemaSeats::all();

        return view('');
    }


}
