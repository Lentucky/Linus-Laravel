<nav class="bg-gray-800 text-white p-4 shadow">
    <div class="container mx-auto flex justify-between items-center">
        <h1 class="text-xl font-bold">Admin Panel</h1>
        <ul class="flex space-x-6">
            <li><a href="{{ route('admin.dashboard') }}" class="hover:text-yellow-400">Dashboard</a></li>
            <li><a href="{{ route('movies.index') }}" class="hover:text-yellow-400">Movies</a></li>
            <li><a href="{{ route('showtimes.index') }}" class="hover:text-yellow-400">Showtimes</a></li>
            <li><a href="{{ route('seats.index') }}" class="hover:text-yellow-400">Seats</a></li>
            <li><a href="{{ route('admin.reports.index') }}" class="hover:text-yellow-400">Reports</a></li>
            <li>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button class="hover:text-red-400" type="submit">Logout</button>
                </form>
            </li>
        </ul>
    </div>
</nav>
