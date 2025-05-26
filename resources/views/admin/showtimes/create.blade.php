@extends('layouts.app')

@section('title', 'Create Showtime')

@section('content')
    <h1>Create Showtime</h1>
    <form action="{{ route('showtimes.store') }}" method="POST">
        @csrf

        <label for="movie_id">Movie Name:</label><br>
        <select type="text" name="movie_id"  required>
			@foreach($movies as $movie)
				<option value="{{ $movie->id }}">ID: {{ $movie->id }} Movie Title: {{$movie->title}} Genre: {{$movie->genre->name}}</option>
			@endforeach
		</select><br>
        <label for="screening_date">Screening Date:</label><br>
        <input type="date" id="screening_date" placeholder="" name="screening_date" value="" required><br>
        <label for="start_time">Start Time:</label><br>
        <input type="time" id="start_time" placeholder="" name="start_time" value="" required><br>
        <button type="submit">Save Showtime</button> 
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