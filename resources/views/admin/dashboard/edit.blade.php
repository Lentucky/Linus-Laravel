@extends('layouts.app')

@section('title', 'Edit Seat')

@section('content')
<div class="max-w-xl mx-auto mt-10 p-6 bg-white shadow-lg rounded-xl">
    <h2 class="text-2xl font-bold text-center text-blue-600 mb-6">Edit Seat</h2>

    @if(session('success'))
        <div class="mb-4 text-sm text-green-700 bg-green-100 px-4 py-2 rounded">
            {{ session('success') }}
        </div>
    @endif

    <form action="" method="POST" class="space-y-6">
        @csrf
        @method('PUT')

        <!-- Seat Number -->
        <div>
            <label for="seat_number" class="block text-sm font-medium text-gray-700">Seat Number</label>
            <input type="text" name="seat_number" id="seat_number"
                   value="{{ old('seat_number', $seat->seat_number) }}"
                   class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200 focus:ring-opacity-50"
                   required>
        </div>

        <!-- Is Booked -->
        <div>
            <label for="is_booked" class="block text-sm font-medium text-gray-700">Is Booked</label>
            <select name="is_booked" id="is_booked"
                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200 focus:ring-opacity-50">
                <option value="0" {{ $seat->is_booked ? '' : 'selected' }}>No</option>
                <option value="1" {{ $seat->is_booked ? 'selected' : '' }}>Yes</option>
            </select>
        </div>

        <!-- Showtime ID -->
        <div>
            <label for="showtime_id" class="block text-sm font-medium text-gray-700">Showtime ID</label>
            <input type="number" name="showtime_id" id="showtime_id"
                   value="{{ old('showtime_id', $seat->showtime_id) }}"
                   class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200 focus:ring-opacity-50"
                   required>
        </div>

        <!-- Submit Button -->
        <div>
            <button type="submit"
                    class="w-full bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2 px-4 rounded-md transition">
                Update Seat
            </button>
        </div>
    </form>
</div>
@endsection
