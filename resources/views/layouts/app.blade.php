<!-- resources/views/layouts/app.blade.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>@yield('title', 'Cinema Booking System')</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    @stack('styles')
</head>
<body>
    @yield('body')
    <script src="{{ asset('js/app.js') }}"></script>
    @stack('scripts')
</body>
</html>
