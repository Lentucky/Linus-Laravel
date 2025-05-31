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
    @foreach($movies as $movie)
    
            @php
                
                $selectedshowtimes = $showtimes->where('movie_id', $movie->id);
            @endphp

            <p style="text-align: center;">Movie Title: {{ $movie->title ?? "No Movie Title" }}</p>
                <form method="GET" style="text-align:center;" id="filterForm" action="{{ route('seat.search') }}" >
                    <label for="showtime_id">Screening Date:</label>
                    <select name="showtime_id" id="showtime_id">
                        <option value="">-- Please Select a Screening Date --</option>
                        @foreach($selectedshowtimes as $showtime)
                            <option value="{{ $showtime->id }}" {{ request('showtime_id') == $showtime->id ? 'selected' : '' }}>
                                Date: {{ $showtime->screening_date }} 
                            </option>
                        @endforeach
                    </select>
                    <input type="hidden" name="page" value="{{ $page }}"> <!--To be removed -->
                    <input type="hidden" name="movie_id" value="{{ $movie_id ?? 'null' }}">

                    <button type="submit">Search</button>
                </form>

            @if($showtimestoshow)
                @foreach( $showtimestoshow as $showtime)
                    <p style="text-align: center;">Screening Date: {{ $showtime->screening_date }}</p>
                    <p style="text-align: center;">Start Time: {{ $showtime->formatted_start_time }}</p>

                    <p style="text-align: center;">SCREEN</P>
                    <div style="margin: auto; width: 1400px; display: flex; flex-wrap: wrap;">
                        @foreach($seats->where('showtime_id', $showtime->id) as $seat)
                            @if($seat->showtime_id == $showtime->id) 
                                <div class="{{ $seat->is_booked ? 'opacity-30 cursor-not-allowed' : 'hover:opacity-80' }}" ><a href="{{ route('seat.edit', ['id' => $seat->id, 'search' => request('movie_id'), 'page' => request('page', 1)]) }}"><img style="width: 70px; height: 70px; object-fit: fit;" src="{{ asset('storage/images/seat.png') }}" alt="Uploaded Image">
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
                            @endif
                        @endforeach
                    </div> 
                    <a href="{{ route('seat.generate', $showtime->id) }}"><button onclick="return confirmDelete();">Generate Seats</button></a>   
                @endforeach
            @else
            <p style="text-align: center;">Screening Date: {{ $showtime->screening_date }}</p>
                    <p style="text-align: center;">Start Time: {{ $showtime->formatted_start_time }}</p>

                    <p style="text-align: center;">SCREEN</P>
                    <div style="margin: auto; width: 1400px; display: flex; flex-wrap: wrap;">
                        @foreach($seats->where('showtime_id', $showtime->id) as $seat)
                            @if($seat->showtime_id == $showtime->id) 
                                <div class="{{ $seat->is_booked ? 'opacity-30 cursor-not-allowed' : 'hover:opacity-80' }}" ><a href="{{ route('seat.edit', ['id' => $seat->id, 'search' => request('movie_id'), 'page' => request('page', 1)]) }}"><img style="width: 70px; height: 70px; object-fit: fit;" src="{{ asset('storage/images/seat.png') }}" alt="Uploaded Image">
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
                            @endif
                        @endforeach
                    </div> 
                    <a href="{{ route('seat.generate', $showtime->id) }}"><button onclick="return confirmDelete();">Generate Seats</button></a>           
           
            @endif
            
    
    @endforeach


<script>
        function confirmDelete() {
            return confirm("Are you sure you want to generate seats? WILL DUPLICATE");
        }

</script>
 
@endsection
