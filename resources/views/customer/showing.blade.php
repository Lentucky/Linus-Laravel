@extends('layouts.app')

@section('title', 'Now Showing')

@section('content')
<div class="max-w-6xl mx-auto py-6 px-4">
    <h1 class="text-2xl font-bold mb-4">Now Showing</h1>

    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
        @foreach ($movies as $movie)
            <div class="bg-white shadow rounded overflow-hidden">
                <img src="{{ $movie->poster_url }}" alt="{{ $movie->title }}" class="w-full h-48 object-cover">
                <div class="p-4">
                    <h2 class="text-lg font-semibold">{{ $movie->title }}</h2>
                    <p class="text-sm text-gray-500">{{ $movie->genre->name ?? 'No genre' }}</p>
                    <p class="text-sm mt-1 text-gray-600">{{ Str::limit($movie->description, 80) }}</p>
                    <p class="text-xs text-gray-400 mt-2">Duration: {{ $movie->duration }} mins</p>

                    @auth
                        <a href="{{ route('customer.bookings.selectShowtime', $movie->id) }}" class="inline-block mt-4 bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-500">
                            Book Now
                        </a>
                    @else
                        <a href="{{ route('login') }}" class="inline-block mt-4 bg-gray-600 text-white px-4 py-2 rounded hover:bg-gray-500">
                            Login to Book
                        </a>
                    @endauth
                </div>
            </div>
        @endforeach
    </div>
</div>
@endsection
