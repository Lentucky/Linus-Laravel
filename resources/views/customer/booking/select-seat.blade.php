@extends('layouts.app')

@section('title', 'Select Seat')

@section('content')
<div class="cinema-seat-selection-page py-8 px-4 bg-[linear-gradient(135deg,_#111827_0%,_#0f172a_100%)]">
    <div class="max-w-4xl mx-auto">
        <!-- Movie Info Header -->
        <div class="cinema-seat-container mb-8">
            <h2 class="cinema-seat-title text-2xl font-semibold text-center mb-6">
                🎬 {{ $showtime->movie->title }}
            </h2>
            <div class="text-center text-yellow-200">
                <p class="text-lg">📅 {{ $showtime->screening_date }} @ {{ $showtime->formatted_start_time ?? $showtime->start_time }}</p>
            </div>
        </div>

        <!-- Screen Indicator -->
        <div class="cinema-screen-indicator">
            <div class="cinema-screen-text">
                🎭 SCREEN 🎭
            </div>
        </div>

        <!-- Seat Selection Form -->
        <div class="cinema-seat-container">
            <form method="POST" action="{{ route('customer.bookings.store') }}" id="seatForm">
                @csrf
                <input type="hidden" name="showtime_id" value="{{ $showtime->id }}">

                @php
                    $groupedSeats = $seats->groupBy(fn($seat) => strtoupper(substr($seat->seat_number, 0, 1)));
                @endphp

                <div class="space-y-3">
                    @foreach ($groupedSeats as $row => $seatsInRow)
                        <div class="cinema-seat-row">
                            <span class="cinema-seat-row-label">{{ $row }}</span>
                            @foreach ($seatsInRow as $seat)
                                <label class="cinema-seat-wrapper {{ $seat->is_booked ? 'cinema-seat-booked' : 'cinema-seat-available' }}">
                                    <img
                                        src="{{ asset('storage/images/seat.png') }}"
                                        alt="{{ $seat->seat_number }}"
                                        class="cinema-seat-image"
                                    >

                                    @if (!$seat->is_booked)
                                        <input 
                                            type="radio" 
                                            name="seat_id" 
                                            value="{{ $seat->id }}"
                                            class="cinema-seat-radio" 
                                            required
                                            onchange="highlightSelectedSeat(this)"
                                        >
                                    @endif

                                    <span class="cinema-seat-number">
                                        {{ $seat->seat_number }}
                                    </span>
                                </label>
                            @endforeach
                        </div>
                    @endforeach
                </div>

                <!-- Legend -->
                <div class="cinema-seat-legend">
                    <div class="cinema-legend-item">
                        <img src="{{ asset('storage/images/seat.png') }}" alt="Available" class="cinema-legend-seat cinema-legend-available">
                        <span>Available</span>
                    </div>
                    <div class="cinema-legend-item">
                        <img src="{{ asset('storage/images/seat.png') }}" alt="Booked" class="cinema-legend-seat cinema-legend-booked">
                        <span>Booked</span>
                    </div>
                    <div class="cinema-legend-item">
                        <img src="{{ asset('storage/images/seat.png') }}" alt="Selected" class="cinema-legend-seat cinema-legend-selected">
                        <span>Selected</span>
                    </div>
                </div>

                <div class="text-center">
                    <button type="submit" class="cinema-confirm-button">
                        🎟️ Confirm Booking
                    </button>
                </div>
            </form>
        </div>

        <!-- Back Button -->
        <div class="text-center mt-8">
            <a href="{{ url()->previous() }}" 
               class="cinema-back-button inline-flex items-center gap-2 font-semibold py-3 px-6 rounded-md shadow-md focus:outline-none focus:ring-2 focus:ring-yellow-500 focus:ring-offset-2 focus:ring-offset-gray-900">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                </svg>
                Back to Showtimes
            </a>
        </div>
    </div>
</div>

<script>
function highlightSelectedSeat(radioInput) {
    // Remove previous selection highlights
    document.querySelectorAll('.cinema-seat-wrapper').forEach(wrapper => {
        wrapper.classList.remove('cinema-seat-selected');
    });
    
    // Add highlight to selected seat
    if (radioInput.checked) {
        radioInput.closest('.cinema-seat-wrapper').classList.add('cinema-seat-selected');
    }
}
</script>
@endsection