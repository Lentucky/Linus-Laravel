@extends('layouts.app')

@section('title', 'Guest Movies')

@section('content')
    <div class="max-w-6xl mx-auto py-6 px-4">
        <h1 class="text-2xl font-bold mb-6">Now Showing</h1>

        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6">
            @foreach ($movies as $movie)
                <div class="bg-white rounded shadow p-4">
                    <img src="{{ asset('storage/' . $movie->poster_url) }}" class="w-full h-64 object-cover rounded mb-4" alt="{{ $movie->title }}">
                    <h2 class="text-lg font-bold">{{ $movie->title }}</h2>
                    <p class="text-sm text-gray-600 mb-3">{{ Str::limit($movie->description, 100) }}</p>

                    <a href="{{ route('login') }}" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-500 text-sm">
                        Book Now
                    </a>
                </div>
            @endforeach
        </div>
    </div>
@endsection
