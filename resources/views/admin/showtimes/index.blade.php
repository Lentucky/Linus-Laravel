@extends('layouts.app')

@section('title', 'Showtimes')

@section('content')
    <form method="GET" action="">
        <input type="text" name="search" value="" placeholder="Search showtime, seats...">
        <button type="submit">Search</button>
    </form>
    <h1>Show Showtime here</h1>
    <a href=""><button>Create Showtime</button></a>
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
            @foreach($showtimes as $showtime)
                <tr>
                    <td>{{$showtime->id}}</td>
                    <td>{{$showtime->movie->title ?? 'No Movie'}}</td>
                    <td>{{$showtime->screening_time}}</td>
                    <td>{{$showtime->description}}</td>
                    <td>{{$showtime->duration}}</td>
                    
                    <td><a href="{{ route('showtimes.edit', $showtime->id) }}"> <button>Edit</button></a></td>
                </tr>
            @endforeach
        </tbody>


        
    </table>
@endsection