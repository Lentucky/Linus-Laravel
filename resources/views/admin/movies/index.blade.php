@extends('layouts.app')

@section('title', 'Cinema Movies')

@section('content')
    <form method="GET" action="">
        <input type="text" name="search" value="" placeholder="Search movies">
        <button type="submit">Search</button>
    </form>
    <h1>Show Movies here</h1>
    <a href="{{ route('movies.create') }}"><button>Create Movie</button></a>
    
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
                    <td>{{$movie->title}}</td>
                    <td>{{$movie->description}}</td>
                    <td>{{$movie->formatted_duration}}</td>
                    <td><img style="width: 200px; height: 200px; object-fit: cover;" src="{{ asset('uploads/' . basename($movie->poster_url)) }}" alt="Uploaded Image"></td>
                    <td><a href="{{ route('movies.edit', $movie->id) }}"> <button>Edit</button></a></td>
                </tr>
            @endforeach
        </tbody>


        
    </table>
    

    
    
 
@endsection