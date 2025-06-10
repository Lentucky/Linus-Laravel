@extends('layouts.app')

@section('title', 'Now Showing')

@section('content')
<div class="now-showing-page py-8 px-6 bg-[linear-gradient(135deg,_#111827_0%,_#0f172a_100%)]">
    <div class="max-w-6xl mx-auto">
        <h1 class="text-4xl font-bold text-yellow-400 text-center mb-10 now-showing-title cinema-showtime-glow-yellow">
            🍿 Now Showing
        </h1>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8 now-showing-grid">
            @foreach ($movies as $movie)
                <div class="now-showing-card rounded-lg overflow-hidden shadow-lg transform transition-transform hover:scale-105 border border-yellow-600 relative cinema-showtime-card">
                    <img src="{{ $movie->poster_url }}" alt="{{ $movie->title }}" class="w-full h-72 object-cover now-showing-image">
                    <div class="p-6 bg-gradient-to-tr from-gray-800 to-gray-900 now-showing-content text-yellow-100">
                        <h2 class="text-2xl font-semibold mb-1 cinema-showtime-glow-yellow">{{ $movie->title }}</h2>
                        <p class="text-sm text-yellow-300 mb-1">🎬 Genre: {{ $movie->genre->name ?? 'No genre' }}</p>
                        <p class="text-sm text-gray-300 mb-2">{{ Str::limit($movie->description, 80) }}</p>
                        <p class="text-sm text-yellow-400 mb-4">⏱ Duration: {{ $movie->duration }} mins</p>

                        @auth
                            <a href="{{ route('customer.bookings.selectShowtime', $movie->id) }}" class="cinema-back-button block text-center w-full">
                                Book Now
                            </a>
                        @else
                            <a href="{{ route('login') }}" class="cinema-back-button block text-center w-full bg-gradient-to-r from-rose-700 to-rose-800 hover:from-rose-800 hover:to-rose-900 text-white">
                                Login to Book
                            </a>
                        @endauth
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>
@endsection
