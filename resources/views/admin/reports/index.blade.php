@extends('layouts.app')

@section('title', 'Reports')

@section('content')
<script src="https://cdn.tailwindcss.com"></script>
<label for="options" class="block mb-2 text-sm font-medium text-gray-700">Choose an option</label>
<select id="options" name="options"
        class="block w-full max-w-xs rounded-md border border-gray-300 bg-white px-4 py-2 pr-10 text-sm text-gray-700 shadow-sm focus:border-blue-500 focus:outline-none focus:ring-1 focus:ring-blue-500">
  <option selected disabled>-- Select an option --</option>
  <option value="profile">Profile</option>
  <option value="settings">Settings</option>
  <option value="logout">Logout</option>
</select>
<h2 class="text-2xl font-bold text-blue-600 mb-2 text-center">Todays Booking</h2>
<div class="overflow-x-auto">
  <table class="min-w-full border border-gray-300 divide-y divide-gray-200">
    <thead class="bg-gray-100">
      <tr>
        <th class="px-6 py-3 text-left text-sm font-semibold text-gray-700 uppercase">ID</th>
        <th class="px-6 py-3 text-left text-sm font-semibold text-gray-700 uppercase">Origin Username</th>
        <th class="px-6 py-3 text-left text-sm font-semibold text-gray-700 uppercase">Movie Title</th>
        <th class="px-6 py-3 text-left text-sm font-semibold text-gray-700 uppercase">Showtime ID or date?</th>
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
        <td class="px-6 py-4 text-sm text-gray-800">{{ $booking->showtime->id }}</td>
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