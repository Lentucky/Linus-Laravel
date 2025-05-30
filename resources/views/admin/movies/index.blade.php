@extends('layouts.app')

@section('title', 'Cinema Movies')

@section('content')
        <form method="GET" action="{{ route('movies.search') }}" class="max-w-md mx-auto pt-6">
            <div class="relative">
                <input type="text" name="search" value="{{ request('search') }}" placeholder="Search movies titles"
                class="block w-full p-4 ps-10 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Search Mockups, Logos..." required />
                <button type="submit"
                class="text-white absolute end-2.5 bottom-2.5 bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-4 py-2 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                    Search</button>
            </div>
        </form>

    <div class="max-w-6xl mx-auto p-2">
        <h1 class="text-2xl font-bold mb-4">Movie List</h1>


        <h1>Show Movies here</h1>
        <a href="{{ route('movies.create') }}"><button>Create Movie</button></a>
        
        <form method="GET" action="{{ route('movies.index') }}" class="mb-4 max-w-xs">
            <select name="filter" onchange="this.form.submit()" class="w-full border p-2 rounded">
                <option value="">-- Filter Movies --</option>
                <option value="showing" {{ request('filter') === 'showing' ? 'selected' : '' }}>Now Showing</option>
                <option value="upcoming" {{ request('filter') === 'upcoming' ? 'selected' : '' }}>Upcoming</option>
                <option value="expired" {{ request('filter') === 'expired' ? 'selected' : '' }}>Expired</option>
            </select>
        </form>
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Genre</th>
                    <th>Title</th>
                    <th>Description</th>
                    <th>Duration</th>
                    <th>Poster</th>
        
        
                </tr>
            </thead>
            <tbody>
                @foreach($movies as $movie)
                    <tr>
                        <td>{{$movie->id}}</td>
                        <td>{{$movie->genre->name ?? 'No Genre'}}</td>
                        <td style="text-align: center;">{{$movie->title}}</td>
                        <td style="text-align: center; width: 500px;">{{$movie->description}}</td>
                        <td>{{$movie->formatted_duration}}</td>
                        <td>@if($movie->poster_url)<img style="width: 200px; height: 200px; object-fit: fill;" src="{{ asset('uploads/' . basename($movie->poster_url)) }}" alt="Uploaded Image" />@else
                        <img style="width: 200px; height: 200px; object-fit: fill;" src="{{ asset('storage/images/noimage.jpg') }}" alt="No Image" />
                        @endif
        
                        </td>
                        <td><a href="{{ route('movies.edit', $movie->id) }}"> <button class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-500 mb-4 inline-block">Edit</button></a></td>
                    </tr>
                @endforeach
            </tbody>
        
        
        </table>
          {{ $movies->withQueryString()->links(); }}
    </div>

    
    
 
@endsection