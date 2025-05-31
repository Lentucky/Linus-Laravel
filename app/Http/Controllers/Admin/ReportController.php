<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Booking;
use Carbon\Carbon;
class ReportController extends Controller
{
    public function index(){
       
        $bookings = Booking::whereDate('created_at', Carbon::today())->get();
        $lastweekbookings = Booking::whereBetween('created_at', [
        Carbon::today()->subWeek()->startOfWeek(), // Last week's Monday
        Carbon::today(),                       
    ])->get();
        //dd($lastweekbookings);
        return view('admin.reports.index', compact('bookings', 'lastweekbookings'));
    }

    public function search(Request $request)
        {
            $query = $request->input('search');

        

            $bookings = Booking::when($query, function ($q) use ($query) { 
                $q->orWhereHas('user', function ($q) use ($query) {
                    $q->where('name', 'LIKE', "%{$query}%");
                });
            })->orderBy('name', 'DESC')->paginate(10);

            return view('admin.reports.index', compact('bookings', 'query'));
        } 
}
