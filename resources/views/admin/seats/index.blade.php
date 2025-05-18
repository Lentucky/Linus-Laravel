@extends('layouts.app')

@section('title', 'Welcome')

@section('content')
    <h1>Show seats here</h1>
    @foreach($seats as $seat)
    <ul>
        <li>ID:{{$seat->id }} Seat Number: {{$seat->seat_number}} Booked: {{$seat->is_booked}}<a href="{{ route('seat.edit', $seat->id) }}">    <button>Edit</button></a></li>
    </ul>


    @endforeach
    <h1>Show available seats here</h1>
    <h1>Show taken seats here</h1>
@endsection