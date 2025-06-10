@extends('layouts.app')

@section('title', 'Edit Seat')

@section('head')
    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
@endsection

@section('content')
    <div class="max-w-4xl mx-auto p-6 pt-20">
        <!-- Header Section -->
        <div class="bg-gray-900 p-6 rounded-lg shadow-lg mb-8 border border-yellow-600">
            <div class="text-center">
                <h1 class="text-3xl font-bold text-yellow-400 mb-2">🎭 Edit Cinema Seat</h1>
                <p class="text-yellow-200">Modify seat details and booking status</p>
            </div>
        </div>

        <!-- Edit Form Section -->
        <div class="bg-gray-900 rounded-lg shadow-lg overflow-hidden mb-6 border border-yellow-600">
            <!-- Form Header -->
            <div class="bg-gradient-to-r from-rose-800 to-rose-900 text-yellow-100 p-6">
                <h2 class="text-2xl font-bold text-center">✏️ Seat Information</h2>
            </div>

            <!-- Form Content -->
            <div class="p-8 bg-gray-900">
                <form action="{{ route('seat.storeedit') }}" method="POST" class="space-y-6">
                    @csrf
                    <input type="hidden" id="id" name="id" value="{{ $seat->id }}" required>

                    <!-- Showtime Selection -->
                    <div class="space-y-2">
                        <label for="showtime_id" class="block text-sm font-medium text-yellow-400">
                            🗓️ Showtime Date:
                        </label>
                        <select id="showtime_id" 
                                name="showtime_id" 
                                required
                                class="w-full px-4 py-3 border border-yellow-600 bg-gray-800 text-yellow-100 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-yellow-500 focus:border-yellow-500 transition duration-200">
                            @foreach($showtimes as $showtime)
                                <option value="{{ $showtime->id }}" {{ $showtime->id == $seat->showtime_id ? 'selected' : '' }}>
                                    🎬 {{ $showtime->movie->title ?? 'No Title' }} | 📅 {{ $showtime->screening_date }} | 🕐 {{ $showtime->start_time }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Seat Number -->
                    <div class="space-y-2">
                        <label for="seat_number" class="block text-sm font-medium text-yellow-400">
                            🪑 Seat Number:
                        </label>
                        <input type="text" 
                               id="seat_number" 
                               name="seat_number" 
                               value="{{ $seat->seat_number }}" 
                               required
                               class="w-full px-4 py-3 border border-yellow-600 bg-gray-800 text-yellow-100 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-yellow-500 focus:border-yellow-500 transition duration-200"
                               placeholder="Enter seat number (e.g., A1, B5, etc.)">
                    </div>

                    <!-- Booking Status -->
                    <div class="space-y-2">
                        <label for="is_booked" class="block text-sm font-medium text-yellow-400">
                            📋 Booking Status:
                        </label>
                        <select id="is_booked" 
                                name="is_booked" 
                                required
                                class="w-full px-4 py-3 border border-yellow-600 bg-gray-800 text-yellow-100 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-yellow-500 focus:border-yellow-500 transition duration-200">
                            <option value="0" {{ $seat->is_booked == false ? 'selected' : '' }}>
                                ✅ Available
                            </option>
                            <option value="1" {{ $seat->is_booked == true ? 'selected' : '' }}>
                                ❌ Booked
                            </option>
                        </select>
                    </div>

                    <!-- Hidden Fields -->
                    <input type="hidden" name="search" value="{{ $search }}">
                    <input type="hidden" name="page" value="{{ $page }}">

                    <!-- Action Buttons -->
                    <div class="flex flex-col sm:flex-row gap-4 pt-6">
                        <button type="submit" 
                                class="flex-1 bg-gradient-to-r from-yellow-600 to-yellow-700 hover:from-yellow-700 hover:to-yellow-800 text-gray-900 font-semibold py-3 px-6 rounded-md shadow-md transition duration-200 transform hover:scale-105 focus:outline-none focus:ring-2 focus:ring-yellow-500 focus:ring-offset-2 focus:ring-offset-gray-900">
                            💾 Save Changes
                        </button>
                        
                        <a href="{{ route('seat.search', ['movie_id' => $search, 'page' => $page]) }}" 
                           class="flex-1 bg-gray-600 hover:bg-gray-700 text-yellow-100 font-semibold py-3 px-6 rounded-md shadow-md transition duration-200 transform hover:scale-105 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-offset-2 focus:ring-offset-gray-900 text-center">
                            ↩️ Back to Seats
                        </a>
                    </div>
                </form>
            </div>
        </div>

        <!-- Delete Section -->
        <div class="bg-gray-900 rounded-lg shadow-lg overflow-hidden border border-yellow-600">
            <!-- Delete Header -->
            <div class="bg-gradient-to-r from-rose-800 to-rose-900 text-yellow-100 p-6">
                <h2 class="text-2xl font-bold text-center">🗑️ Danger Zone</h2>
            </div>

            <!-- Delete Content -->
            <div class="p-8 bg-gray-900">
                <div class="bg-rose-900 bg-opacity-50 border border-rose-600 rounded-lg p-6">
                    <div class="text-center space-y-4">
                        <h3 class="text-lg font-semibold text-rose-400">Delete This Seat</h3>
                        <p class="text-rose-300">This action cannot be undone. The seat will be permanently removed from the system.</p>
                        
                        <form action="{{ route('seat.delete', $seat->id) }}" method="POST" class="inline-block">
                            @csrf
                            @method('DELETE')
                            <button type="submit" 
                                    onclick="return confirm('Are you sure you want to delete this seat? This action cannot be undone.')"
                                    class="bg-gradient-to-r from-rose-700 to-rose-800 hover:from-rose-800 hover:to-rose-900 text-yellow-100 font-semibold py-3 px-6 rounded-md shadow-md transition duration-200 transform hover:scale-105 focus:outline-none focus:ring-2 focus:ring-rose-500 focus:ring-offset-2 focus:ring-offset-gray-900">
                                🗑️ Delete Seat
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        // For validation change if not gonna use
        toastr.options.timeOut = 0;
        toastr.options.closeButton = true;
        @if($errors->any())
            @foreach($errors->all() as $error)
                console.log("{{ $error }}");
                toastr.error('{{ $error }}');
            @endforeach
        @endif
    </script>    
@endsection