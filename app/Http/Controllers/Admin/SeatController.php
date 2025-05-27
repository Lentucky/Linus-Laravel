<?php

namespace App\Http\Controllers\Admin;
use Illuminate\Validation\ValidationException;
use Carbon\Carbon;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Seat;
use App\Models\Showtime;
class SeatController extends Controller
{
    public function index(){
        $seats = Seat::orderBy('showtime_id', 'ASC')->paginate(100); // size of the seats
        $showtimes = Showtime::all();
        return view('admin.seats.index', compact('seats', 'showtimes'));
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
            'seat_number'=> 'required|string', //'seat_number'=> 'required|integer|unique:seats,seat_number',
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
        $seat = Seat::findOrFail($id);
        $showtimes = Showtime::all();
        //dd($seat);
        return view('admin.seats.edit', [ 'seat' => $seat, 'showtimes' => $showtimes]);
    }

    public function storeedit(Request $request){
        //dd($request->all());
        $validated = $request->validate([
            'id' => 'required|exists:seats,id',
            'showtime_id' => 'required|exists:showtimes,id',
            'seat_number'=> 'required|string',  //changed to string to accomdate A1,B5,C6.
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
        //dd($request->all());
        //$query = Seat::query();
        $query = $request->showtime_id;
        $showtimes = Showtime::all();
        //dd($query);
       
        //dd($query->get());

        
      $seats = Seat::when($query, function ($q) use ($query) {
        if (is_numeric($query)) {
            $q->where('showtime_id', $query);
        } 
        })->orderBy('showtime_id', 'ASC')->paginate(100);
        

        
        //dd($seats);
        return view('admin.seats.index', compact('seats', 'query', 'showtimes'));
    } 

    /*
    
    public function search(Request $request)
    {
        $query = $request->input('search');
        $showtimes = Showtime::all();
        $militaryTime = null;

        if ($query) {
            // Try parsing as 12-hour time with AM/PM
            try {
                $militaryTime = Carbon::createFromFormat('h:i A', strtoupper($query))->format('H:i');
            } catch (\Exception $e) {
                // If parsing fails, keep $militaryTime null
                $militaryTime = null;
            }
        }        

        $seats = Seat::when($query, function ($q) use ($query, $militaryTime) {  //remove showtime if not used gonna TODO check if ok
            $q->where('seat_number', 'LIKE', "%{$query}%")->orWhereHas('showtime', function ($q) use ($query, $militaryTime) {
                if ($militaryTime) {
                    // If military time was successfully parsed, search exact or LIKE by military time
                    $q->where('start_time', 'LIKE', "%{$militaryTime}%");
                } else {
                    // Otherwise fallback to searching original query (useful if user typed 24-hour or partial time)
                    $q->where('start_time', 'LIKE', "%{$query}%");
                }
            })->orWhereHas('showtime.movie', function ($q) use ($query) {
            $q->where('title', 'LIKE', "%{$query}%");
        });
        })->orderBy('showtime_id', 'ASC')->paginate(100);

        return view('admin.seats.index', compact('seats', 'query', 'showtimes'));
    } 
        */
    

}
