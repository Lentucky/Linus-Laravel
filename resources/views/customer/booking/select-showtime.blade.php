@extends('layouts.app')

@section('title', 'Select Showtime')

@section('content')
<div class="max-w-3xl mx-auto py-6">
    <h2 class="text-xl font-semibold mb-4">Select Showtime for <strong>{{ $movie->title }}</strong></h2>

    <div class="space-y-3">
        @forelse ($showtimes as $showtime)
            <a href="{{ route('customer.bookings.selectSeat', $showtime->id) }}"
               class="block p-4 bg-white rounded shadow hover:bg-blue-50">
                <p class="text-md font-medium">Date: {{ $showtime->screening_date }}</p>
                <p class="text-sm text-gray-600">Time: {{ $showtime->formatted_start_time }}</p>
            </a>
        @empty
            <p>No available showtimes.</p>
        @endforelse
    </div>
</div>
@endsection
