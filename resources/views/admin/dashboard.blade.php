@extends('layouts.app')

@section('title', 'Welcome')

@section('content')
    <h1>Admin</h1>
    <!DOCTYPE html>
<html>
<head>
    <title>Cinema Booking Dashboard</title>
    <style>
        .seat { 
            display: inline-block; 
            width: 30px; height: 30px; 
            margin: 3px; 
            text-align: center; 
            line-height: 30px; 
            border: 1px solid #333; 
            cursor: pointer;
        }
        .booked { background-color: #f44336; color: white; cursor: not-allowed; }
        .available { background-color: #4CAF50; color: white; }
        .seat-label {
            cursor: pointer;
            user-select: none;
            margin: 3px;
            padding: 5px 10px;
            border: 1px solid #333;
            display: inline-block;
            border-radius: 4px;
        }

        .seat-label.booked {
            background-color: #f44336;
            color: white;
            cursor: not-allowed;
        }

        .seat-label.available {
            background-color: #4CAF50;
            color: white;
        }

        .seat-label.selected {
            outline: 3px solid #ffeb3b;
            background-color: #ffc107;
            color: black;
        }
    </style>
</head>
<body>
    <h1>Cinema Booking Dashboard</h1>

    @if(session('error'))
        <p style="color:red">{{ session('error') }}</p>
    @endif
    @if(session('success'))
        <p style="color:green">{{ session('success') }}</p>
    @endif

    @foreach($movies as $movie)
        <h2>{{ $movie->title }}</h2>
        <p>{{ $movie->description }}</p>

        @foreach($showtimes as $showtime)
            @if($showtime->movie_id == $movie->id)
                <h3>Showtime: {{ $showtime->start_time }}</h3>
                <form method="POST" action="">
                    @csrf
                    <div>
                        @foreach($seats as $seat)
                            @if($seat->showtime_id == $showtime->id)
                                <label class="seat-label {{ $seat->is_booked ? 'booked' : 'available' }}">
                                    <input 
                                        type="radio" 
                                        name="seat_id" 
                                        value="{{ $seat->id }}" 
                                        {{ $seat->is_booked ? 'disabled' : '' }}
                                        class="seat-input"
                                        style="display:none"
                                    >
                                    <span>{{ $seat->seat_number }}</span>
                                </label>
                            @endif
                        @endforeach
                    </div>
                    <!--<button type="submit">Book Selected Seat</button>-->
                </form>
            @endif
        @endforeach
    @endforeach

</body>
</html>
<script>
    document.querySelectorAll('.seat-input').forEach(input => {
        input.addEventListener('change', function() {
            // Remove 'selected' class from all seat labels
            document.querySelectorAll('.seat-label.selected').forEach(label => {
                label.classList.remove('selected');
            });
            
            // Add 'selected' class to the label of the checked input
            if (this.checked) {
                this.closest('label').classList.add('selected');
            }
        });
    });
</script>
@endsection