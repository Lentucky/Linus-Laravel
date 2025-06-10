<nav class="guest-navbar">
    <div class="guest-navbar-container">
        <div class="guest-navbar-brand">Cinema</div>
        <ul class="guest-navbar-links">
            <li><a href="{{ route('home') }}" class="guest-navbar-link">Home</a></li>
            <li><a href="{{ route('guest.showing') }}" class="guest-navbar-link">Showing</a></li>
            <li><a href="{{ route('guest.upcoming') }}" class="guest-navbar-link">Upcoming</a></li>
            <li><a href="{{ route('login') }}" class="guest-login-link">Login</a></li>
            <li><a href="{{ route('register') }}" class="guest-register-link">Register</a></li>
        </ul>
    </div>
</nav>