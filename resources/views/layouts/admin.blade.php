<nav>
    <ul>
        <li><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
        <li><a href="{{ route('movies.index') }}">Movies</a></li>
        <li><a href="{{ route('showtimes.index') }}">Showtimes</a></li>
        <li><a href="{{ route('seats.index') }}">Seats</a></li>
        <li><a href="{{ route('admin.reports.index') }}">Reports</a></li>
        <li>
            <form method="POST" action="{{ route('logout') }}" style="display: inline;">
                @csrf
                <button type="submit">Logout</button>
            </form>
        </li>
    </ul>
</nav>

