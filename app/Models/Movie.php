<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Movie extends Model
{
    protected $fillable = ['genre_id', 'title', 'description', 'duration', 'poster_url'];

   
    public function getFormattedDurationAttribute()
    {
        $hours = floor($this->duration / 60);
        $minutes = $this->duration % 60;

        return sprintf('%02d:%02d', $hours, $minutes);
    }    
    public function genre()
    {
        return $this->belongsTo(Genre::class);
    }

    public function showtimes()
    {
        return $this->hasMany(Showtime::class);
    }

}
