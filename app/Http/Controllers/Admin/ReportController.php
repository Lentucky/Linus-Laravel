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
        return view('admin.reports.index', compact('bookings'));
    }
}
