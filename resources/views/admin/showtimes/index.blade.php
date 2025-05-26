@extends('layouts.app')

@section('title', 'Showtimes')

@section('content')
    <form method="GET" action="">
        <input type="text" name="search" value="" placeholder="Search showtime, seats...">
        <button type="submit">Search</button>
    </form>
    <h1>Show Showtime here</h1>
    <a href="{{ route('showtimes.create') }}"><button>Create Showtime</button></a>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Movie Title</th>
                <th>Screening Time</th>
                <th>Start Time</th>              
            </tr>
        </thead>
        <tbody>
            @foreach($showtimes as $showtime)
                <tr>
                    <td>{{$showtime->id}}</td>
                    <td style="text-align: center;">{{$showtime->movie->title ?? 'No Movie'}}</td>
                    <td>{{$showtime->screening_date}}</td>
                    <td>{{$showtime->formatted_start_time}}</td>
                    
                    <td><a href="{{ route('showtimes.edit', $showtime->id) }}"> <button>Edit</button></a></td>
                </tr>
            @endforeach
        </tbody>


        
    </table>
@endsection