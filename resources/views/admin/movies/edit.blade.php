@extends('layouts.app')

@section('title', 'Edit Movie')

@section('head')
    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
@endsection

@section('content')
    <div class="max-w-2xl mx-auto bg-white p-8 rounded-lg shadow-lg mt-20">
        <h1 class="text-3xl font-bold text-gray-800 mb-8 text-center">Edit Movie</h1>
        
        <form action="{{ route('movies.storeedit', $movie->id) }}" method="POST" enctype="multipart/form-data" onsubmit="return convertDuration();" class="space-y-6">
            @csrf
            @method('PUT')

            <div>
                <label for="genre_id" class="block text-sm font-medium text-gray-700 mb-2">Genre:</label>
                <select name="genre_id" id="genre_id" required 
                        class="w-full px-4 py-3 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition duration-200">
                    @foreach($genres as $genre)
                        <option value="{{ $genre->id }}" {{ $genre->id == $movie->genre_id ? 'selected' : '' }}>
                            {{ $genre->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div>
                <label for="title" class="block text-sm font-medium text-gray-700 mb-2">Title:</label>
                <input type="text" 
                       id="title" 
                       name="title" 
                       placeholder="Enter movie title"
                       value="{{ $movie->title }}"
                       required
                       class="w-full px-4 py-3 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition duration-200">
            </div>

            <div>
                <label for="description" class="block text-sm font-medium text-gray-700 mb-2">Description:</label>
                <textarea id="description" 
                          name="description" 
                          placeholder="Enter movie description"
                          rows="4"
                          required
                          class="w-full px-4 py-3 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition duration-200 resize-vertical">{{ $movie->description }}</textarea>
            </div>

            <div>
                <label for="duration_input" class="block text-sm font-medium text-gray-700 mb-2">Duration (Hours:Minutes):</label>
                @php
                    $hours = floor($movie->duration / 60);
                    $minutes = $movie->duration % 60;
                @endphp
                <input type="text" 
                       id="duration_input" 
                       placeholder="HH:MM (e.g., 2:30)"
                       value="{{ sprintf('%d:%02d', $hours, $minutes) }}"
                       required
                       class="w-full px-4 py-3 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition duration-200">
                <input type="hidden" name="duration" id="duration_hidden">
                <p class="text-sm text-gray-500 mt-1">Enter duration in format HH:MM (e.g., 2:30 for 2 hours 30 minutes)</p>
            </div>

            <div>
                <label for="poster_url" class="block text-sm font-medium text-gray-700 mb-2">Movie Poster:</label>
                
                <!-- Current Poster Preview -->
                <div class="mb-4">
                    <p class="text-sm text-gray-600 mb-2">Current Poster:</p>
                    @if($movie->poster_url)
                        <img id="preview" 
                             src="{{ asset('uploads/' . basename($movie->poster_url)) }}" 
                             alt="Movie Poster" 
                             class="max-h-48 rounded-md shadow-sm border border-gray-200" />
                    @else
                        <img id="preview" 
                             src="{{ asset('storage/images/noimage.jpg') }}" 
                             alt="No Image" 
                             class="max-h-48 rounded-md shadow-sm border border-gray-200" />
                    @endif
                </div>

                <!-- File Upload Area -->
                <div class="mt-1 flex justify-center px-6 pt-5 pb-6 border-2 border-gray-300 border-dashed rounded-md hover:border-blue-400 transition duration-200">
                    <div class="space-y-1 text-center">
                        <svg class="mx-auto h-12 w-12 text-gray-400" stroke="currentColor" fill="none" viewBox="0 0 48 48">
                            <path d="M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v8a4 4 0 01-4 4H12a4 4 0 01-4-4v-4m32-4l-3.172-3.172a4 4 0 00-5.656 0L28 28M8 32l9.172-9.172a4 4 0 015.656 0L28 28m0 0l4 4m4-24h8m-4-4v8m-12 4h.02" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                        </svg>
                        <div class="flex text-sm text-gray-600">
                            <label for="poster_url" class="relative cursor-pointer bg-white rounded-md font-medium text-blue-600 hover:text-blue-500 focus-within:outline-none focus-within:ring-2 focus-within:ring-offset-2 focus-within:ring-blue-500">
                                <span>Upload new poster</span>
                                <input type="file" 
                                       name="poster_url" 
                                       id="poster_url" 
                                       accept="image/*"
                                       onchange="previewImage(event)"
                                       class="sr-only">
                            </label>
                            <p class="pl-1">or drag and drop</p>
                        </div>
                        <p class="text-xs text-gray-500">PNG, JPG, GIF up to 10MB (Optional - leave blank to keep current poster)</p>
                    </div>
                </div>
            </div>

            <div class="pt-4 space-y-4">
                <button type="submit" 
                        class="w-full bg-blue-600 hover:bg-blue-700 text-white font-semibold py-3 px-6 rounded-md shadow-md transition duration-200 transform hover:scale-105 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2">
                    Update Movie
                </button>
            </div>
        </form>

        <!-- Delete Form -->
        <div class="mt-8 pt-6 border-t border-gray-200">
            <div class="bg-red-50 p-4 rounded-md">
                <h3 class="text-lg font-medium text-red-800 mb-2">Danger Zone</h3>
                <p class="text-sm text-red-600 mb-4">Once you delete this movie, there is no going back. Please be certain.</p>
                <form action="{{ route('movies.delete', $movie->id) }}" method="POST" onsubmit="return confirmDelete();" class="inline">
                    @csrf
                    @method('DELETE')
                    <button type="submit" 
                            class="bg-red-600 hover:bg-red-700 text-white font-semibold py-2 px-4 rounded-md shadow-md transition duration-200 transform hover:scale-105 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2">
                        Delete Movie
                    </button>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
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
            return confirm("Are you sure you want to delete this movie? This action cannot be undone.");
        }
    </script>  
@endsection