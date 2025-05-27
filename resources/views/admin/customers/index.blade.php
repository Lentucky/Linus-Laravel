@extends('layouts.app')

@section('title', 'Cinema Movies')

@section('content')
    <form method="GET" action="{{ route('movies.search') }}">
        <input type="text" name="search" value="{{ request('search') }}" placeholder="Search movies titles">
        <button type="submit">Search</button>
    </form>
    <h1>Show Movies here</h1>
    <a href="{{ route('movies.create') }}"><button>Create Movie</button></a>
    
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>E-mail</th>
                <th>Password</th>
                <th>Account Creation</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td></td>
            </tr>
        </tbody>

      
        
    </table>
      {{ $movies->withQueryString()->links(); }}

    
    
 
@endsection