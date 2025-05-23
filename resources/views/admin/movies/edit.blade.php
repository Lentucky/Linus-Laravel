@extends('layouts.app')

@section('title', 'Edit')

@section('content')
    <h1>Edit Movie</h1>
    <form action="{{ route('movies.storeedit', $movie->id) }}" method="POST" enctype="multipart/form-data">
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
        <label for="duration">Duration by Hours:</label><br>
        <input type="text" id="duration" placeholder="Duration" name="duration" value="{{ $movie->duration }}" required><br>
        <label for="poster">Poster:</label><br>
            <div>
                <img id="preview" src="{{ asset('uploads/' . basename($movie->poster_url)) }}" alt="Image Preview" style="max-height: 200px;" />
            </div>                    
           <label for="poster_url">Choose an Image:</label>
           <input type="file" name="poster_url" id="poster_url"   onchange="previewImage(event)">
        <br>
        <button type="submit">Save Movie</button> 
    </form>
    <form action="{{ route('movies.delete', $movie->id) }}" method="POST">
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



    
	</script>  
@endsection