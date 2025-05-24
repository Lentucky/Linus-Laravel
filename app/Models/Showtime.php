<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
class Showtime extends Model
{   protected $fillable = ['movie_id', 'screening_date', 'start_time'];


    // Accessor to convert start_time to 12-hour format
    public function getFormattedStartTimeAttribute()
    {
        return Carbon::createFromFormat('H:i', $this->start_time)->format('h:i A');
    } 

    public function movie()
    {
        return $this->belongsTo(Movie::class);
    }
    use HasFactory;
}
