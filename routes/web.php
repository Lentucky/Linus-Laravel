<?php

use App\Http\Controllers\Customer\MovieController as CustomerMovieController;
use App\Http\Controllers\Customer\BookingController as CustomerBookingController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\MovieController;
use App\Http\Controllers\Admin\ShowtimeController;
use App\Http\Controllers\Admin\SeatController;
use App\Http\Controllers\Admin\ReportController;

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/welcome', function () {
    return view('welcome');
}) -> name('welcome');

// Guest Routes
Route::view('/guest/movies', 'guest.movies')->name('guest.movies');
Route::view('/guest/showtimes', 'guest.showtimes')->name('guest.showtimes');

// Authentication
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);
Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [RegisterController::class, 'register']);

Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

// Customer Routes
Route::middleware(['auth', 'role:customer'])->group(function () {
    Route::get('/dashboard', function () {
        return view('customer.dashboard');
    })->name('customer.dashboard');

    Route::get('/movies', [CustomerMovieController::class, 'index'])->name('customer.movies.index');
    // Route::get('/showtimes', [CustomerMovieController::class, 'index'])->name('customer.showtimes.index');
    Route::get('/bookings', [CustomerBookingController::class, 'index'])->name('customer.bookings.index');
    Route::post('/bookings', [CustomerBookingController::class, 'store'])->name('customer.bookings.store');
    Route::get('/bookings/history', [CustomerBookingController::class, 'history'])->name('customer.bookings.history');
});

// Admin Routes
Route::prefix('admin')->middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('admin.dashboard');
    Route::resource('/movies', MovieController::class);
    Route::resource('/showtimes', ShowtimeController::class);
    Route::resource('/seats', SeatController::class)->only(['index', 'update']);
    Route::get('/seats/create', [SeatController::class, 'create'])->name('seat.create');
    Route::post('/seats/store', [SeatController::class, 'store'])->name('seat.store');    
    Route::get('/seats/edit/{id}', [SeatController::class, 'edit'])->name('seat.edit');
    Route::post('/seats/edit', [SeatController::class, 'storeedit'])->name('seat.storeedit');
    Route::delete('/seats/{seat}', [SeatController::class, 'delete'])->name('seat.delete');
    Route::get('/reports', [ReportController::class, 'index'])->name('admin.reports.index');
});
