@extends('layouts.app')

@section('title', 'Guest Movies')

@section('content')
<div class="cinema-guest-page py-8 px-4">
    <div class="max-w-6xl mx-auto">
        <!-- Header Section -->
        <div class="cinema-guest-container p-6 rounded-lg shadow-lg mb-8">
            <div class="text-center">
                <h1 class="text-3xl font-bold text-yellow-400 mb-2 cinema-guest-glow-yellow">🎬 Up Coming Movies</h1>
                <p class="text-lg text-yellow-200">Discover the latest blockbusters coming to our cinema</p>
            </div>
        </div>

        <!-- Movies Grid -->
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6">
            @foreach ($movies as $movie)
                <div class="cinema-movie-card rounded-lg shadow-lg overflow-hidden">
                    <!-- Movie Poster -->
                    <div class="cinema-poster-container relative overflow-hidden">
                        <img src="{{ asset('uploads/' . basename($movie->poster_url)) }}" 
                             class="w-full h-64 object-cover cinema-poster-image" 
                             alt="{{ $movie->title }}">
                        <div class="cinema-poster-overlay">
                            <div class="cinema-coming-badge">
                                🎭 Coming Soon
                            </div>
                        </div>
                    </div>

                    <!-- Movie Details -->
                    <div class="p-6">
                        <h2 class="text-xl font-bold text-yellow-400 mb-3 cinema-guest-glow-yellow">{{ $movie->title }}</h2>
                        <p class="text-sm text-gray-300 mb-4 leading-relaxed">{{ Str::limit($movie->description, 100) }}</p>

                        <!-- Book Now Button -->
                        <a href="{{ route('login') }}" 
                           class="cinema-book-button w-full inline-flex items-center justify-center gap-2 font-semibold py-3 px-6 rounded-md shadow-md focus:outline-none focus:ring-2 focus:ring-yellow-500 focus:ring-offset-2 focus:ring-offset-gray-900">
                            <span class="text-lg">🎫</span>
                            Book Now
                            <svg class="w-5 h-5 cinema-book-arrow" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                            </svg>
                        </a>
                    </div>
                </div>
            @endforeach
        </div>

        @if($movies->isEmpty())
            <div class="text-center py-12">
                <div class="cinema-no-movies">
                    <div class="text-6xl mb-4">🎬</div>
                    <h3 class="text-xl font-semibold text-yellow-400 mb-2">No Movies Available</h3>
                    <p class="text-gray-300">Check back later for upcoming releases.</p>
                </div>
            </div>
        @endif
    </div>
</div>
@endsection