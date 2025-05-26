<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Showtime;
use App\Models\Movie;
class ShowtimeController extends Controller
{
    public function index(){
        //$showtimes = Showtime::with('movie')->orderBy('created_at', 'DESC')->paginate(10);
        $showtimes = Showtime::with('movie')->orderBy('created_at', 'DESC')->get();
        return view('admin.showtimes.index',[ 'showtimes' => $showtimes]);
    }
    public function create(){
        $movies = Movie::all();
        //$takenseats = Seat::where('is_booked', 0)->get();
        //dd($takenseats->all());
        return view('admin.showtimes.create',['movies' => $movies]);
    }
    public function store(Request $request){
            //dd($request->start_time);
            $validated = $request->validate([
                'movie_id' => 'required|exists:movies,id',
                'screening_date'=> 'required|date', 
                'start_time' => 'required|date_format:H:i'

            ]);

            //dd($validated);
            Showtime::create($validated);
            return redirect()->route('showtimes.index')->with('success',  "Showtime succesfully added");    //remove with if not gonna use     
        }     
    public function edit($id)
    {
        $showtime = Showtime::findOrFail($id);
        $movies = Movie::all();

        return view('admin.showtimes.edit', compact('showtime', 'movies'));
    }

    public function storeedit(Request $request, $id){
        //dd($request->all());
        $showtime = Showtime::findOrFail($id);
        //dd($showtime);
        $validated = $request->validate([
            'movie_id' => 'required|exists:movies,id',
            'screening_date'=> 'required|date', 
            'start_time' => 'required|date_format:H:i'

        ]);

        //dd($validated);
        $showtime->update($validated);
            
        return redirect()->route('showtimes.index')->with('success',  "Showtime succesfully updated");   //remove with if not gonna use         

    }

    public function delete(Showtime $showtime){
        $showtime->delete();

        return redirect()->route('showtimes.index')->with('success',  "Showtime succesfully deleted");
    }
   

    
}
