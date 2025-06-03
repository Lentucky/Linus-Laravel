@extends('layouts.app')

@section('title', 'Welcome')

@section('content')
    <h1>The profile shows the Booking/Ticket History</h1>
    <div class="max-w-md mx-auto mt-10 bg-white p-6 rounded-lg shadow-lg text-center">


    <!-- User Info -->
    <h2 class="text-2xl font-bold text-gray-800">{{ $user->name }}</h2>
    <p class="text-gray-600">{{ $user->email }}</p>
    <p class="mt-2 text-sm text-gray-500">Joined: {{ $user->created_at->format('F j, Y') }}</p>
    <div class="max-w-2xl mx-auto mt-10 bg-white p-8 rounded-lg shadow">
        <h2 class="text-2xl font-bold mb-6 text-gray-800">Edit Profile</h2>

        @if (session('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
                {{ session('success') }}
            </div>
        @endif

        <form action="{{ route('customer.profile.update') }}" method="POST" class="space-y-6">
            @csrf
            @method('PUT')

            {{-- Name --}}
            <div>
                <label for="name" class="block text-sm font-medium text-gray-700">Name</label>
                <input id="name" type="text" name="name" value="{{ old('name', $user->name) }}"
                    class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500" required>
                @error('name') <p class="text-sm text-red-600 mt-1">{{ $message }}</p> @enderror
            </div>

            {{-- Email --}}
            <div>
                <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                <input id="email" type="email" name="email" value="{{ old('email', $user->email) }}"
                    class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500" required>
                @error('email') <p class="text-sm text-red-600 mt-1">{{ $message }}</p> @enderror
            </div>

            <hr class="my-6">

            <h3 class="text-xl font-semibold text-gray-800">Change Password</h3>

            {{-- Current Password --}}
            <div>
                <label for="current_password" class="block text-sm font-medium text-gray-700">Current Password</label>
                <input id="current_password" type="password" name="current_password"
                    class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
                @error('current_password') <p class="text-sm text-red-600 mt-1">{{ $message }}</p> @enderror
            </div>

            {{-- New Password --}}
            <div>
                <label for="new_password" class="block text-sm font-medium text-gray-700">New Password</label>
                <input id="new_password" type="password" name="new_password"
                    class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
                @error('new_password') <p class="text-sm text-red-600 mt-1">{{ $message }}</p> @enderror
            </div>

            {{-- Confirm New Password --}}
            <div>
                <label for="new_password_confirmation" class="block text-sm font-medium text-gray-700">Confirm New Password</label>
                <input id="new_password_confirmation" type="password" name="new_password_confirmation"
                    class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
            </div>

            <div class="pt-4">
                <button type="submit"
                    class="bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2 px-4 rounded shadow">
                    Update Profile
                </button>
            </div>
        </form>
    </div>
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