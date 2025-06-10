@extends('layouts.app')

@section('title', 'Upcoming Shows')

@section('content')
<div class="cinema-upcoming-page py-8 px-4">
    <div class="max-w-6xl mx-auto">
        <!-- Header Section -->
        <div class="cinema-upcoming-header-container p-6 rounded-lg shadow-lg mb-8">
            <div class="text-center">
                <h1 class="text-4xl font-bold text-yellow-400 mb-2 cinema-upcoming-glow-yellow">🎭 Upcoming Shows</h1>
                <p class="text-lg text-yellow-200">Get ready for the most anticipated movies coming soon</p>
            </div>
        </div>

        <!-- Movies Grid -->
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
            @foreach ($movies as $movie)
                <div class="cinema-upcoming-card group">
                    <!-- Movie Poster with Overlay -->
                    <div class="cinema-upcoming-poster-container">
                        <img src="{{ $movie->poster_url }}" 
                             alt="{{ $movie->title }}" 
                             class="cinema-upcoming-poster">
                        
                        <!-- Coming Soon Badge -->
                        <div class="cinema-coming-soon-badge">
                            <span class="text-xs font-bold">🔥 COMING SOON</span>
                        </div>
                        
                        
                    </div>
                    
                    <!-- Movie Info -->
                    <div class="cinema-upcoming-info">
                        <h2 class="cinema-upcoming-title">{{ $movie->title }}</h2>
                        
                        <div class="flex items-center gap-2 mb-2">
                            <span class="text-yellow-400 text-sm">🎪</span>
                            <p class="cinema-upcoming-genre">{{ $movie->genre->name ?? 'No genre' }}</p>
                        </div>
                        
                        <p class="cinema-upcoming-description">{{ Str::limit($movie->description, 80) }}</p>
                        
                        <div class="flex items-center justify-between mt-4">
                            <div class="flex items-center gap-2">
                                <span class="text-yellow-400 text-sm">⏱️</span>
                                <p class="cinema-upcoming-duration">{{ $movie->duration }} mins</p>
                            </div>
                            
                            <!-- Notify Me Button -->
                            
                        </div>
                        
                        <!-- Release Date Info -->
                        <div class="cinema-release-info mt-3 pt-3 border-t border-yellow-600/30">
                            <div class="flex items-center gap-2">
                                <span class="text-yellow-400 text-sm">📅</span>
                                <p class="text-xs text-gray-300">Expected Release: <span class="text-yellow-200 font-medium">Coming Soon</span></p>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Hover Shimmer Effect -->
                    <div class="cinema-upcoming-shimmer"></div>
                </div>
            @endforeach
        </div>

        <!-- No Movies Message -->
        @if($movies->isEmpty())
            <div class="text-center py-16">
                <div class="cinema-no-upcoming">
                    <div class="text-6xl mb-4">🎭</div>
                    <h3 class="text-2xl font-semibold text-yellow-400 mb-2">No Upcoming Shows</h3>
                    <p class="text-gray-300 text-lg">Stay tuned for exciting new releases!</p>
                </div>
            </div>
        @endif
    </div>
</div>
@endsection