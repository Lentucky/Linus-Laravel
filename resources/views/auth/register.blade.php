@extends('layouts.app')

@section('title', 'Welcome')

@section('content')
    <form method="POST" action="{{ route('register') }}">
    @csrf
    <input type="text" name="name" placeholder="Full Name" value="{{ old('name') }}" required>
    <input type="email" name="email" placeholder="Email" value="{{ old('email') }}" required>
    <input type="password" name="password" placeholder="Password" required>
    <input type="password" name="password_confirmation" placeholder="Confirm Password" required>
    <button type="submit">Register</button>
    </form>

@endsection