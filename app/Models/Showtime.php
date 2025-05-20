<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Showtime extends Model
{   protected $fillable = ['movie_id', 'screening_date', 'start_time'];
    //
    public function movie()
    {
        return $this->belongsTo(Movie::class);
    }
    use HasFactory;
}
