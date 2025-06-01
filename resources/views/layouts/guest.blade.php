<nav class="navbar">
    <div class="navbar-container">
        <div class="navbar-brand">Cinema</div>
        <ul class="navbar-links">
            <li><a href="{{ route('home') }}" class="navbar-link">Home</a></li>
            <li><a href="{{ route('guest.showing') }}" class="navbar-link">Showing</a></li>
            <li><a href="{{ route('guest.upcoming') }}" class="navbar-link">Upcoming</a></li>
            <li><a href="{{ route('login') }}" class="navbar-link">Login</a></li>
            <li><a href="{{ route('register') }}" class="navbar-link">Register</a></li>
        </ul>
    </div>
</nav>
