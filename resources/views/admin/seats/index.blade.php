@extends('layouts.app')

@section('title', 'Cinema Seats')

@section('content')
    <form method="GET" action="{{ route('seat.search') }}">
        <label for="movie_id">Movies:</label>
        <select name="movie_id" id="movie_id">
            <option value="">-- All Movies --</option>
            @foreach($allmovies as $movie)
                <option value="{{ $movie->id }}" {{ request('movie_id') == $movie->id ? 'selected' : '' }}>
                    Title: {{ $movie->title }} 
                </option>
            @endforeach
        </select>

        <button type="submit">Search</button>
    </form>
    <h1>Show seats here</h1>
    <a href="{{ route('seat.create') }}"><button>Create Seats</button></a>

    @foreach($showtimes as $showtime)
    

            
            <p style="text-align: center;">Movie Title: {{ $showtime->movie->title ?? "No Movie Title" }}</p>
            <p style="text-align: center;">Screening Date: {{ $showtime->screening_date }}</p>
            <p style="text-align: center;">Start Time: {{ $showtime->formatted_start_time }}</p>
            <div style="display: flex; flex-wrap: wrap;">
                @foreach($seats->where('showtime_id', $showtime->id) as $seat)
                    @if($seat->showtime_id == $showtime->id) 
                        <div ><a href="{{ route('seat.edit', ['id' => $seat->id, 'search' => $showtime->movie->id, 'page' => request('page', 1)]) }}"><img style="width: 70px; height: 70px; object-fit: fit;" src="{{ asset('storage/images/seat.png') }}" alt="Uploaded Image">
                                                <div style="
                                                    position: relative;
                                                    text-align: center;
                                                    top: 50%;
                                                    left: 50%;
                                                    transform: translate(-50%, -430%);
                                                    color: white;
                                                    font-size: 10px;
                                                    font-weight: bold;
                                                    text-shadow: 2px 2px 5px black;
                                                    
                                                ">
                                                <div>{{ $seat->seat_number }}</div>
                                                <div>@if($seat->is_booked) &#10060; @else &#9989; @endif</div>
                                                </div></img>
                        
                            </a>
                        </div>
                    @endif
                @endforeach
            </div> 
            
    <a href="{{ route('seat.generate', $showtime->id) }}"><button onclick="return confirmDelete();">Generate Seats</button></a>   
    @endforeach

<div style="text-align:center;">{{ $showtimes->withQueryString()->links() }}</div>
<script>
        function confirmDelete() {
            return confirm("Are you sure you want to generate seats? WILL DUPLICATE");
        }
</script>
 
@endsection
