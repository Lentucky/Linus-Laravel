@extends('layouts.app')

@section('head')
    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
@endsection

@section('content')
    <div class="max-w-2xl mx-auto bg-white p-8 rounded-lg shadow-lg">
        <h1 class="text-3xl font-bold text-gray-800 mb-8 text-center">Create Showtime</h1>
        
        <form action="{{ route('showtimes.store') }}" method="POST" class="space-y-6">
            @csrf

            <div>
                <label for="movie_id" class="block text-sm font-medium text-gray-700 mb-2">Movie Name:</label>
                <select name="movie_id" id="movie_id" required 
                        class="w-full px-4 py-3 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition duration-200">
                    <option value="">Select a movie...</option>
                    @foreach($movies as $movie)
                        <option value="{{ $movie->id }}">
                            ID: {{ $movie->id }} - {{ $movie->title }} ({{ $movie->genre->name }})
                        </option>
                    @endforeach
                </select>
            </div>

            <div>
                <label for="screening_date" class="block text-sm font-medium text-gray-700 mb-2">Screening Date:</label>
                <input type="date" 
                       id="screening_date" 
                       name="screening_date" 
                       required
                       class="w-full px-4 py-3 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition duration-200">
            </div>

            <div>
                <label for="start_time" class="block text-sm font-medium text-gray-700 mb-2">Start Time:</label>
                <input type="time" 
                       id="start_time" 
                       name="start_time" 
                       required
                       class="w-full px-4 py-3 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition duration-200">
            </div>

            <div class="pt-4">
                <button type="submit" 
                        class="w-full bg-blue-600 hover:bg-blue-700 text-white font-semibold py-3 px-6 rounded-md shadow-md transition duration-200 transform hover:scale-105 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2">
                    Save Showtime
                </button>
            </div>
        </form>
    </div>
@endsection

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