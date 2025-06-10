<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>@yield('title', 'Cinema Booking System')</title>
    @auth
        @if (Auth::user()->role === 'admin')
            @vite('resources/css/admin.css')
        @else
            @vite('resources/css/app.css')
        @endif
    @else
        @vite('resources/css/app.css')
    @endauth

    <!-- ADDED FOR TOASTR LIBRARY  REMOVE IF NOT GONNA USE-->
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.css" integrity="sha512-3pIirOrwegjM6erE5gPSwkUzO+3cTjpnV9lexlNZqvupR64iZBnOOTiiLPb9M36zpMScbmUNIcHUqKD47M719g==" crossorigin="anonymous" referrerpolicy="no-referrer" />
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js" integrity="sha512-VEd+nq25CkR676O+pLBnDW09R7VQX9Mdiij052gVCp5yVH3jGtH70Ho/UUv4mJDsEdTvqRCFZg0NKGiojGnUCw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>    
    @stack('styles')
</head>
<body class="min-h-screen flex flex-col ">

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

    <main class="content flex-grow">
        @yield('content')
    </main>

    <footer class="bg-gray-900 text-gray-300 mt-auto">
        <div class="max-w-7xl mx-auto px-6 py-2 grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-6">
            <!-- Branding -->
            <div>
                <h3 class="text-xl font-semibold text-white">🎬 My Cinema</h3>
                <p class="mt-2 text-sm">
                    Your favorite movie spot for all the latest blockbusters. Book. Watch. Enjoy.
                </p>
            </div>

            <!-- Contact -->
            <div>
                <h4 class="font-semibold text-white mb-3">Contact Us</h4>
                <ul class="text-sm space-y-2">
                    <li>Email: support@mycinema.com</li>
                    <li>Phone: +63 912 345 6789</li>
                    <li>Location: NU Laguna, Philippines</li>
                </ul>
            </div>
        </div>

        <div class="border-t border-gray-700 py-3 text-center text-sm text-gray-400">
            &copy; {{ date('Y') }} My Cinema. All rights reserved.
        </div>
    </footer>

    <script src="{{ asset('js/app.js') }}"></script>
    @stack('scripts')
</body>
</html>