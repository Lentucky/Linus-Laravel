<nav class="navbar">
    <div class="navbar-container">
        <div class="navbar-title">Cinema</div>
        <ul class="navbar-links">
            <li><a href="{{ route('home') }}" class="navbar-link">Home</a></li>
            <li><a href="{{ route('customer.showing') }}" class="navbar-link">Showing</a></li>
            <li><a href="{{ route('customer.upcoming') }}" class="navbar-link">Upcoming</a></li>
            <li><a href="{{ route('customer.bookings.history') }}" class="navbar-link">Profile</a></li>
            <li>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="logout-button">Logout</button>
                </form>
            </li>
        </ul>
    </div>
</nav>
