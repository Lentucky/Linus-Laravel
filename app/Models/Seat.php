<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Seat extends Model
{
    //
    protected $fillable = ['showtime_id', 'seat_number', 'is_booked'];

    public function showtime()
    {
        return $this->belongsTo(Showtime::class);
    }
}
