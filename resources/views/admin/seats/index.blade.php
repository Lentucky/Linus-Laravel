@extends('layouts.app')

@section('title', 'Cinema Seats')

@section('content')
    <form method="GET" action="{{ route('seat.search') }}">
        <input type="text" name="search" value="{{ request('search') }}" placeholder="Search showtime, seats...">
        <button type="submit">Search</button>
    </form>
    <h1>Show seats here</h1>
    <a href="{{ route('seat.create') }}"><button>Create Seats</button></a>
    @foreach($seats as $seat)
    <ul>
        <li>ID:{{$seat->id }} Showtime Start Time: {{ $seat->showtime->start_time }} Seat Number: {{$seat->seat_number}} Booked: @if($seat->is_booked) &#9989; @else &#10060; @endif<a href="{{ route('seat.edit', $seat->id) }}">       <button>Edit</button></a></li>
    </ul>


    @endforeach
    {{ $seats->withQueryString()->links(); }}
 
    <!-- Another format of admin panel seats -->
    <h1>Another format NOT BUTTON is a booked</h1> 
    <div style="display: flex; flex-wrap: wrap;">
        @foreach($seats as $seat)
        <div style="margin: 10px; line-height: 75px;">@if($seat->is_booked == false)Seat Number: <a href="{{ route('seat.edit', $seat->id) }}"><button>{{$seat->seat_number}}</button></a>
        @else
        Seat Number: <a href="{{ route('seat.edit', $seat->id) }}">{{$seat->seat_number}}</a>
        
        @endif
        </div>
        @endforeach
  
    </div>
@endsection