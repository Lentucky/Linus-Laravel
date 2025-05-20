@extends('layouts.app')

@section('title', 'Welcome')

@section('content')
    <h1>Show seats here</h1>
    <a href="{{ route('seat.create') }}"><button>Create Seats</button></a>
    @foreach($seats as $seat)
    <ul>
        <li>ID:{{$seat->id }} Showtime ID: {{ $seat->showtime_id }} Seat Number: {{$seat->seat_number}} Booked: {{$seat->is_booked}}<a href="{{ route('seat.edit', $seat->id) }}">       <button>Edit</button></a></li>
    </ul>


    @endforeach
    <!-- Another format of admin panel seats -->
    <h1>Another format NOT BUTTON is a booked</h1> 
    <div style="display: flex;">
        @foreach($seats as $seat)
        <div style="margin-right: 50px;">@if($seat->is_booked == false)Seat Number: <a href="{{ route('seat.edit', $seat->id) }}"><button>{{$seat->seat_number}}</button></a>
        @else
        Seat Number: <a href="{{ route('seat.edit', $seat->id) }}">{{$seat->seat_number}}</a>
        
        @endif
        </div>
        @endforeach
  
    </div>
@endsection