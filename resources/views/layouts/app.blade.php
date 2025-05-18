<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>@yield('title', 'Cinema Booking System')</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
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
