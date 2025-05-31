@extends('layouts.app')

@section('title', 'Showtimes')

@section('content')
    <form method="GET" action="{{ route('showtimes.search') }}">
        <input type="text" name="search" value="" placeholder="Search showtime, seats...">
        <button type="submit">Search</button>
    </form>
    <div class="mas-w-6xl mx-auto p-4">
        <h1 class="text-2xl font-bold mb-4">Show Showtime here</h1>
        <a href="{{ route('showtimes.create') }}"><button>Create Showtime</button></a>
        <table class="w-full bg-white shadow border rounded mt-4 text-sm">
            <thead class="bg-gray-100">
                <tr>
                    <th>ID</th>
                    <th>Movie Title</th>
                    <th>Screening Time</th>
                    <th>Start Time</th>
                </tr>
            </thead>
            <tbody>
                @foreach($showtimes as $showtime)
                    <tr class="border-t">
                        <td style="text-align: center;" class="p-2">{{$showtime->id}}</td>
                        <td style="text-align: center;" class="p-2">{{$showtime->movie->title ?? 'No Movie'}}</td>
                        <td style="text-align: center;" class="p-2">{{$showtime->screening_date}}</td>
                        <td style="text-align: center;" class="p-2">{{$showtime->formatted_start_time}}</td>
        
                        <td><a href="{{ route('showtimes.edit', $showtime->id) }}"> <button class="text-blue-600 hover:underline">Edit</button></a></td>
                    </tr>
                @endforeach
            </tbody>
        
        </table>
    </div>
@endsection