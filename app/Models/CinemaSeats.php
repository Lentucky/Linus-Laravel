<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CinemaSeats extends Model
{   protected $fillable = ['showtime_id', 'seat_number', 'is_booked'];
    /** @use HasFactory<\Database\Factories\CinemaSeatsFactory> */
    use HasFactory;
}
