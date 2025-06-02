@extends('layouts.app')

@section('title', 'Reports')

@section('content')
  <form method="GET" action="{{ route('reports.search') }}" class="report-form">
      <input 
          type="text" 
          name="search" 
          placeholder="Search username..." 
          class="report-input"
      >
      <button 
          type="submit" 
          class="report-button"
      >
          Search
      </button>
  </form>

  <h2 class="report-section-title">Recent Bookings</h2>
  <div class="report-table-wrapper">
    <table class="report-table">
      <thead class="report-thead">
        <tr>
          <th class="report-th">ID</th>
          <th class="report-th">Origin Username</th>
          <th class="report-th">Movie Title</th>
          <th class="report-th">Showtime Time and Date</th>
          <th class="report-th">Seat Number</th>
          <th class="report-th">Booking Code</th>
          <th class="report-th">Created At</th>
          <th class="report-th">Status</th>
        </tr>
      </thead>
      <tbody class="divide-y divide-gray-200">
        @foreach($recentbookings as $booking)
          <tr class="report-tr">
            <td class="report-td">{{ $booking->id }}</td>
            <td class="report-td">{{ $booking->user->name }}</td>
            <td class="report-td">{{ $booking->showtime->movie->title }}</td>
            <td class="report-td">{{ $booking->showtime->formatted_start_time }} - {{ $booking->showtime->screening_date }}</td>
            <td class="report-td">{{ $booking->seat->seat_number }}</td>
            <td class="report-td">{{ $booking->booking_code }}</td>
            <td class="report-td">{{ $booking->created_at }}</td>
            <td class="report-td @if($booking->status === 'confirmed') status-confirmed @elseif($booking->status === 'denied') status-denied @else status-pending @endif">
              {{ ucfirst($booking->status) }}
            </td>
          </tr>
        @endforeach
      </tbody>
    </table>
  </div>

  <h2 class="report-section-title">Last week's Bookings</h2>
  <div class="report-table-wrapper">
    <table class="report-table">
      <thead class="report-thead">
        <tr>
          <th class="report-th">ID</th>
          <th class="report-th">Origin Username</th>
          <th class="report-th">Movie Title</th>
          <th class="report-th">Showtime Time and Date</th>
          <th class="report-th">Seat Number</th>
          <th class="report-th">Booking Code</th>
          <th class="report-th">Created At</th>
          <th class="report-th">Status</th>
        </tr>
      </thead>
      <tbody class="divide-y divide-gray-200">
        @foreach($lastweekbookings as $booking)
          <tr class="report-tr">
            <td class="report-td">{{ $booking->id }}</td>
            <td class="report-td">{{ $booking->user->name }}</td>
            <td class="report-td">{{ $booking->showtime->movie->title }}</td>
            <td class="report-td">{{ $booking->showtime->formatted_start_time }} - {{ $booking->showtime->screening_date }}</td>
            <td class="report-td">{{ $booking->seat->seat_number }}</td>
            <td class="report-td">{{ $booking->booking_code }}</td>
            <td class="report-td">{{ $booking->created_at }}</td>
            <td class="report-td @if($booking->status === 'confirmed') status-confirmed @elseif($booking->status === 'denied') status-denied @else status-pending @endif">
              {{ ucfirst($booking->status) }}
            </td>
          </tr>
        @endforeach
      </tbody>
    </table>
  </div>
@endsection
