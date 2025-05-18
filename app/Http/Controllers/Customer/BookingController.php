<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use App\Models\Showtime;
use App\Models\Seat;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;

class BookingController extends Controller
{
    public function index(Request $request)
    {
        //List available showtimes and seats
        $showtimes = Showtime::with('movie')->orderBy('screening_date')->get();

        return view('customer.booking', compact('showtimes'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'showtime_id' => 'required|exists:showtimes,id',
            'seat_id' => 'required|exists:seats,id',
        ]);

        $seat = Seat::where('id', $request->seat_id)
                    ->where('showtime_id', $request->showtime_id)
                    ->where('is_booked', false)
                    ->first();

        if (!$seat) {
            return redirect()->back()->withErrors(['seat_id' => 'This seat is already booked.']);
        }

        
        $booking = Booking::create([            
            'user_id' => Auth::id(),
            'showtime_id' => $request->showtime_id,
            'seat_id' => $seat->id,
            'status' => 'confirmed',
            'booking_code' => strtoupper(Str::random(8)),
        ]);

        // Mark seat as booked
        $seat->update(['is_booked' => true]);

        return redirect()->route('customer.bookings.history')
                         ->with('success', 'Booking successful!');
    }

    public function history()
    {
        $bookings = Booking::with(['showtime.movie', 'seat'])
                           ->where('user_id', Auth::id())
                           ->orderByDesc('created_at')
                           ->get();

        return view('customer.history', compact('bookings'));
    }
}
