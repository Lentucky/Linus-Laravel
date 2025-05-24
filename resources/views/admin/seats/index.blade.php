@extends('layouts.app')

@section('title', 'Cinema Seats')

@section('content')
    <form method="GET" action="{{ route('seat.search') }}">
        <input type="text" name="search" value="{{ request('search') }}" placeholder="Search showtime, seats...">
        <button type="submit">Search</button>
    </form>
    <h1>Show seats here</h1>
    <a href="{{ route('seat.create') }}"><button>Create Seats</button></a>

    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Showtime Start Time</th>
                <th>Seat Number</th>
                <th>Booked Status</th> <!-- check means booked -->
        
                
            </tr>
        </thead>
        <tbody>
            @foreach($seats as $seat)
                <tr>
                    <td>{{$seat->id}}</td>
                    <td style="text-align: center;">{{$seat->showtime->start_time ?? 'No Showtime'}}</td>
                    <td><img style="width: 200px; height: 200px; object-fit: cover;" src="{{ asset('storage/images/seat.png') }}" alt="Uploaded Image">
                    <div style="
                        position: relative;
                        text-align: center;
                        top: 50%;
                        left: 50%;
                        transform: translate(-50%, -500%);
                        color: white;
                        font-size: 24px;
                        font-weight: bold;
                        text-shadow: 2px 2px 5px black;
                    ">
                    {{ $seat->seat_number }}
                    </div></img></td>
                    <td style="text-align: center;">@if($seat->is_booked) &#9989; @else &#10060; @endif</td>

                    <td><a href="{{ route('seat.edit', $seat->id) }}"> <button>Edit</button></a></td>
                </tr>
            @endforeach
        </tbody>

        
    </table>    
    {{ $seats->withQueryString()->links() }}
    <!-- Another format of admin panel seats -->
    <h1>Another format NOT BUTTON is a booked</h1> 
    <div style="display: flex; flex-wrap: wrap;">
        @foreach($seats as $seat)
        <div style="margin: 10px; line-height: 75px;">@if($seat->is_booked == false)Seat Number: <a href="{{ route('seat.edit', $seat->id) }}"><button>{{$seat->seat_number}}</button></a>
        @else
        Seat Number: <a href="{{ route('seat.edit', $seat->id) }}">{{$seat->seat_number}}</a>
        
        @endif
        </div>
        @endforeach
  
    </div>
@endsection