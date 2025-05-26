@extends('layouts.app')

@section('title', 'Edit Showtime')

@section('content')
    <h1>Edit Showtime</h1>
    <form action="{{ route('showtimes.storeedit', $showtime->id) }}" method="POST">
        @csrf
        @method('PUT')
        <p>Showtime ID: {{ $showtime->id }}</p>
        <label for="movie_id">Movie Name:</label><br>
        <select type="text" name="movie_id"  required>
			@foreach($movies as $movie)
				<option value="{{ $movie->id }}" {{ $movie->id == $showtime->movie_id ? 'selected' : ''  }}>Movie Title: {{$movie->title}} Genre: {{$movie->genre->name}}</option>
			@endforeach
		</select><br>
        <label for="screening_date">Screening Date:</label><br>
        <input type="date" id="screening_date" placeholder="" name="screening_date" value="{{ $showtime->screening_date }}" required><br>
        <label for="start_time">Start Time:</label><br>
        <input type="time" id="start_time" placeholder="" name="start_time" value="{{ $showtime->start_time }}" required><br>
        <button type="submit">Save Showtime</button> 
    </form>
    <form action="{{ route('showtimes.delete', $showtime->id) }}" method="POST" onsubmit="return confirmDelete();">
        @csrf
        @method('DELETE')
        <button type="submit">Delete Showtime</button>
    </form>

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

        function confirmDelete() {
            return confirm("Are you sure you want to delete this Showtime?");
        }
	</script>  
@endsection