<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Movie extends Model
{
    protected $fillable = ['genre_id', 'title', 'description', 'duration', 'poster_url'];

    
    public function genre()
    {
        return $this->belongsTo(Genre::class);
    }

    public function showtimes()
    {
        return $this->hasMany(Showtime::class);
    }

}
