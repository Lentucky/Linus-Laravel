@extends('layouts.app')

@section('title', 'Add Movie')

@section('content')
    <h1>Add Movie</h1>
    <form action="{{ route('movies.store') }}" method="POST" enctype="multipart/form-data" onsubmit="return convertDuration();">
        @csrf

        <label for="genre_id">Genre:</label><br>
        <select type="text" name="genre_id"  required>
			@foreach($genres as $genre)
				<option value="{{ $genre->id }}">{{ $genre->name }}</option>
			@endforeach
		</select><br>
        <label for="title">Title:</label><br>
        <input type="text" id="title" placeholder="Title" name="title" value="" required><br>
        <label for="description">Description:</label><br>
        <input type="text" id="description" placeholder="Description" name="description" value="" required><br>
        <label for="duration">Duration by Hours:Minute ex. 10:30</label><br>
        <input type="text" id="duration_input" placeholder="HH:MM" required><br>
        <input type="hidden" name="duration" id="duration_hidden">
        <label for="poster">Poster:</label><br>

            <div>
                <img id="preview" src="#" alt="Image Preview" style="display:none; max-height: 200px;" />
            </div>                    
           <label for="poster_url">Choose an Image:</label>
           <input type="file" name="poster_url" id="poster_url"   onchange="previewImage(event)" required>
        <br>
        <button type="submit">Save Movie</button> 
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
                preview.style.display = 'block';
            };
            const file = event.target.files[0];
            if (file) {
                reader.readAsDataURL(event.target.files[0]);
            }else{
                preview.src = "#"
                preview.style.display = 'none';
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
	</script>  
@endsection