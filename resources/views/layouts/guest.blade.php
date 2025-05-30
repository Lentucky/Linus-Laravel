<nav class="bg-gray-800 text-white px-6 py-3 shadow">
    <div class="max-w-7xl mx-auto flex justify-between items-center">
        <div class="text-xl font-bold">Cinema</div>
        <ul class="flex space-x-6 text-sm">
            <li><a href="{{ route('home') }}" class="hover:text-yellow-400">Home</a></li>
            <li><a href="{{ route('guest.showing') }}" class="hover:text-yellow-400">Showing</a></li>
            <li><a href="{{ route('guest.upcoming') }}" class="hover:text-yellow-400">Upcoming</a></li>
            <li><a href="{{ route('login') }}" class="hover:text-yellow-400">Login</a></li>
            <li><a href="{{ route('register') }}" class="hover:text-yellow-400">Register</a></li>
        </ul>
    </div>
</nav>
