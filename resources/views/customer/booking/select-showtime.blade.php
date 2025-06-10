@extends('layouts.app')

@section('title', 'Select Showtime')

@section('content')
<div class="cinema-showtime-page py-8 px-4">
    <div class="max-w-4xl mx-auto">
        <!-- Header Section -->
        <div class="cinema-showtime-container p-6 rounded-lg shadow-lg mb-8">
            <div class="text-center">
                <h1 class="text-3xl font-bold text-yellow-400 mb-2 cinema-showtime-glow-yellow">🎬 Select Showtime</h1>
                <h2 class="text-xl font-semibold text-yellow-200">
                    for <span class="text-yellow-100 font-bold">{{ $movie->title }}</span>
                </h2>
            </div>
        </div>

        <!-- Showtimes Grid -->
        <div class="cinema-showtime-container rounded-lg shadow-lg overflow-hidden">
            <!-- Movie Header -->
            <div class="bg-gradient-to-r from-rose-800 to-rose-900 text-yellow-100 p-6 cinema-showtime-screen-glow">
                <h3 class="text-2xl font-bold text-center cinema-showtime-glow-rose">🎭 Available Showtimes</h3>
            </div>

            <!-- Showtimes List -->
            <div class="p-6 space-y-4">
                @php
                    use Carbon\Carbon;
                @endphp        
                @forelse ($showtimes as $showtime)
                    @php
                        $isToday = Carbon::parse($showtime->screening_date)->isToday();
                    @endphp
                    <a href="{{ route('customer.bookings.selectSeat', $showtime->id) }}"
                       class="cinema-showtime-card block p-6 rounded-lg shadow-md hover:shadow-lg focus:outline-none focus:ring-2 focus:ring-yellow-500 focus:ring-offset-2 focus:ring-offset-gray-900">
                        <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-3">
                            <div class="flex-1">
                                <div class="flex items-center gap-3 mb-2">
                                    <span class="text-yellow-400 text-lg">📅</span>
                                    <p class="text-lg font-medium text-yellow-200">
                                        Date: <span class="text-yellow-100">{{ $showtime->screening_date }}</span>
                                        @if ($isToday)
                                            <span class="cinema-today-badge">
                                                🔴 Today
                                            </span>
                                        @endif
                                    </p>
                                </div>
                                <div class="flex items-center gap-3">
                                    <span class="text-yellow-400 text-lg">🕐</span>
                                    <p class="text-sm text-gray-300">
                                        Time: <span class="text-yellow-200 font-medium">{{ $showtime->formatted_start_time }}</span>
                                    </p>
                                </div>
                            </div>
                            <div class="flex items-center text-yellow-400 hover:text-yellow-300 transition-colors duration-200">
                                <span class="text-sm font-medium mr-2">Select Seats</span>
                                <svg class="w-5 h-5 cinema-showtime-arrow" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                                </svg>
                            </div>
                        </div>
                    </a>
                @empty
                    <div class="text-center py-12">
                        <div class="cinema-no-showtimes">
                            <div class="text-6xl mb-4">🎭</div>
                            <h3 class="text-xl font-semibold text-yellow-400 mb-2">No Available Showtimes</h3>
                            <p class="text-gray-300">Check back later for upcoming screenings.</p>
                        </div>
                    </div>
                @endforelse
            </div>
        </div>

        <!-- Back Button -->
        <div class="text-center mt-8">
            <a href="{{ url()->previous() }}" 
               class="cinema-back-button inline-flex items-center gap-2 font-semibold py-3 px-6 rounded-md shadow-md focus:outline-none focus:ring-2 focus:ring-yellow-500 focus:ring-offset-2 focus:ring-offset-gray-900">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                </svg>
                Back to Movies
            </a>
        </div>
    </div>
</div>
@endsection