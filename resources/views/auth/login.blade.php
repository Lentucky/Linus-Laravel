@extends('layouts.app')

@section('title', 'Welcome')

@section('content')
    <form method="POST" action="{{ route('login') }}">
    @csrf
    <input type="email" name="email" placeholder="Email" value="{{ old('email') }}" required>
    <input type="password" name="password" placeholder="Password" required>
    <label>
        <input type="checkbox" name="remember"> Remember Me
    </label>
    <button type="submit">Login</button>
    </form>

@endsection