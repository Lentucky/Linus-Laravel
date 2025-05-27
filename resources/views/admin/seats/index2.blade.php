        <form method="GET" action="{{ route('seat.search') }}">
        <input type="text" name="search" value="{{ request('search') }}" placeholder="Search showtime, seats...">
        <button type="submit">Search</button>
    </form>
    
    @foreach($showtimes as $showtime)
        @if($seats->where('showtime_id',$showtime->id)->count() > 0)
            <p>Showtime: {{ $showtime->start_time }}</p>
            <p>Movie Title: {{ $showtime->movie->title }}</p>
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th style="width: 200px;">Movie Title</th>
                        <th style="width: 200px;">Screening Date</th>
                        <th>Showtime Start Time</th>
                        <th>Seat Number</th>
                        <th>Booked Status</th> <!-- check means booked -->
                
                        
                    </tr>
                </thead>
                <tbody>
                    @foreach($seats as $seat)
                        @if($seat->showtime_id == $showtime->id)
                            <tr>
                                <td>{{$seat->id}}</td>
                                <td style="text-align: center;">{{ $seat->showtime->movie->title}}</td>
                                <td style="text-align: center;">{{ $seat->showtime->screening_date }}</td>
                                <td style="text-align: center;">{{$seat->showtime->formatted_start_time ?? 'No Showtime'}}</td>
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
                        @endif
                    @endforeach
                </tbody>

                
            </table>
        @endif
    @endforeach    