<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>@yield('title', 'Cinema Booking System')</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">

    <!-- ADDED FOR TOASTR LIBRARY  REMOVE IF NOT GONNA USE-->
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.css" integrity="sha512-3pIirOrwegjM6erE5gPSwkUzO+3cTjpnV9lexlNZqvupR64iZBnOOTiiLPb9M36zpMScbmUNIcHUqKD47M719g==" crossorigin="anonymous" referrerpolicy="no-referrer" />
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js" integrity="sha512-VEd+nq25CkR676O+pLBnDW09R7VQX9Mdiij052gVCp5yVH3jGtH70Ho/UUv4mJDsEdTvqRCFZg0NKGiojGnUCw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>    
    @stack('styles')
</head>
<body>

    <header>
        @auth
            @if (Auth::user()->role === 'admin')
                @include('layouts.admin')
            @elseif (Auth::user()->role === 'customer')
                @include('layouts.customer')
            @else
                @include('layouts.guest')
            @endif
        @else
            @include('layouts.guest')
        @endauth
    </header>



    <main class="content">
        @yield('content')
    </main>

    <footer>
        <p>&copy; {{ date('Y') }} My Cinema</p>
    </footer>

    <script src="{{ asset('js/app.js') }}"></script>
    @stack('scripts')
</body>
</html>
