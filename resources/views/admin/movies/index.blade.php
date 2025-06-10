@extends('layouts.app')

@section('title', 'Cinema Movies')

@section('head')
    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
@endsection

@section('content')
    <div class="max-w-7xl mx-auto p-6 pt-20">
        <!-- Search Form -->
        <div class="bg-white p-6 rounded-lg shadow-lg mb-8">
            <form method="GET" action="{{ route('movies.search') }}" class="max-w-md mx-auto">
                <div class="relative">
                    <input type="text" 
                           name="search" 
                           value="{{ request('search') }}" 
                           placeholder="Search movie titles..."
                           class="w-full px-4 py-3 pl-10 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition duration-200" 
                           required />
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                        <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                        </svg>
                    </div>
                    <button type="submit"
                            class="absolute right-2 top-2 bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2 px-4 rounded-md shadow-md transition duration-200 transform hover:scale-105 focus:outline-none focus:ring-2 focus:ring-blue-500">
                        Search
                    </button>
                </div>
            </form>
        </div>

        <!-- Header and Controls -->
        <div class="bg-white p-6 rounded-lg shadow-lg mb-8">
            <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-4 mb-6">
                <h1 class="text-3xl font-bold text-gray-800">Movie List</h1>
                <a href="{{ route('movies.create') }}">
                    <button class="bg-blue-600 hover:bg-blue-700 text-white font-semibold py-3 px-6 rounded-md shadow-md transition duration-200 transform hover:scale-105 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2">
                        Create Movie
                    </button>
                </a>
            </div>
            
            <!-- Filter Form -->
            <form method="GET" action="{{ route('movies.index') }}" class="max-w-xs">
                <label for="filter" class="block text-sm font-medium text-gray-700 mb-2">Filter Movies:</label>
                <select name="filter" 
                        id="filter"
                        onchange="this.form.submit()" 
                        class="w-full px-4 py-3 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition duration-200">
                    <option value="">-- All Movies --</option>
                    <option value="showing" {{ request('filter') === 'showing' ? 'selected' : '' }}>Now Showing</option>
                    <option value="upcoming" {{ request('filter') === 'upcoming' ? 'selected' : '' }}>Upcoming</option>
                    <option value="expired" {{ request('filter') === 'expired' ? 'selected' : '' }}>Expired</option>
                </select>
            </form>
        </div>

        <!-- Movies Table -->
        <div class="bg-white rounded-lg shadow-lg overflow-hidden">
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">ID</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Genre</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Title</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Description</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Duration</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Poster</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @foreach($movies as $movie)
                            <tr class="hover:bg-gray-50 transition duration-200">
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                    {{ $movie->id }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                                        {{ $movie->genre->name ?? 'No Genre' }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 text-sm font-medium text-gray-900 max-w-xs">
                                    {{ $movie->title }}
                                </td>
                                <td class="px-6 py-4 text-sm text-gray-500 max-w-md">
                                    <div class="truncate" title="{{ $movie->description }}">
                                        {{ Str::limit($movie->description, 100) }}
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                    {{ $movie->formatted_duration }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    @if($movie->poster_url)
                                        <img class="h-20 w-16 object-cover rounded-md shadow-sm" 
                                             src="{{ asset('uploads/' . basename($movie->poster_url)) }}" 
                                             alt="Movie Poster" />
                                    @else
                                        <img class="h-20 w-16 object-cover rounded-md shadow-sm bg-gray-100" 
                                             src="{{ asset('storage/images/noimage.jpg') }}" 
                                             alt="No Image" />
                                    @endif
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                    <a href="{{ route('movies.edit', $movie->id) }}">
                                        <button class="bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2 px-4 rounded-md shadow-md transition duration-200 transform hover:scale-105 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2">
                                            Edit
                                        </button>
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            
            <!-- Pagination -->
            @if($movies->hasPages())
                <div class="bg-white px-4 py-3 border-t border-gray-200 sm:px-6">
                    {{ $movies->withQueryString()->links() }}
                </div>
            @endif
        </div>
    </div>
@endsection