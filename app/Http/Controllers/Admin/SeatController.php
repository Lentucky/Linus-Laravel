<?php

namespace App\Http\Controllers\Admin;
use Illuminate\Validation\ValidationException;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Seat;
use App\Models\Showtime;
class SeatController extends Controller
{
    public function index(){
        $seats = Seat::with('showtime')->orderBy('created_at', 'DESC')->paginate(10);
        return view('admin.seats.index',[ 'seats' => $seats]);
    }
    public function create(){
        $showtimes = Showtime::with('movie')->get();
        //$takenseats = Seat::where('is_booked', 0)->get();
        //dd($takenseats->all());
        return view('admin.seats.create',['showtimes' => $showtimes]);
    }
    public function store(Request $request){
        //dd($request->all());
        $countofbookedseat = Seat::where('showtime_id', $request->showtime_id)->where('seat_number', $request->seat_number)->get()->count();
        //dd($countofbookedseat);

        $validated = $request->validate([
            'showtime_id' => 'required|exists:showtimes,id',
            'seat_number'=> 'required|integer', //'seat_number'=> 'required|integer|unique:seats,seat_number',
            'is_booked' => 'required|boolean'

        ]);
        if( $countofbookedseat > 0){
            //dd($request->all());
            throw ValidationException::withMessages(['field_name' => 'This seat number '. $request->seat_number .' already exists in database at this Showtime ID:  '. $request->showtime_id]);
        };
        //dd($validated);
        Seat::create($validated);
        return redirect()->route('seats.index')->with('success',  "Seat succesfully added");    //remove with if not gonna use     
    }

    public function edit($id){
        $seat = Seat::where('id', $id)->first();
        $showtimes = Showtime::all();
        //dd($seat);
        return view('admin.seats.edit', [ 'seat' => $seat, 'showtimes' => $showtimes]);
    }

    public function storeedit(Request $request){
        //dd($request->all());
        $validated = $request->validate([
            'id' => 'required|exists:seats,id',
            'showtime_id' => 'required|exists:showtimes,id',
            'seat_number'=> 'required|integer',
            'is_booked' => 'required|boolean'

        ]);
        //dd($validated);
        Seat::where('id', $request->id)->update($validated);
            
        return redirect()->route('seats.index')->with('success',  "Seat succesfully updated");   //remove with if not gonna use         

    }

    public function delete(Seat $seat){
        $seat->delete();

        return redirect()->route('seats.index')->with('success',  "Seat succesfully deleted");
    }

    public function search(Request $request)
    {
        $query = $request->input('search');

        $seats = Seat::when(is_numeric($query), function ($q) use ($query) {
            $q->where('seat_number', $query)->Orwhere('showtime_id', $query); 
        })->paginate(10);

        return view('admin.seats.index', compact('seats', 'query'));
    }  
}
