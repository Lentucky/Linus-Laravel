@extends('layouts.app')

@section('title', 'Showtimes')

@section('content')
    <form method="GET" action="{{ route('showtimes.search') }}" class="admin-search-form">
        <input type="text" name="search" value="" placeholder="Search movie title..." class="admin-search-input">
        <button type="submit" class="admin-search-button">Search</button>
    </form>

    <div class="admin-section">
        <h1 class="admin-title">Show Showtime here</h1>

        <a href="{{ route('showtimes.create') }}">
            <button class="admin-button mb-4">Create Showtime</button>
        </a>

        <table class="admin-table">
            <thead class="admin-table-head">
                <tr>
                    <th class="admin-th">ID</th>
                    <th class="admin-th">Movie Title</th>
                    <th class="admin-th">Screening Time</th>
                    <th class="admin-th">Start Time</th>
                    <th class="admin-th">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($showtimes as $showtime)
                    <tr class="admin-tr">
                        <td class="admin-td">{{ $showtime->id }}</td>
                        <td class="admin-td">{{ $showtime->movie->title ?? 'No Movie' }}</td>
                        <td class="admin-td">{{ $showtime->screening_date }}</td>
                        <td class="admin-td">{{ $showtime->formatted_start_time }}</td>
                        <td class="admin-td">
                            <a href="{{ route('showtimes.edit', $showtime->id) }}" class="admin-action-link">Edit</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
