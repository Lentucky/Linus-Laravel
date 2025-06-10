@extends('layouts.app')

@section('title', 'Cinema Seats')

@section('head')
    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
@endsection

@section('content')
    <div class="max-w-7xl mx-auto p-6 pt-20 bg-[linear-gradient(135deg,_#111827_0%,_#0f172a_100%)]">
        <!-- Movie Filter Section -->
        <div class="bg-gray-900 p-6 rounded-lg shadow-lg mb-8 border border-yellow-600">
            <form method="GET" action="{{ route('seat.search') }}" class="max-w-md mx-auto">
                <div class="relative">
                    <label for="movie_id" class="block text-sm font-medium text-yellow-400 mb-2">🎬 Filter by Movie:</label>
                    <select name="movie_id" 
                            id="movie_id" 
                            class="w-full px-4 py-3 border border-yellow-600 bg-gray-800 text-yellow-100 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-yellow-500 focus:border-yellow-500 transition duration-200">
                        <option value="">-- All Movies --</option>
                        @foreach($allmovies as $movie)
                            <option value="{{ $movie->id }}" {{ request('movie_id') == $movie->id ? 'selected' : '' }}>
                                {{ $movie->title }} 
                            </option>
                        @endforeach
                    </select>
                    <button type="submit" 
                            class="mt-4 w-full bg-gradient-to-r from-yellow-600 to-yellow-700 hover:from-yellow-700 hover:to-yellow-800 text-gray-900 font-semibold py-3 px-6 rounded-md shadow-md transition duration-200 transform hover:scale-105 focus:outline-none focus:ring-2 focus:ring-yellow-500 focus:ring-offset-2 focus:ring-offset-gray-900">
                        🔍 Search Movies
                    </button>
                </div>
            </form>
        </div>

        <!-- Header and Controls -->
        <div class="bg-gray-900 p-6 rounded-lg shadow-lg mb-8 border border-yellow-600">
            <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-4">
                <h1 class="text-3xl font-bold text-yellow-400">Cinema Seats Management</h1>
                <a href="{{ route('seat.create') }}">
                    <button class="bg-gradient-to-r from-yellow-600 to-yellow-700 hover:from-yellow-700 hover:to-yellow-800 text-gray-900 font-semibold py-3 px-6 rounded-md shadow-md transition duration-200 transform hover:scale-105 focus:outline-none focus:ring-2 focus:ring-yellow-500 focus:ring-offset-2 focus:ring-offset-gray-900">
                        Create Seats
                    </button>
                </a>
            </div>
        </div>

        <!-- Movies and Seats Display -->
        @foreach($movies as $movie)
            @php
                $selectedshowtimes = $showtimes->where('movie_id', $movie->id);
            @endphp

            <div class="bg-gray-900 rounded-lg shadow-lg mb-8 overflow-hidden border border-yellow-600">
                <!-- Movie Header -->
                <div class="bg-gradient-to-r from-rose-800 to-rose-900 text-yellow-100 p-6">
                    <h2 class="text-2xl font-bold text-center">🎬 {{ $movie->title ?? "No Movie Title" }}</h2>
                </div>

                <!-- Showtime Filter -->
                <div class="p-6 bg-gray-800 border-b border-yellow-600">
                    <form method="GET" action="{{ route('seat.search') }}" class="flex flex-col items-center gap-4 max-w-md mx-auto">
                        <div class="w-full">
                            <label for="showtime_id" class="block text-sm font-medium text-yellow-400 mb-2">🗓️ Search by Screening Date:</label>
                            <select name="showtime_id" 
                                    id="showtime_id" 
                                    class="block w-full px-4 py-3 border border-yellow-600 bg-gray-900 text-yellow-100 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-yellow-500 focus:border-yellow-500 transition duration-200">
                                <option value="">-- Please Select a Screening Date --</option>
                                @foreach($selectedshowtimes as $showtime)
                                    <option value="{{ $showtime->id }}" {{ request('showtime_id') == $showtime->id ? 'selected' : '' }}>
                                        📅 Date: {{ $showtime->screening_date }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <input type="hidden" name="page" value="{{ $page }}">
                        <input type="hidden" name="movie_id" value="{{ $movie_id ?? 'null' }}">

                        <button type="submit" 
                                class="w-full bg-gradient-to-r from-yellow-600 to-yellow-700 hover:from-yellow-700 hover:to-yellow-800 text-gray-900 font-semibold py-3 px-6 rounded-md shadow-md transition duration-200 transform hover:scale-105 focus:outline-none focus:ring-2 focus:ring-yellow-500 focus:ring-offset-2 focus:ring-offset-gray-800">
                            🔍 Search by Date
                        </button>
                    </form>
                </div>

                <!-- Showtimes and Seats -->
                <div class="p-6 bg-gray-900">
                    @if($showtimestoshow)
                        @foreach($showtimestoshow as $showtime)
                            <div class="mb-8">
                                <!-- Showtime Info -->
                                <div class="bg-gray-800 p-4 rounded-lg mb-6 border border-yellow-600">
                                    <div class="text-center space-y-2">
                                        <h3 class="text-xl font-semibold text-yellow-400">{{ $showtime->movie->title ?? "No Movie Title" }}</h3>
                                        <p class="text-yellow-200">📅 <span class="font-medium">Screening Date:</span> {{ $showtime->screening_date }}</p>
                                        <p class="text-yellow-200">🕐 <span class="font-medium">Start Time:</span> {{ $showtime->formatted_start_time }}</p>
                                    </div>
                                </div>

                                <!-- Screen Label -->
                                <div class="text-center mb-6">
                                    <div class="inline-block bg-gradient-to-r from-rose-800 to-rose-900 text-yellow-100 px-8 py-2 rounded-full font-bold text-lg shadow-lg border border-yellow-600">
                                        🎭 SCREEN
                                    </div>
                                </div>

                                <!-- Seats Grid -->
                                <div class="flex justify-center mb-6">
                                    <div class="grid grid-cols-12 sm:grid-cols-16 md:grid-cols-20 gap-2 max-w-6xl">
                                        @foreach($seats->where('showtime_id', $showtime->id) as $seat)
                                            <div class="relative group {{ $seat->is_booked ? 'opacity-40' : 'hover:opacity-80' }}">
                                                <a href="{{ route('seat.edit', ['id' => $seat->id, 'search' => request('movie_id'), 'page' => request('page', 1)]) }}" 
                                                   class="block relative transition-transform duration-200 hover:scale-110">
                                                    <img class="w-12 h-12 sm:w-14 sm:h-14 md:w-16 md:h-16 object-contain" 
                                                         src="{{ asset('storage/images/seat.png') }}" 
                                                         alt="Cinema Seat">
                                                    
                                                    <!-- Seat Info Overlay -->
                                                    <div class="absolute inset-0 flex flex-col items-center justify-center text-yellow-100 text-xs font-bold pointer-events-none">
                                                        <div class="bg-gray-900 bg-opacity-80 px-1 rounded text-center border border-yellow-600">
                                                            <div class="text-[8px] sm:text-[10px]">{{ $seat->seat_number }}</div>
                                                            <div class="text-[10px] sm:text-xs">
                                                                @if($seat->is_booked) 
                                                                    <span class="text-rose-400">❌</span>
                                                                @else 
                                                                    <span class="text-yellow-400">✅</span>
                                                                @endif
                                                            </div>
                                                        </div>
                                                    </div>
                                                </a>
                                                
                                                <!-- Tooltip -->
                                                <div class="absolute bottom-full left-1/2 transform -translate-x-1/2 mb-2 px-2 py-1 bg-gray-800 text-yellow-100 text-xs rounded opacity-0 group-hover:opacity-100 transition-opacity duration-200 pointer-events-none whitespace-nowrap z-10 border border-yellow-600">
                                                    Seat {{ $seat->seat_number }} - {{ $seat->is_booked ? 'Booked' : 'Available' }}
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>

                                <!-- Legend -->
                                <div class="flex justify-center mb-6">
                                    <div class="bg-gray-800 p-4 rounded-lg border border-yellow-600">
                                        <div class="flex items-center gap-6 text-sm">
                                            <div class="flex items-center gap-2">
                                                <span class="text-yellow-400 text-lg">✅</span>
                                                <span class="text-yellow-200">Available</span>
                                            </div>
                                            <div class="flex items-center gap-2">
                                                <span class="text-rose-400 text-lg">❌</span>
                                                <span class="text-yellow-200">Booked</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Generate Seats Button -->
                                <div class="text-center">
                                    <a href="{{ route('seat.generate', $showtime->id) }}">
                                        <button onclick="return confirmDelete();" 
                                                class="bg-gradient-to-r from-rose-700 to-rose-800 hover:from-rose-800 hover:to-rose-900 text-yellow-100 font-semibold py-3 px-6 rounded-md shadow-md transition duration-200 transform hover:scale-105 focus:outline-none focus:ring-2 focus:ring-rose-500 focus:ring-offset-2 focus:ring-offset-gray-900">
                                            🎪 Generate Seats for this Screening
                                        </button>
                                    </a>
                                </div>
                            </div>
                        @endforeach
                    @else
                        @foreach($selectedshowtimes as $showtime)
                            <div class="mb-8">
                                <!-- Showtime Info -->
                                <div class="bg-gray-800 p-4 rounded-lg mb-6 border border-yellow-600">
                                    <div class="text-center space-y-2">
                                        <h3 class="text-xl font-semibold text-yellow-400">{{ $showtime->movie->title ?? "No Movie Title" }}</h3>
                                        <p class="text-yellow-200">📅 <span class="font-medium">Screening Date:</span> {{ $showtime->screening_date }}</p>
                                        <p class="text-yellow-200">🕐 <span class="font-medium">Start Time:</span> {{ $showtime->formatted_start_time }}</p>
                                    </div>
                                </div>

                                <!-- Screen Label -->
                                <div class="text-center mb-6">
                                    <div class="inline-block bg-gradient-to-r from-rose-800 to-rose-900 text-yellow-100 px-8 py-2 rounded-full font-bold text-lg shadow-lg border border-yellow-600">
                                        🎭 SCREEN
                                    </div>
                                </div>

                                <!-- Seats Grid -->
                                <div class="flex justify-center mb-6">
                                    <div class="grid grid-cols-12 sm:grid-cols-16 md:grid-cols-20 gap-2 max-w-6xl">
                                        @foreach($seats->where('showtime_id', $showtime->id) as $seat)
                                            <div class="relative group {{ $seat->is_booked ? 'opacity-40' : 'hover:opacity-80' }}">
                                                <a href="{{ route('seat.edit', ['id' => $seat->id, 'search' => request('movie_id'), 'page' => request('page', 1)]) }}" 
                                                   class="block relative transition-transform duration-200 hover:scale-110">
                                                    <img class="w-12 h-12 sm:w-14 sm:h-14 md:w-16 md:h-16 object-contain" 
                                                         src="{{ asset('storage/images/seat.png') }}" 
                                                         alt="Cinema Seat">
                                                    
                                                    <!-- Seat Info Overlay -->
                                                    <div class="absolute inset-0 flex flex-col items-center justify-center text-yellow-100 text-xs font-bold pointer-events-none">
                                                        <div class="bg-gray-900 bg-opacity-80 px-1 rounded text-center border border-yellow-600">
                                                            <div class="text-[8px] sm:text-[10px]">{{ $seat->seat_number }}</div>
                                                            <div class="text-[10px] sm:text-xs">
                                                                @if($seat->is_booked) 
                                                                    <span class="text-rose-400">❌</span>
                                                                @else 
                                                                    <span class="text-yellow-400">✅</span>
                                                                @endif
                                                            </div>
                                                        </div>
                                                    </div>
                                                </a>
                                                
                                                <!-- Tooltip -->
                                                <div class="absolute bottom-full left-1/2 transform -translate-x-1/2 mb-2 px-2 py-1 bg-gray-800 text-yellow-100 text-xs rounded opacity-0 group-hover:opacity-100 transition-opacity duration-200 pointer-events-none whitespace-nowrap z-10 border border-yellow-600">
                                                    Seat {{ $seat->seat_number }} - {{ $seat->is_booked ? 'Booked' : 'Available' }}
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>

                                <!-- Legend -->
                                <div class="flex justify-center mb-6">
                                    <div class="bg-gray-800 p-4 rounded-lg border border-yellow-600">
                                        <div class="flex items-center gap-6 text-sm">
                                            <div class="flex items-center gap-2">
                                                <span class="text-yellow-400 text-lg">✅</span>
                                                <span class="text-yellow-200">Available</span>
                                            </div>
                                            <div class="flex items-center gap-2">
                                                <span class="text-rose-400 text-lg">❌</span>
                                                <span class="text-yellow-200">Booked</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Generate Seats Button -->
                                <div class="text-center">
                                    <a href="{{ route('seat.generate', $showtime->id) }}">
                                        <button onclick="return confirmDelete();" 
                                                class="bg-gradient-to-r from-rose-700 to-rose-800 hover:from-rose-800 hover:to-rose-900 text-yellow-100 font-semibold py-3 px-6 rounded-md shadow-md transition duration-200 transform hover:scale-105 focus:outline-none focus:ring-2 focus:ring-rose-500 focus:ring-offset-2 focus:ring-offset-gray-900">
                                            🎪 Generate Seats for this Screening
                                        </button>
                                    </a>
                                </div>
                            </div>
                        @endforeach
                    @endif
                </div>
            </div>
        @endforeach
    </div>

    <script>
        function confirmDelete() {
            return confirm("Are you sure you want to generate seats? This will create duplicates if seats already exist for this screening.");
        }
    </script>
@endsection