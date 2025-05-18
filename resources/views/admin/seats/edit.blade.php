@extends('layouts.app')

@section('title', 'Welcome')

@section('content')
    <h1>Edit seat</h1>
    <form>
        <label for="showtime_id">Showtime_id:</label><br>
        <input type="text" id="showtime_id" name="showtime_id" value="{{ $seat->showtime_id }}"><br>
        <label for="seat_number">Seat Number:</label><br>
        <input type="text" id="seat_number" name="seat_number" value="{{ $seat->seat_number }}">    
    </form>
@endsection