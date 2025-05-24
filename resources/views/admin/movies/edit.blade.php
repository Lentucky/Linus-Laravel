@extends('layouts.app')

@section('title', 'Edit')

@section('content')
    <h1>Edit Movie</h1>
    <form action="{{ route('movies.storeedit', $movie->id) }}" method="POST" enctype="multipart/form-data" onsubmit="return convertDuration();">
        @csrf
        @method('PUT')
        <label for="genre_id">Genre:</label><br>
        <select type="text" name="genre_id"  required>
			@foreach($genres as $genre)
				<option value="{{ $genre->id }}"{{ $genre->id == $movie->genre_id ? 'selected' : ''  }}>{{ $genre->name }}</option>
			@endforeach
		</select><br>
        <label for="title">Title:</label><br>
        <input type="text" id="title" placeholder="Title" name="title" value="{{ $movie->title }}" required><br>
        <label for="description">Description:</label><br>
        <input type="text" id="description" placeholder="Description" name="description" value="{{ $movie->description }}" required><br>
        <label for="duration">Duration by Hours:Minute ex. 10:30</label><br>
        @php
            $hours = floor($movie->duration / 60);
            $minutes = $movie->duration % 60;
        @endphp        
        <input type="text" id="duration_input" placeholder="HH:MM" value="{{ $hours }}:{{ $minutes }}"required><br>
        <input type="hidden" name="duration" id="duration_hidden">
        <label for="poster">Poster:</label><br>
            <div>
                <img id="preview" src="{{ asset('uploads/' . basename($movie->poster_url)) }}" alt="Image Preview" style="max-height: 200px;" />
            </div>                    
           <label for="poster_url">Choose an Image:</label>
           <input type="file" name="poster_url" id="poster_url"   onchange="previewImage(event)">
        <br>
        <button type="submit">Save Movie</button> 
    </form>
    <form action="{{ route('movies.delete', $movie->id) }}" method="POST" onsubmit="return confirmDelete();">
        @csrf
        @method('DELETE')
        <button type="submit">Delete Movie</button>
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

        function previewImage(event) {
            const reader = new FileReader();
            const preview = document.getElementById('preview');

            reader.onload = function () {
                preview.src = reader.result;
            };

            if (event.target.files[0]) {
                reader.readAsDataURL(event.target.files[0]);
            }
        }
        
        function convertDuration() {
            const input = document.getElementById('duration_input').value.trim();

            // Validate HH:MM format using regex
            const match = input.match(/^(\d{1,2}):(\d{2})$/);
            if (!match) {
                toastr.error("Please enter a valid duration in HH:MM format.");
                return false;
            }

            const hours = parseInt(match[1], 10);
            const minutes = parseInt(match[2], 10);

            if (minutes >= 60) {
                toastr.error("Minutes must be less than 60.");
                return false;
            }

            const totalMinutes = (hours * 60) + minutes;

            document.getElementById('duration_hidden').value = totalMinutes;

            return true; // submit form
        }    

        function confirmDelete() {
            return confirm("Are you sure you want to delete this movie?");
        }

    
	</script>  
@endsection