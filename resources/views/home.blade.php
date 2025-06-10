@extends('layouts.app')

@section('title', 'Welcome')

@section('content')
<div class="cinema-welcome-page py-8 px-4">
    <div class="max-w-6xl mx-auto">
        
        <!-- Hero Welcome Section -->
        <div class="cinema-welcome-hero mb-12">
            <div class="text-center">
                <h1 class="text-5xl font-bold text-yellow-400 mb-4 cinema-welcome-glow-yellow">🎬 Welcome to Cinema</h1>
                <p class="text-xl text-yellow-200 mb-2">Experience the magic of movies like never before</p>
                <p class="text-lg text-gray-300">Discover what's playing now and what's coming next</p>
            </div>
        </div>

        {{-- Now Showing Section --}}
        <div class="cinema-section-container mb-16">
            <!-- Section Header -->
            <div class="cinema-section-header">
                <div class="flex items-center justify-center gap-3 mb-8">
                    <span class="text-3xl">🎭</span>
                    <h2 class="text-3xl font-bold text-yellow-400 cinema-section-glow">Now Showing</h2>
                    <span class="text-3xl">🎭</span>
                </div>
            </div>

            <!-- Now Showing Movies Grid -->
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
                @forelse ($showingMovies as $movie)
                    <div class="cinema-now-showing-card group">
                        <!-- Movie Poster with Status Badge -->
                        <div class="cinema-movie-poster-wrapper">
                            <img src="{{ $movie->poster_url }}" 
                                 alt="{{ $movie->title }}" 
                                 class="cinema-movie-poster">
                            
                            <!-- Now Playing Badge -->
                            <div class="cinema-now-playing-badge">
                                <span class="text-xs font-bold">🔴 NOW PLAYING</span>
                            </div>
                            
                            <!-- Hover Overlay -->
                            <div class="cinema-movie-overlay">
                                <div class="cinema-movie-overlay-content">
                                    <span class="text-yellow-400 text-3xl">🎬</span>
                                    <p class="text-yellow-200 font-semibold text-sm mt-2">Available Now</p>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Movie Info -->
                        <div class="cinema-movie-info">
                            <h3 class="cinema-movie-title">{{ $movie->title }}</h3>
                            
                            <div class="flex items-center gap-2 mb-2">
                                <span class="text-yellow-400 text-sm">🎪</span>
                                <p class="cinema-movie-genre">{{ $movie->genre->name ?? 'No genre' }}</p>
                            </div>
                            
                            <p class="cinema-movie-description">{{ Str::limit($movie->description, 80) }}</p>
                            
                            <div class="flex items-center gap-2 mb-4">
                                <span class="text-yellow-400 text-sm">⏱️</span>
                                <p class="cinema-movie-duration">{{ $movie->duration }} mins</p>
                            </div>

                            <!-- Book Now Button -->
                            @auth
                                <a href="{{ route('customer.bookings.selectShowtime', $movie->id) }}" 
                                   class="cinema-book-now-button w-full">
                                    <span class="flex items-center justify-center gap-2">
                                        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                            <path d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                        </svg>
                                        Book Now
                                    </span>
                                </a>
                            @else
                                <a href="{{ route('login') }}" 
                                   class="cinema-login-button w-full">
                                    <span class="flex items-center justify-center gap-2">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1"/>
                                        </svg>
                                        Login to Book
                                    </span>
                                </a>
                            @endauth
                        </div>

                        <!-- Shimmer Effect -->
                        <div class="cinema-card-shimmer"></div>
                    </div>
                @empty
                    <div class="col-span-full">
                        <div class="cinema-empty-state">
                            <div class="text-6xl mb-4">🎬</div>
                            <h3 class="text-2xl font-semibold text-yellow-400 mb-2">No Movies Currently Showing</h3>
                            <p class="text-gray-300">Check back soon for new releases!</p>
                        </div>
                    </div>
                @endforelse
            </div>
        </div>

        {{-- Upcoming Movies Section --}}
        <div class="cinema-section-container">
            <!-- Section Header -->
            <div class="cinema-section-header">
                <div class="flex items-center justify-center gap-3 mb-8">
                    <span class="text-3xl">🎭</span>
                    <h2 class="text-3xl font-bold text-yellow-400 cinema-section-glow">Upcoming Movies</h2>
                    <span class="text-3xl">🎭</span>
                </div>
            </div>

            <!-- Upcoming Movies Grid -->
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
                @forelse ($upcomingMovies as $movie)
                    <div class="cinema-upcoming-card group">
                        <!-- Movie Poster with Status Badge -->
                        <div class="cinema-movie-poster-wrapper">
                            <img src="{{ $movie->poster_url }}" 
                                 alt="{{ $movie->title }}" 
                                 class="cinema-movie-poster">
                            
                            <!-- Coming Soon Badge -->
                            <div class="cinema-coming-soon-badge">
                                <span class="text-xs font-bold">🔥 COMING SOON</span>
                            </div>
                            
                            <!-- Hover Overlay -->
                            <div class="cinema-movie-overlay">
                                <div class="cinema-movie-overlay-content">
                                    <span class="text-yellow-400 text-3xl">🎭</span>
                                    <p class="text-yellow-200 font-semibold text-sm mt-2">Preview Soon</p>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Movie Info -->
                        <div class="cinema-movie-info">
                            <h3 class="cinema-movie-title">{{ $movie->title }}</h3>
                            
                            <div class="flex items-center gap-2 mb-2">
                                <span class="text-yellow-400 text-sm">🎪</span>
                                <p class="cinema-movie-genre">{{ $movie->genre->name ?? 'No genre' }}</p>
                            </div>
                            
                            <p class="cinema-movie-description">{{ Str::limit($movie->description, 80) }}</p>
                            
                            <div class="flex items-center gap-2 mb-4">
                                <span class="text-yellow-400 text-sm">⏱️</span>
                                <p class="cinema-movie-duration">{{ $movie->duration }} mins</p>
                            </div>

                            <!-- Coming Soon Status -->
                            <div class="cinema-coming-soon-status">
                                <div class="flex items-center justify-center gap-2">
                                    <span class="text-yellow-400 text-sm">📅</span>
                                    <span class="text-yellow-200 font-medium text-sm">Coming Soon</span>
                                </div>
                            </div>
                        </div>

                        <!-- Shimmer Effect -->
                        <div class="cinema-card-shimmer"></div>
                    </div>
                @empty
                    <div class="col-span-full">
                        <div class="cinema-empty-state">
                            <div class="text-6xl mb-4">🎭</div>
                            <h3 class="text-2xl font-semibold text-yellow-400 mb-2">No Upcoming Movies</h3>
                            <p class="text-gray-300">Stay tuned for exciting new releases!</p>
                        </div>
                    </div>
                @endforelse
            </div>
        </div>
    </div>
</div>
@endsection