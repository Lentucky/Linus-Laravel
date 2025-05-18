<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Seat;
class SeatController extends Controller
{
    public function index(){
        $seats = Seat::all();
        return view('admin.seats.index',[ 'seats' => $seats]);
    }

    public function edit($id){
        $seat = Seat::where('id', $id)->first();
        //dd($seat);
        return view('admin.seats.edit', [ 'seat' => $seat]);
    }
}
