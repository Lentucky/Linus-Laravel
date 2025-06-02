@extends('layouts.app')

@section('title', 'Welcome')

@section('content')
<div class="dashboard-wrapper">
    <h1 class="dashboard-section-title">Now Showing</h1>

    <div class="movie-grid">
        @foreach ($currentshowing as $movie)
            <div class="movie-card">
                <img src="{{ asset('uploads/' . basename($movie->poster_url)) }}" alt="{{ $movie->title }}" class="movie-poster">
                <div class="movie-info">
                    <h2 class="movie-title">{{ $movie->title }}</h2>
                    <p class="movie-genre">{{ $movie->genre->name ?? 'No genre' }}</p>
                    <p class="movie-description">{{ Str::limit($movie->description, 80) }}</p>
                    <p class="movie-duration">Duration: {{ $movie->duration }} mins</p>

                    @auth
                        <a href="{{ route('admin.dashboard.selectShowtime', $movie->id) }}" class="btn-book">
                            View Seats
                        </a>
                    @else
                        <a href="{{ route('login') }}" class="btn-login">
                            Login to Book
                        </a>
                    @endauth
                </div>
            </div>
        @endforeach
    </div>
</div>

<div class="dashboard-wrapper">
    <h1 class="dashboard-section-title">Upcoming</h1>

    <div class="movie-grid">
        @foreach ($upcomingshowing as $movie)
            <div class="movie-card">
                <img src="{{ asset('uploads/' . basename($movie->poster_url)) }}" alt="{{ $movie->title }}" class="movie-poster">
                <div class="movie-info">
                    <h2 class="movie-title">{{ $movie->title }}</h2>
                    <p class="movie-genre">{{ $movie->genre->name ?? 'No genre' }}</p>
                    <p class="movie-description">{{ Str::limit($movie->description, 80) }}</p>
                    <p class="movie-duration">Duration: {{ $movie->duration }} mins</p>

                    @auth
                        <a href="{{ route('admin.dashboard.selectShowtime', $movie->id) }}" class="btn-book">
                            View Seats
                        </a>
                    @else
                        <a href="{{ route('login') }}" class="btn-login">
                            Login to Book
                        </a>
                    @endauth
                </div>
            </div>
        @endforeach
    </div>
</div>
@endsection
