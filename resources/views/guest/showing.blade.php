@extends('layouts.app')

@section('title', 'Guest Movies')

@section('content')
<div class="cinema-guest-movies-page">
    <div class="max-w-6xl mx-auto py-6 px-4">
        <!-- Header Section - matching showtime page header -->
        <div class="cinema-guest-container cinema-guest-screen-glow">
            <div class="text-center">
                <h1 class="cinema-guest-title cinema-guest-glow-yellow">🎬 Now Showing</h1>
                <p class="text-yellow-200 text-sm">Discover amazing movies and book your tickets</p>
            </div>
        </div>

        <!-- Movies Grid -->
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6">
            @foreach ($movies as $movie)
                <div class="cinema-guest-movie-card cinema-guest-film-strip">
                    <img src="{{ asset('uploads/' . basename($movie->poster_url)) }}" 
                         class="cinema-guest-poster" 
                         alt="{{ $movie->title }}">
                    
                    <div class="cinema-guest-ticket-effect">
                        <h2 class="cinema-guest-movie-title">{{ $movie->title }}</h2>
                        <p class="cinema-guest-description">{{ Str::limit($movie->description, 100) }}</p>
                    </div>

                    <a href="{{ route('login') }}" 
                       class="cinema-guest-book-button">
                        🎫 Book Now
                    </a>
                </div>
            @endforeach
        </div>

        <!-- Empty state - matching showtime empty state -->
        @if($movies->isEmpty())
            <div class="text-center py-12">
                <div class="cinema-no-movies">
                    <div class="text-6xl mb-4">🎬</div>
                    <h3 class="text-xl font-semibold text-yellow-400 mb-2">No Movies Available</h3>
                    <p class="text-gray-300">Check back later for new releases and exciting screenings.</p>
                </div>
            </div>
        @endif
    </div>
</div>
@endsection