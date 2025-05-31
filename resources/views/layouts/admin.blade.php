<nav class="navbar">
    <div class="navbar-container">
        <h1 class="navbar-title">Admin Panel</h1>
        <ul class="navbar-links">
            <li><a href="{{ route('admin.dashboard') }}" class="navbar-link">Dashboard</a></li>
            <li><a href="{{ route('movies.index') }}" class="navbar-link">Movies</a></li>
            <li><a href="{{ route('showtimes.index') }}" class="navbar-link">Showtimes</a></li>
            <li><a href="{{ route('seats.index') }}" class="navbar-link">Seats</a></li>
            <li><a href="{{ route('customers.index') }}" class="navbar-link">Customers</a></li>
            <li><a href="{{ route('admin.reports.index') }}" class="navbar-link">Reports</a></li>
            <li>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="logout-button">Logout</button>
                </form>
            </li>
        </ul>
    </div>
</nav>
