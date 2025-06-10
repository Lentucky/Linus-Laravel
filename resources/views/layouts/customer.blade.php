<nav class="customer-navbar">
    <div class="customer-navbar-container">
        <div class="customer-navbar-title">Cinema</div>
        <ul class="customer-navbar-links">
            <li><a href="{{ route('home') }}" class="customer-navbar-link">Home</a></li>
            <li><a href="{{ route('customer.showing') }}" class="customer-navbar-link">Showing</a></li>
            <li><a href="{{ route('customer.upcoming') }}" class="customer-navbar-link">Upcoming</a></li>
            <li><a href="{{ route('customer.bookings.history') }}" class="customer-navbar-link">Profile</a></li>
            <li>
                <form method="POST" action="{{ route('logout') }}" class="inline">
                    @csrf
                    <button type="submit" class="customer-logout-button">Logout</button>
                </form>
            </li>
        </ul>
    </div>
</nav>