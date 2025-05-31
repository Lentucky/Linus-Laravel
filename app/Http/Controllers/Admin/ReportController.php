<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Booking;
use Carbon\Carbon;
class ReportController extends Controller
{
    public function index(){
       
        $recentbookings = Booking::whereBetween('created_at', [
            Carbon::now()->startOfWeek(), // This week's Monday
            Carbon::now(),                // Right now (today)
        ])->get();
        $lastweekbookings = Booking::whereBetween('created_at', [
            Carbon::now()->subWeek()->startOfWeek(), // last week's Monday
            Carbon::now()->subWeek()->endOfWeek(),   // last week's Sunday
        ])->get();
        //dd($lastweekbookings);
        return view('admin.reports.index', compact('recentbookings', 'lastweekbookings'));
    }

    public function search(Request $request)
        {
            $query = $request->input('search');

        

            $recentbookings = Booking::when($query, function ($q) use ($query) { 
                $q->orWhereHas('user', function ($q) use ($query) {
                    $q->where('name', 'LIKE', "%{$query}%");
                });
            })->whereBetween('created_at', [
                Carbon::now()->startOfWeek(), // This week's Monday
                Carbon::now(),                // Right now (today)
            ])->orderBy('name', 'DESC')->get();

            $lastweekbookings = Booking::when($query, function ($q) use ($query) { 
                $q->orWhereHas('user', function ($q) use ($query) {
                    $q->where('name', 'LIKE', "%{$query}%");
                });
            })->whereBetween('created_at', [
                Carbon::now()->subWeek()->startOfWeek(), // last week's Monday
                Carbon::now()->subWeek()->endOfWeek(),   // last week's Sunday
            ])->orderBy('name', 'DESC')->get();            

            return view('admin.reports.index', compact('recentbookings', 'lastweekbookings', 'query'));
        } 
}
