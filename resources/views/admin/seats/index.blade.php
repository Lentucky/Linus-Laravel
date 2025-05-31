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

            <h1 style="text-align: center;">Movie Title: {{ $movie->title ?? "No Movie Title" }}</h1>
            <form method="GET" action="{{ route('seat.search') }}" class="flex flex-col items-center gap-4 p-4 bg-white shadow-md rounded-lg w-full max-w-md mx-auto">
                <div class="w-full text-left">
                    <label for="showtime_id" class="block text-sm font-medium text-gray-700 mb-1">🎬 Search by Screening Date:</label>
                    <select name="showtime_id" id="showtime_id" class="block w-full mt-1 rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 text-sm">
                        <option value="">-- Please Select a Screening Date --</option>
                        @foreach($selectedshowtimes as $showtime)
                            <option value="{{ $showtime->id }}" {{ request('showtime_id') == $showtime->id ? 'selected' : '' }}>
                                Date: {{ $showtime->screening_date }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <input type="hidden" name="page" value="{{ $page }}">
                <input type="hidden" name="movie_id" value="{{ $movie_id ?? 'null' }}">

                <button type="submit" class="inline-flex justify-center px-4 py-2 text-sm font-medium text-white bg-indigo-600 border border-transparent rounded-md shadow-sm hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500">
                    🔍 Search
                </button>
            </form>

            @if($showtimestoshow)
                @foreach( $showtimestoshow as $showtime)
                    <p style="text-align: center;">{{ $showtime->movie->title ?? "No Movie Title" }}</p>
                    <p style="text-align: center;">Screening Date: {{ $showtime->screening_date }}</p>
                    <p style="text-align: center;">Start Time: {{ $showtime->formatted_start_time }}</p>

                    <p style="text-align: center;">SCREEN</P>
                    <div style="margin: auto; width: 1400px; display: flex; flex-wrap: wrap;">
                        @foreach($seats->where('showtime_id', $showtime->id) as $seat)

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

                        @endforeach
                    </div> 
                    <a href="{{ route('seat.generate', $showtime->id) }}"><button onclick="return confirmDelete();">Generate Seats</button></a>   
                @endforeach
            @else
            @foreach( $selectedshowtimes as $showtime)
                    <p style="text-align: center;">{{ $showtime->movie->title ?? "No Movie Title" }}</p>
                    <p style="text-align: center;">Screening Date: {{ $showtime->screening_date }}</p>
                    <p style="text-align: center;">Start Time: {{ $showtime->formatted_start_time }}</p>

                    <p style="text-align: center;">SCREEN</P>
                    <div style="margin: auto; width: 1400px; display: flex; flex-wrap: wrap;">
                        @foreach($seats->where('showtime_id', $showtime->id) as $seat)

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

                        @endforeach
                    </div> 
                    <a href="{{ route('seat.generate', $showtime->id) }}"><button onclick="return confirmDelete();">Generate Seats</button></a>   
                @endforeach
            @endif
            
    
    @endforeach


<script>
        function confirmDelete() {
            return confirm("Are you sure you want to generate seats? WILL DUPLICATE");
        }

</script>
 
@endsection
