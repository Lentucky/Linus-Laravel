<nav class="bg-gray-800 text-white px-6 py-3 shadow">
    <div class="max-w-7xl mx-auto flex justify-between items-center">
        <div class="text-xl font-bold">Cinema</div>
        <ul class="flex space-x-6 text-sm">
            <li><a href="{{ route('home') }}" class="hover:text-yellow-400">Home</a></li>
            <li><a href="{{ route('customer.movies.index') }}" class="hover:text-yellow-400">Showing</a></li>
            <li><a href="{{ route('customer.movies.index') }}" class="hover:text-yellow-400">Upcoming</a></li>
            <li><a href="{{ route('customer.bookings.history') }}" class="hover:text-yellow-400">Profile</a></li>
            <li>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="hover:text-red-400">Logout</button>
                </form>
            </li>
        </ul>
    </div>
</nav>
