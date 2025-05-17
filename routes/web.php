<?php

use App\Http\Controllers\Customer\MovieController as CustomerMovieController;
use App\Http\Controllers\Customer\BookingController as CustomerBookingController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\MovieController;
use App\Http\Controllers\Admin\ShowtimeController;
use App\Http\Controllers\Admin\SeatController;
use App\Http\Controllers\Admin\ReportController;

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware(['auth', 'role:customer'])->group(function () {
    Route::get('/dashboard', function () {
        return view('customer.dashboard');
    })->name('customer.dashboard');

    // View available movies and showtimes
    Route::get('/movies', [CustomerMovieController::class, 'index'])->name('customer.movies.index');

    // Book tickets
    Route::get('/bookings', [CustomerBookingController::class, 'index'])->name('customer.bookings.index');
    Route::post('/bookings', [CustomerBookingController::class, 'store'])->name('customer.bookings.store');

    // Optional: view booking history
    Route::get('/bookings/history', [CustomerBookingController::class, 'history'])->name('customer.bookings.history');
});

Route::prefix('admin')->middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('admin.dashboard');

    Route::resource('/movies', MovieController::class);
    Route::resource('/showtimes', ShowtimeController::class);
    Route::resource('/seats', SeatController::class)->only(['index', 'update']);
    
    Route::get('/reports', [ReportController::class, 'index'])->name('admin.reports.index');
});

