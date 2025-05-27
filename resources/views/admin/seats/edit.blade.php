@extends('layouts.app')

@section('title', 'Welcome')

@section('content')
    <h1>Edit seat</h1>
    <form action="{{ route('seat.storeedit') }}" method="POST">
        @csrf
        <input type="hidden" id="id" name="id" value="{{ $seat->id }}" required><br>
        <label for="showtime_id">Showtime Date:</label><br>
        <select type="text" id="showtime_id" name="showtime_id" required>
			@foreach($showtimes as $showtime)
				<option value="{{ $showtime->id }}"{{ $showtime->id == $seat->showtime_id ? 'selected' : ''  }}>ID: {{ $showtime->id }} Movie Title: {{$showtime->movie->title ?? 'No Title'}} Screening Date: {{$showtime->screening_date}} Start Time: {{$showtime->start_time}}</option>
			@endforeach
		</select><br>
        
        <label for="seat_number">Seat Number:</label><br>
        <input type="text" id="seat_number" name="seat_number" value="{{ $seat->seat_number }}" required><br>
        <label for="is_booked">Booked? :</label><br>
        <select id="is_booked" name="is_booked" required>
            <option value="0"{{ $seat->is_booked == false ? 'selected' : ''}}>False</option>
            <option value="1"{{ $seat->is_booked == true ? 'selected' : ''}}>True</option>
        </select><br>
        <input type="hidden" name="search" value="{{ $search }}">
        <button type="submit">Save</button> 
    </form>
    <form action="{{ route('seat.delete', $seat->id) }}" method="POST">
        @csrf
        @method('DELETE')
        <button type="submit">Delete Seat</button>
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
	</script>    
@endsection
