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
    {{ $showtimes->first() }}
    @foreach($movies as $movie)
    

            
            <p style="text-align: center;">Movie Title: {{ $movie->title ?? "No Movie Title" }}</p>
            <p style="text-align: center;">Screening Date: {{ $showtimes->where('movie_id', $movie->id)->first()->screening_date }}</p>
            <p style="text-align: center;">Start Time: {{ $showtimes->where('movie_id', $movie->id)->first()->formatted_start_time }}</p>
                <form method="GET" action="{{route('seat.searchbyshowtime')}}">
                <div style = "text-align: center;">
                    <label for="showtime_id">Movies:</label>
                    <select name="showtime_id" id="showtime_id">
                        <option value="">-- Screening Date --</option>
                        @foreach($allshowtimes->where('movie_id', $movie->id) as $showtimeatcurrentmovie)
                            <option value="{{ $showtimeatcurrentmovie->id }}" {{ request('movie_id') == $showtimeatcurrentmovie->id ? 'selected' : '' }}>
                                Screening Date: {{ $showtimeatcurrentmovie->screening_date }} 
                            </option>
                        @endforeach
                    </select>
                    <input type="hidden" name="page" value="{{ request('page', 1) }}">
                    <button type="submit">Search</button>
                </div>
                </form>
                <p style="text-align: center;">SCREEN</P>
                <div style="margin: auto; width: 1400px; display: flex; flex-wrap: wrap;">
                    @foreach($seats->where('showtime_id', $showtimes->where('movie_id', $movie->id)->first()->id) as $seat)
                            <div ><a href="{{ route('seat.edit', ['id' => $seat->id, 'search' => request('movie_id'), 'page' => request('page', 1)]) }}"><img style="width: 70px; height: 70px; object-fit: fit;" src="{{ asset('storage/images/seat.png') }}" alt="Uploaded Image">
                                                    <div style="
                                                        position: relative;
                                                        text-align: center;
                                                        top: 50%;
                                                        left: 50%;
                                                        transform: translate(-50%, -350%);
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
                    @endforeach
                </div> 
            
            
            <a href="{{ route('seat.generate', $showtimes->where('movie_id', $movie->id)->first()->id) }}"><button onclick="return confirmDelete();">Generate Seats</button></a>  
            
    @endforeach

<div style="text-align:center;">{{ $movies->links() }}</div>
<script>
        function confirmDelete() {
            return confirm("Are you sure you want to generate seats? WILL DUPLICATE");
        }
</script>
 
@endsection
