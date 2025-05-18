<nav>
    <ul>
        <li><a href="/">Home</a></li>
        <li><a href="{{ route('customer.movies.index') }}">Movies</a></li>
        {{-- <li><a href="{{ route('customer.showtimes') }}">Showtimes</a></li> --}}
        <li><a href="{{ route('customer.bookings.history') }}">Profile</a></li>
        
        @auth
            <li>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit">Logout</button>
                </form>
            </li>
        @endauth
    </ul>
</nav>


