@extends('layouts.app')

@section('title', 'Showtimes')

@section('content')
    <form method="GET" action="">
        <input type="text" name="search" value="" placeholder="Search showtime, seats...">
        <button type="submit">Search</button>
    </form>
    <h1>Show Showtime here</h1>
    <a href=""><button>Create Showtime</button></a>
    @foreach($seats as $seat)
    <ul>
        <li>ID:{{$seat->id }} Showtime ID: {{ $seat->showtime_id }} Seat Number: {{$seat->seat_number}} Booked: {{$seat->is_booked}}<a href="{{ route('seat.edit', $seat->id) }}">       <button>Edit</button></a></li>
    </ul>


    @endforeach
    {{  }}
 
    <!-- Another format of admin panel seats -->
    <h1>Another format NOT BUTTON is a booked</h1> 
    <div style="display: flex; flex-wrap: wrap;">
        @foreach($seats as $seat)
        <div style="margin: 10px; line-height: 75px;">@if($seat->is_booked == false)Seat Number: <a href="{{ route('seat.edit', $seat->id) }}"><button>{{$seat->seat_number}}</button></a>
        @else
        Seat Number: <a href="">{{}}</a>
        
        @endif
        </div>
        @endforeach
  
    </div>
@endsection