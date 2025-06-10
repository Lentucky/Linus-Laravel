@extends('layouts.app')

@section('title', 'Cinema Seats Management')

@section('head')
    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
@endsection

@section('content')
    <div class="max-w-7xl mx-auto p-6 pt-20">
        <!-- Search Form -->
        <div class="bg-white p-6 rounded-lg shadow-lg mb-8">
            <form method="GET" action="{{ route('seat.search') }}" class="max-w-md mx-auto">
                <div class="relative">
                    <input type="text" 
                           name="search" 
                           value="{{ request('search') }}" 
                           placeholder="Search showtime, seats..."
                           class="w-full px-4 py-3 pl-10 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition duration-200" />
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                        <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                        </svg>
                    </div>
                    <button type="submit"
                            class="absolute right-2 top-2 bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2 px-4 rounded-md shadow-md transition duration-200 transform hover:scale-105 focus:outline-none focus:ring-2 focus:ring-blue-500">
                        Search
                    </button>
                </div>
            </form>
        </div>

        <!-- Header -->
        <div class="bg-white p-6 rounded-lg shadow-lg mb-8">
            <h1 class="text-3xl font-bold text-gray-800 text-center">🎪 Cinema Seats Management</h1>
        </div>

        <!-- Showtimes and Seats -->
        @foreach($showtimes as $showtime)
            @if($seats->where('showtime_id',$showtime->id)->count() > 0)
                <div class="bg-white rounded-lg shadow-lg mb-8 overflow-hidden">
                    <!-- Showtime Header -->
                    <div class="bg-gradient-to-r from-blue-600 to-blue-700 text-white p-6">
                        <div class="text-center space-y-2">
                            <h2 class="text-2xl font-bold">🎬 {{ $showtime->movie->title }}</h2>
                            <div class="flex justify-center items-center gap-6 text-sm">
                                <div class="flex items-center gap-2">
                                    <span class="text-blue-200">🕐</span>
                                    <span>Start Time: {{ $showtime->start_time }}</span>
                                </div>
                                <div class="flex items-center gap-2">
                                    <span class="text-blue-200">🎫</span>
                                    <span>{{ $seats->where('showtime_id',$showtime->id)->count() }} Seats</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Seats Table -->
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        ID
                                    </th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Movie Title
                                    </th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Screening Date
                                    </th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Start Time
                                    </th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Seat Preview
                                    </th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Status
                                    </th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Actions
                                    </th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @foreach($seats as $seat)
                                    @if($seat->showtime_id == $showtime->id)
                                        <tr class="hover:bg-gray-50 transition duration-200">
                                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                                {{ $seat->id }}
                                            </td>
                                            <td class="px-6 py-4 text-sm text-gray-900 max-w-xs">
                                                <div class="font-medium">{{ $seat->showtime->movie->title }}</div>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                                <div class="flex items-center gap-2">
                                                    <span class="text-blue-500">📅</span>
                                                    {{ $seat->showtime->screening_date }}
                                                </div>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                                <div class="flex items-center gap-2">
                                                    <span class="text-green-500">🕐</span>
                                                    {{ $seat->showtime->formatted_start_time ?? 'No Showtime' }}
                                                </div>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <div class="relative inline-block">
                                                    <img class="w-20 h-20 object-contain rounded-lg shadow-sm border border-gray-200" 
                                                         src="{{ asset('storage/public/images/seat.png') }}" 
                                                         alt="Cinema Seat" />
                                                    
                                                    <!-- Seat Number Overlay -->
                                                    <div class="absolute inset-0 flex items-center justify-center">
                                                        <div class="bg-black bg-opacity-70 text-white text-xs font-bold px-2 py-1 rounded shadow-lg">
                                                            {{ $seat->seat_number }}
                                                        </div>
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-center">
                                                @if($seat->is_booked)
                                                    <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-red-100 text-red-800">
                                                        <span class="mr-1">🔴</span>
                                                        Booked
                                                    </span>
                                                @else
                                                    <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                                        <span class="mr-1">🟢</span>
                                                        Available
                                                    </span>
                                                @endif
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                                <a href="{{ route('seat.edit', $seat->id) }}">
                                                    <button class="bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2 px-4 rounded-md shadow-md transition duration-200 transform hover:scale-105 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2">
                                                        ✏️ Edit
                                                    </button>
                                                </a>
                                            </td>
                                        </tr>
                                    @endif
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    <!-- Summary Stats -->
                    <div class="bg-gray-50 px-6 py-4 border-t">
                        <div class="flex justify-center items-center gap-8 text-sm">
                            @php
                                $showtimeSeats = $seats->where('showtime_id', $showtime->id);
                                $bookedCount = $showtimeSeats->where('is_booked', true)->count();
                                $availableCount = $showtimeSeats->where('is_booked', false)->count();
                                $totalSeats = $showtimeSeats->count();
                            @endphp
                            
                            <div class="flex items-center gap-2">
                                <span class="w-3 h-3 bg-green-500 rounded-full"></span>
                                <span class="text-gray-700">Available: <strong>{{ $availableCount }}</strong></span>
                            </div>
                            <div class="flex items-center gap-2">
                                <span class="w-3 h-3 bg-red-500 rounded-full"></span>
                                <span class="text-gray-700">Booked: <strong>{{ $bookedCount }}</strong></span>
                            </div>
                            <div class="flex items-center gap-2">
                                <span class="w-3 h-3 bg-blue-500 rounded-full"></span>
                                <span class="text-gray-700">Total: <strong>{{ $totalSeats }}</strong></span>
                            </div>
                        </div>
                    </div>
                </div>
            @endif
        @endforeach

        <!-- Empty State -->
        @if($showtimes->filter(function($showtime) use ($seats) { 
            return $seats->where('showtime_id', $showtime->id)->count() > 0; 
        })->isEmpty())
            <div class="bg-white rounded-lg shadow-lg p-12 text-center">
                <div class="text-gray-400 mb-4">
                    <svg class="w-16 h-16 mx-auto" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.172 16.172a4 4 0 015.656 0M9 12h6m-6-4h6m2 5.291A7.962 7.962 0 0112 15c-2.34 0-4.47.75-6.205 2.015M12 3c7.18 0 13 5.82 13 13s-5.82 13-13 13S-1 23.18-1 16 4.82 3 12 3z"></path>
                    </svg>
                </div>
                <h3 class="text-xl font-semibold text-gray-700 mb-2">No Seats Found</h3>
                <p class="text-gray-500">No seats match your search criteria or no seats have been created yet.</p>
            </div>
        @endif
    </div>
@endsection