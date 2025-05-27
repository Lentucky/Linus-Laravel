@extends('layouts.app')

@section('title', 'Cinema Seats')

@section('content')
    <form method="GET" action="{{ route('seat.search') }}">
        <label for="showtime_id">Showtimes:</label>
        <select name="showtime_id" id="showtime_id">
            <option value="">-- All Cinemas --</option>
            @foreach($showtimes as $showtime)
                <option value="{{ $showtime->id }}" {{ request('search') == $showtime->id ? 'selected' : '' }}>
                    Title: {{ $showtime->movie->title }} Date: {{ $showtime->screening_date}}
                </option>
            @endforeach
        </select>

        <button type="submit">Search</button>
    </form>
    <h1>Show seats here</h1>
    <a href="{{ route('seat.create') }}"><button>Create Seats</button></a>

    @foreach($showtimes as $showtime)
        @if($seats->where('showtime_id',$showtime->id)->count() > 0)

            
            <p style="text-align: center;">Movie Title: {{ $showtime->movie->title ?? "No Movie Title" }}</p>
            <p style="text-align: center;">Start Time: {{ $showtime->formatted_start_time }}</p>
            <div style="display: flex; flex-wrap: wrap;">
                @foreach($selectedseats = $seats->where('showtime_id', $showtime->id) as $seat)
                    @if($seat->showtime_id == $showtime->id)
                        <div ><a href="{{ route('seat.edit', $seat->id) }}"><img style="width: 70px; height: 70px; object-fit: fit;" src="{{ asset('storage/images/seat.png') }}" alt="Uploaded Image">
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
                                                <div>@if($seat->is_booked) &#9989; @else &#10060; @endif</div>
                                                </div></img>
                        
                            </a>
                        </div>
                    @endif
                @endforeach
            </div> 
        @endif
    @endforeach
<div style="text-align:center;">{{ $seats->withQueryString()->links() }}</div>

 
@endsection
