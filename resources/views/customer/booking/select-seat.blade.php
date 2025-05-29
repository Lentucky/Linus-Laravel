@extends('layouts.app')

@section('title', 'Select Seat')

@section('content')
<div class="max-w-4xl mx-auto py-6">
    <h2 class="text-2xl font-semibold text-center mb-6">
        {{ $showtime->movie->title }} — {{ $showtime->screening_date }} @ {{ $showtime->formatted_start_time ?? $showtime->start_time }}
    </h2>

    <form method="POST" action="{{ route('customer.bookings.store') }}">
        @csrf
        <input type="hidden" name="showtime_id" value="{{ $showtime->id }}">

        @php
            $groupedSeats = $seats->groupBy(fn($seat) => strtoupper(substr($seat->seat_number, 0, 1)));
        @endphp

        <div class="space-y-3">
            @foreach ($groupedSeats as $row => $seatsInRow)
                <div class="flex items-center justify-center gap-4">
                    <span class="w-4 text-right font-bold text-sm text-gray-600">{{ $row }}</span>
                    @foreach ($seatsInRow as $seat)
                        <label class="relative group w-12 h-12 block">
                            <img
                                src="{{ asset('storage/images/seat.png') }}"
                                alt="{{ $seat->seat_number }}"
                                class="w-full h-full object-contain 
                                    {{ $seat->is_booked ? 'opacity-30 cursor-not-allowed' : 'hover:opacity-80' }}"
                            >

                            @if (!$seat->is_booked)
                                <input type="radio" name="seat_id" value="{{ $seat->id }}"
                                    class="absolute bottom-1 left-1 scale-125 accent-blue-500" required>
                            @endif

                            <span class="absolute inset-0 flex items-center justify-center text-white font-bold text-xs drop-shadow">
                                {{ $seat->seat_number }}
                            </span>
                        </label>

                    @endforeach
                </div>
            @endforeach
        </div>

        <div class="text-center">
            <button type="submit" class="bg-green-600 text-white px-6 py-2 rounded hover:bg-green-500">
                Confirm Booking
            </button>
        </div>
    </form>
</div>
@endsection
