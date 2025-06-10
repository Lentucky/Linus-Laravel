@extends('layouts.app')

@section('title', 'Add Movie')

@section('head')
    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
@endsection

@section('content')
    <div class="max-w-2xl mx-auto bg-white p-8 rounded-lg shadow-lg mt-20">
        <h1 class="text-3xl font-bold text-gray-800 mb-8 text-center">Add Movie</h1>
        
        <form action="{{ route('movies.store') }}" method="POST" enctype="multipart/form-data" onsubmit="return convertDuration();" class="space-y-6">
            @csrf

            <div>
                <label for="genre_id" class="block text-sm font-medium text-gray-700 mb-2">Genre:</label>
                <select name="genre_id" id="genre_id" required 
                        class="w-full px-4 py-3 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition duration-200">
                    <option value="">Select a genre...</option>
                    @foreach($genres as $genre)
                        <option value="{{ $genre->id }}">{{ $genre->name }}</option>
                    @endforeach
                </select>
            </div>

            <div>
                <label for="title" class="block text-sm font-medium text-gray-700 mb-2">Title:</label>
                <input type="text" 
                       id="title" 
                       name="title" 
                       placeholder="Enter movie title"
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
                          class="w-full px-4 py-3 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition duration-200 resize-vertical"></textarea>
            </div>

            <div>
                <label for="duration_input" class="block text-sm font-medium text-gray-700 mb-2">Duration (Hours:Minutes):</label>
                <input type="text" 
                       id="duration_input" 
                       placeholder="HH:MM (e.g., 2:30)"
                       required
                       class="w-full px-4 py-3 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition duration-200">
                <input type="hidden" name="duration" id="duration_hidden">
                <p class="text-sm text-gray-500 mt-1">Enter duration in format HH:MM (e.g., 2:30 for 2 hours 30 minutes)</p>
            </div>

            <div>
                <label for="poster_url" class="block text-sm font-medium text-gray-700 mb-2">Movie Poster:</label>
                <div class="mt-1 flex justify-center px-6 pt-5 pb-6 border-2 border-gray-300 border-dashed rounded-md hover:border-blue-400 transition duration-200">
                    <div class="space-y-1 text-center">
                        <div id="preview-container" class="mb-4" style="display: none;">
                            <img id="preview" src="#" alt="Image Preview" class="mx-auto max-h-48 rounded-md shadow-sm" />
                        </div>
                        <svg class="mx-auto h-12 w-12 text-gray-400" stroke="currentColor" fill="none" viewBox="0 0 48 48">
                            <path d="M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v8a4 4 0 01-4 4H12a4 4 0 01-4-4v-4m32-4l-3.172-3.172a4 4 0 00-5.656 0L28 28M8 32l9.172-9.172a4 4 0 015.656 0L28 28m0 0l4 4m4-24h8m-4-4v8m-12 4h.02" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                        </svg>
                        <div class="flex text-sm text-gray-600">
                            <label for="poster_url" class="relative cursor-pointer bg-white rounded-md font-medium text-blue-600 hover:text-blue-500 focus-within:outline-none focus-within:ring-2 focus-within:ring-offset-2 focus-within:ring-blue-500">
                                <span>Upload a poster</span>
                                <input type="file" 
                                       name="poster_url" 
                                       id="poster_url" 
                                       accept="image/*"
                                       onchange="previewImage(event)" 
                                       required
                                       class="sr-only">
                            </label>
                            <p class="pl-1">or drag and drop</p>
                        </div>
                        <p class="text-xs text-gray-500">PNG, JPG, GIF up to 10MB</p>
                    </div>
                </div>
            </div>

            <div class="pt-4">
                <button type="submit" 
                        class="w-full bg-blue-600 hover:bg-blue-700 text-white font-semibold py-3 px-6 rounded-md shadow-md transition duration-200 transform hover:scale-105 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2">
                    Save Movie
                </button>
            </div>
        </form>
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
            const previewContainer = document.getElementById('preview-container');

            reader.onload = function () {
                preview.src = reader.result;
                previewContainer.style.display = 'block';
            };
            
            const file = event.target.files[0];
            if (file) {
                reader.readAsDataURL(event.target.files[0]);
            } else {
                preview.src = "#";
                previewContainer.style.display = 'none';
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