@extends('layouts.app')

@section('title', 'Welcome')

@section('content')
    <h1>Add seat</h1>
    <form action="{{ route('seat.store') }}" method="POST">
        @csrf

        <label for="showtime_id">Showtime Date, Movie Name:</label><br>
        <select type="text" name="showtime_id"  required>
			@foreach($showtimes as $showtime)
				<option value="{{ $showtime->id }}">ID: {{ $showtime->id }} Movie Title: {{$showtime->movie->title ?? 'No Title'}} Screening Date: {{$showtime->screening_date}} Start Time: {{$showtime->start_time}}</option>
			@endforeach
		</select><br>
        <label for="seat_number">Seat Number:</label><br>
        <input type="text" id="seat_number" placeholder="Seat Number" name="seat_number" value="" required><br>
        <label for="is_booked">Booked? :</label><br>
        <select id="is_booked" name="is_booked" required>
            <option value="0">False</option>
            <option value="1">True</option>
        </select><br>
        <button type="submit">Save Seat</button> 
    </form>
    <form>

	<script>
        //For validation change if not gonna use
		toastr.options.timeOut = 0;
		toastr.options.closeButton = true;
		@if($errors->any())
			@foreach($errors->all() as $error)
				console.log("{{ $error }}");
				toastr.error('{{ $error }}');
			@endforeach
		@endif
	</script>  
@endsection