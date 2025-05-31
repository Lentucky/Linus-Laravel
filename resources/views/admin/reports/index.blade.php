@extends('layouts.app')

@section('title', 'Reports')

@section('content')
<script src="https://cdn.tailwindcss.com"></script>
  <form method="GET" action="{{ route('reports.search') }}" class="flex items-center space-x-2">
      <input 
          type="text" 
          name="search" 
          placeholder="Search username..." 
          class="w-full md:w-64 px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
      >
      <button 
          type="submit" 
          class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition"
      >
          Search
      </button>
  </form>
<h2 class="text-2xl font-bold text-blue-600 mb-2 text-center">Todays Booking</h2>
<div class="overflow-x-auto">
  <table class="min-w-full border border-gray-300 divide-y divide-gray-200">
    <thead class="bg-gray-100">
      <tr>
        <th class="px-6 py-3 text-left text-sm font-semibold text-gray-700 uppercase">ID</th>
        <th class="px-6 py-3 text-left text-sm font-semibold text-gray-700 uppercase">Origin Username</th>
        <th class="px-6 py-3 text-left text-sm font-semibold text-gray-700 uppercase">Movie Title</th>
        <th class="px-6 py-3 text-left text-sm font-semibold text-gray-700 uppercase">Time and Date</th>
        <th class="px-6 py-3 text-left text-sm font-semibold text-gray-700 uppercase">Seat Number</th>
        <th class="px-6 py-3 text-left text-sm font-semibold text-gray-700 uppercase">Created At</th>
        <th class="px-6 py-3 text-left text-sm font-semibold text-gray-700 uppercase">Status</th>
        
      </tr>
    </thead>
    <tbody class="divide-y divide-gray-200">
        @foreach($bookings as $booking)
      <tr class="hover:bg-gray-50">
        <td class="px-6 py-4 text-sm text-gray-800">{{$booking->id}}</td>
        <td class="px-6 py-4 text-sm text-gray-800">{{ $booking->user->name }}</td>
        <td class="px-6 py-4 text-sm text-gray-800">{{ $booking->showtime->movie->title }}</td>
        <td class="px-6 py-4 text-sm text-gray-800">{{ $booking->showtime->formatted_start_time }} -{{ $booking->showtime->screening_date }}</td>
        <td class="px-6 py-4 text-sm text-gray-800">{{ $booking->seat->seat_number }}</td>
        <td class="px-6 py-4 text-sm text-gray-800">{{ $booking->created_at }}</td>
        @if($booking->status == "confirmed")
        <td class="px-6 py-4 text-sm text-green-600 font-medium">Confirmed</td>
        @elseif($booking->status == "denied")
        <td class="px-6 py-4 text-sm text-red-600 font-medium">Denied</td>
        @else
        <td class="px-6 py-4 text-sm text-yellow-600 font-medium">Pending</td>
        @endif
        
      </tr>
        @endforeach
    </tbody>
  </table>
</div>
@endsection