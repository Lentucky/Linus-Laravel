@extends('layouts.app')

@section('title', 'Add Seat')

@section('head')
    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
@endsection

@section('content')
    <div class="max-w-4xl mx-auto p-6 pt-20">
        <!-- Header Section -->
        <div class="bg-gray-900 p-6 rounded-lg shadow-lg mb-8 border border-yellow-600">
            <div class="text-center">
                <h1 class="text-3xl font-bold text-yellow-400 mb-2">🎭 Add New Cinema Seat</h1>
                <p class="text-yellow-200">Create a new seat for your cinema screening</p>
            </div>
        </div>

        <!-- Add Form Section -->
        <div class="bg-gray-900 rounded-lg shadow-lg overflow-hidden border border-yellow-600">
            <!-- Form Header -->
            <div class="bg-gradient-to-r from-rose-800 to-rose-900 text-yellow-100 p-6">
                <h2 class="text-2xl font-bold text-center">➕ Create New Seat</h2>
            </div>

            <!-- Form Content -->
            <div class="p-8 bg-gray-900">
                <form action="{{ route('seat.store') }}" method="POST" class="space-y-6">
                    @csrf

                    <!-- Showtime Selection -->
                    <div class="space-y-2">
                        <label for="showtime_id" class="block text-sm font-medium text-yellow-400">
                            🗓️ Select Showtime:
                        </label>
                        <select name="showtime_id" 
                                id="showtime_id"
                                required
                                class="w-full px-4 py-3 border border-yellow-600 bg-gray-800 text-yellow-100 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-yellow-500 focus:border-yellow-500 transition duration-200">
                            <option value="">-- Please Select a Showtime --</option>
                            @foreach($showtimes as $showtime)
                                <option value="{{ $showtime->id }}">
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
                               value="" 
                               required
                               placeholder="Enter seat number (e.g., A1, B5, C10, etc.)"
                               class="w-full px-4 py-3 border border-yellow-600 bg-gray-800 text-yellow-100 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-yellow-500 focus:border-yellow-500 transition duration-200">
                    </div>

                    <!-- Booking Status -->
                    <div class="space-y-2">
                        <label for="is_booked" class="block text-sm font-medium text-yellow-400">
                            📋 Initial Booking Status:
                        </label>
                        <select id="is_booked" 
                                name="is_booked" 
                                required
                                class="w-full px-4 py-3 border border-yellow-600 bg-gray-800 text-yellow-100 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-yellow-500 focus:border-yellow-500 transition duration-200">
                            <option value="0" selected>✅ Available</option>
                            <option value="1">❌ Booked</option>
                        </select>
                        <p class="text-sm text-yellow-300 mt-1">Most new seats should be set to "Available" initially</p>
                    </div>

                    <!-- Action Buttons -->
                    <div class="flex flex-col sm:flex-row gap-4 pt-6">
                        <button type="submit" 
                                class="flex-1 bg-gradient-to-r from-yellow-600 to-yellow-700 hover:from-yellow-700 hover:to-yellow-800 text-gray-900 font-semibold py-3 px-6 rounded-md shadow-md transition duration-200 transform hover:scale-105 focus:outline-none focus:ring-2 focus:ring-yellow-500 focus:ring-offset-2 focus:ring-offset-gray-900">
                            💾 Save New Seat
                        </button>
                        
                        <a href="{{ route('seat.search') }}" 
                           class="flex-1 bg-gray-600 hover:bg-gray-700 text-yellow-100 font-semibold py-3 px-6 rounded-md shadow-md transition duration-200 transform hover:scale-105 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-offset-2 focus:ring-offset-gray-900 text-center">
                            ↩️ Back to Seats
                        </a>
                    </div>
                </form>
            </div>
        </div>

        <!-- Help Section -->
        <div class="bg-gray-800 border border-yellow-600 rounded-lg p-6 mt-8">
            <div class="text-center space-y-3">
                <h3 class="text-lg font-semibold text-yellow-400">💡 Quick Tips</h3>
                <div class="text-yellow-200 space-y-2">
                    <p>• Use a clear naming convention for seat numbers (e.g., A1, A2, B1, B2)</p>
                    <p>• Most seats should be created as "Available" initially</p>
                    <p>• You can also use the "Generate Seats" feature for bulk creation</p>
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