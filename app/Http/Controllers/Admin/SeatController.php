<?php

namespace App\Http\Controllers\Admin;
use Illuminate\Validation\ValidationException;
use Carbon\Carbon;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Seat;
use App\Models\Showtime;
use App\Models\Movie;
class SeatController extends Controller
{
    public function index(Request $request){
        $seats = Seat::all(); // size of the seats
        $allmovies = Movie::all();
        $movies = Movie::paginate(1);
        $allshowtimes = Showtime::all();
        $showtimes = Showtime::all();

        return view('admin.seats.index', compact('seats', 'showtimes', 'allshowtimes', 'allmovies', 'movies'));
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

    public function edit($id, Request $request){
        $seat = Seat::findOrFail($id);
        $showtimes = Showtime::all();
        $search = $request->input('search');
        $page = $request->input('page', 1);

        return view('admin.seats.edit', compact('seat', 'showtimes', 'search', 'page'));
    }

    public function storeedit(Request $request){
        //dd($request->all());
        $validated = $request->validate([
            'id' => 'required|exists:seats,id',
            'showtime_id' => 'required|exists:showtimes,id',
            'seat_number'=> 'required|string',  //changed to string to accomdate A1,B5,C6.
            'is_booked' => 'required|boolean'

        ]);
        $search = $request->input('search');
        $page = $request->input('page', 1);
        //dd($page);
        Seat::where('id', $request->id)->update($validated);
        //dd($search);
        if(!$search){
            return redirect()->route('seats.index', [
                'page' => $page
            ])->with('success',  "Seat succesfully updated");   //remove with if not gonna use         
        }
        return redirect()->route('seat.search', [
            'movie_id' => $search,
            'page' => $page
            ])->with('success',  "Seat succesfully updated");   //remove with if not gonna use         

    }

    public function delete(Seat $seat){
        $seat->delete();

        return redirect()->route('seats.index')->with('success',  "Seat succesfully deleted");
    }


    public function search(Request $request)
    {
        //dd($request->all());
        //$query = Seat::query();
        $query = $request->movie_id;
        $allshowtimes = Showtime::all();
        //dd($query);
        $allmovies = Movie::all();
        //dd($query->get());
        $seats = Seat::all();
        $showtimes = Showtime::when($query, function ($q) use ($query) {
                if (is_numeric($query)) {
                    $q->where('movie_id', $query);
                } 
                })->orderBy('id', 'ASC')->paginate(1);

        
        /*
        $seats = Seat::when($query, function ($q) use ($query) {
            if (is_numeric($query)) {
                $q->where('showtime_id', $query);
            } 
            })->orderBy('showtime_id', 'ASC')->paginate(100);
        */

        
        //dd($seats);
        return view('admin.seats.index', compact('seats', 'query', 'showtimes', 'allmovies'));
    }
        public function searchbyshowtime(Request $request)
    {
        //dd($request->all());
        //$query = Seat::query();
        $query = $request->showtime_id;
        //dd($query);
        $seats = Seat::all();
        $allmovies = Movie::all();
        $allshowtimes = Showtime::all();
        $movies = Movie::paginate(1);
        $page = $request->input('page', 1);
        //dd($page);
        $showtimes = Showtime::when($query, function ($q) use ($query) {
                if (is_numeric($query)) {
                    $q->where('id', $query);
                } 
                })->get();

        //dd($showtimes->get());
        /*
        $seats = Seat::when($query, function ($q) use ($query) {
            if (is_numeric($query)) {
                $q->where('showtime_id', $query);
            } 
            })->orderBy('showtime_id', 'ASC')->paginate(100);
        */

        
        //dd($seats);
        return view('admin.seats.index', compact('seats', 'query', 'showtimes', 'allshowtimes', 'movies', 'allmovies', 'page'));
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
    
    public function generateSeats($id){
        //add validation RESET ALL RELATED SEAT AT SHOWID, delete or update.
        
        $rows = range('A', 'J'); // Letters A to J for rows
        $columns = range(1, 10); // Numbers 1 to 10 for columns
            foreach ($rows as $row) {
                foreach ($columns as $col) {
                    Seat::create([
                        'showtime_id' => $id,
                        'seat_number' => $row . $col,
                        'is_booked' => false,
                    ]);
                }
            }
    return redirect()->route('seat.search', [
            'showtime_id' => $id,
            ])->with('success',  "Seat succesfully generated");   //remove with if not gonna use         
    }
}
