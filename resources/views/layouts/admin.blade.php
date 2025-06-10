<nav class="admin-navbar">
    <div class="admin-navbar-container">
        <h1 class="admin-navbar-title">Admin Panel</h1>
        <ul class="admin-navbar-links">
            <li><a href="{{ route('admin.dashboard') }}" class="admin-navbar-link">Dashboard</a></li>
            <li><a href="{{ route('movies.index') }}" class="admin-navbar-link">Movies</a></li>
            <li><a href="{{ route('showtimes.index') }}" class="admin-navbar-link">Showtimes</a></li>
            <li><a href="{{ route('seats.index') }}" class="admin-navbar-link">Seats</a></li>
            <li><a href="{{ route('customers.index') }}" class="admin-navbar-link">Customers</a></li>
            <li><a href="{{ route('admin.reports.index') }}" class="admin-navbar-link">Reports</a></li>
            <li>
                <form method="POST" action="{{ route('logout') }}" class="inline">
                    @csrf
                    <button type="submit" class="admin-logout-button">Logout</button>
                </form>
            </li>
        </ul>
    </div>
</nav>