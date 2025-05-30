<?php

use App\Http\Controllers\Customer\MovieController as CustomerMovieController;
use App\Http\Controllers\Customer\BookingController as CustomerBookingController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\MovieController;
use App\Http\Controllers\Admin\ShowtimeController;
use App\Http\Controllers\Admin\SeatController;
use App\Http\Controllers\Admin\ReportController;
use App\Http\Controllers\Admin\CustomerController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Customer\ShowingController as CustomerShowingController;
use App\Http\Controllers\Customer\UpcomingController as CustomerUpcomingController;

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;

use Illuminate\Support\Facades\Route;
use App\Models\Seat;
Route::get('/', function () {
    return view('welcome');
});

Route::get('/welcome', function () {
    return view('welcome');
}) -> name('welcome');
Route::get('/', [HomeController::class, 'index'])->name('home');

// Guest Routes
Route::prefix('guest')->group(function () {
    Route::get('/showing', [App\Http\Controllers\Guest\ShowingController::class, 'index'])->name('guest.showing');
    Route::get('/upcoming', [App\Http\Controllers\Guest\UpcomingController::class, 'index'])->name('guest.upcoming');
});

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
    Route::get('/showing', [CustomerShowingController::class, 'index'])->name('customer.showing');
    Route::get('/upcoming', [CustomerUpcomingController::class, 'index'])->name('customer.upcoming');
    // Route::get('/showtimes', [CustomerMovieController::class, 'index'])->name('customer.showtimes.index');
    Route::get('/bookings', [CustomerBookingController::class, 'index'])->name('customer.bookings.index');
    Route::post('/bookings', [CustomerBookingController::class, 'store'])->name('customer.bookings.store');
    Route::get('/bookings/history', [CustomerBookingController::class, 'history'])->name('customer.bookings.history');

    Route::get('/bookings/select-showtime/{movie}', [CustomerBookingController::class, 'selectShowtime'])->name('customer.bookings.selectShowtime');
    Route::get('/bookings/select-seat/{showtime}', [CustomerBookingController::class, 'selectSeat'])->name('customer.bookings.selectSeat');
    Route::post('/bookings/confirm', [CustomerBookingController::class, 'confirmBooking'])->name('customer.bookings.confirm');

});

// Admin Routes
Route::prefix('admin')->middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('admin.dashboard');

    
    Route::resource('/movies', MovieController::class)->only(['index', 'create', 'store', 'edit', 'search']);
    Route::get('/movies/search', [MovieController::class, 'search'])->name('movies.search');
    //Route::get('/movies', [MovieController::class, 'index'])->name('movies.index');
    //Route::get('/movies/create', [MovieController::class, 'create'])->name('movies.create');
    //Route::get('/movies/edit/{id}', [MovieController::class, 'edit'])->name('movies.edit');
    Route::put('/movies/{id}/edit', [MovieController::class, 'storeedit'])->name('movies.storeedit');
    Route::delete('/movies/{movie}', [MovieController::class, 'delete'])->name('movies.delete');

    Route::resource('/showtimes', ShowtimeController::class)->only(['index', 'create', 'store', 'edit']);
    Route::put('/showtimes/{id}/edit', [ShowtimeController::class, 'storeedit'])->name('showtimes.storeedit');
    Route::delete('/showtimes/{showtime}', [ShowtimeController::class, 'delete'])->name('showtimes.delete');

    Route::resource('/seats', SeatController::class)->only(['index', 'update']);
    Route::post('/seats/book', [SeatController::class, 'book'])->name('seats.book');
    Route::get('/seats/search', [SeatController::class, 'search'])->name('seat.search'); //search button
    Route::get('/seats/create', [SeatController::class, 'create'])->name('seat.create');
    Route::post('/seats/store', [SeatController::class, 'store'])->name('seat.store');    
    Route::get('/seats/edit/{id}', [SeatController::class, 'edit'])->name('seat.edit');
    Route::post('/seats/edit', [SeatController::class, 'storeedit'])->name('seat.storeedit');
    Route::delete('/seats/{seat}', [SeatController::class, 'delete'])->name('seat.delete');
    Route::get('/seats/generate/{id}', [SeatController::class, 'generateSeats'])->name('seat.generate'); 
    
    Route::resource('/customers', CustomerController::class)->only(['index', 'create', 'store', 'edit', 'update', 'destroy']);
    Route::get('/customers/create', [CustomerController::class, 'create'])->name('customers.create');
    Route::post('/customers/store', [CustomerController::class, 'store'])->name('customers.store');    
    Route::get('/customers/edit/{id}', [CustomerController::class, 'edit'])->name('customers.edit');
    Route::put('/customers/{id}', [CustomerController::class, 'update'])->name('customers.update');
    Route::delete('/customers/{id}', [CustomerController::class, 'destroy'])->name('customers.delete');

    Route::get('/reports', [ReportController::class, 'index'])->name('admin.reports.index');
});
