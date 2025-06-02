@extends('layouts.app')

@section('title', 'Welcome')

@section('content')
    <h1>The profile shows the Booking/Ticket History</h1>
    <div class="max-w-md mx-auto mt-10 bg-white p-6 rounded-lg shadow-lg text-center">
    <!-- Profile Image -->
    <div class="flex justify-center mb-4">
        <img 
            src="" 
            alt="Profile Image" 
            class="w-32 h-32 rounded-full object-cover border-4 border-blue-500 shadow"
        >
    </div>

    <!-- User Info -->
    <h2 class="text-2xl font-bold text-gray-800">{{ $user->name }}</h2>
    <p class="text-gray-600">{{ $user->email }}</p>
    <p class="mt-2 text-sm text-gray-500">Joined: {{ $user->created_at->format('F j, Y') }}</p>
</div>
<!-- Search button here -->
<h2 class="text-2xl font-bold text-blue-600 mb-2 text-center">Booking History</h2>
<div class="overflow-x-auto">
  <table class="min-w-full border border-gray-300 divide-y divide-gray-200">
    <thead class="bg-gray-100">
      <tr>
        <th class="px-6 py-3 text-left text-sm font-semibold text-gray-700 uppercase">ID</th>
        <th class="px-6 py-3 text-left text-sm font-semibold text-gray-700 uppercase">Origin Username</th>
        <th class="px-6 py-3 text-left text-sm font-semibold text-gray-700 uppercase">Movie Title</th>
        <th class="px-6 py-3 text-left text-sm font-semibold text-gray-700 uppercase">Showtime Time and Date</th>
        <th class="px-6 py-3 text-left text-sm font-semibold text-gray-700 uppercase">Seat Number</th>
        <th class="px-6 py-3 text-left text-sm font-semibold text-gray-700 uppercase">Booking Code</th>
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
        <td class="px-6 py-4 text-sm text-gray-800">{{ $booking->booking_code }}</td>
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