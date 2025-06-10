@extends('layouts.app')

@section('title', 'Register - Cinema')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-gray-50 to-gray-100 flex items-center justify-center px-4 py-8">
    <div class="bg-white shadow-2xl rounded-2xl p-8 w-full max-w-md border border-gray-200">
        <div class="register-header">
            <h1 class="register-title">Create Account</h1>
            <p class="register-subtitle">Join Cinema to book your favorite movies</p>
        </div>

        <form method="POST" action="{{ route('register') }}" class="register-form">
            @csrf
            
            <div class="form-group">
                <label for="name" class="form-label">Full Name</label>
                <input 
                    type="text" 
                    id="name"
                    name="name" 
                    placeholder="Enter your full name" 
                    value="{{ old('name') }}" 
                    class="form-input @error('name') form-input-error @enderror"
                    required
                >
                @error('name')
                    <span class="form-error">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group">
                <label for="email" class="form-label">Email Address</label>
                <input 
                    type="email" 
                    id="email"
                    name="email" 
                    placeholder="Enter your email address" 
                    value="{{ old('email') }}" 
                    class="form-input @error('email') form-input-error @enderror"
                    required
                >
                @error('email')
                    <span class="form-error">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group">
                <label for="password" class="form-label">Password</label>
                <input 
                    type="password" 
                    id="password"
                    name="password" 
                    placeholder="Create a secure password" 
                    class="form-input @error('password') form-input-error @enderror"
                    required
                >
                @error('password')
                    <span class="form-error">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group">
                <label for="password_confirmation" class="form-label">Confirm Password</label>
                <input 
                    type="password" 
                    id="password_confirmation"
                    name="password_confirmation" 
                    placeholder="Confirm your password" 
                    class="form-input"
                    required
                >
            </div>

            <div class="form-actions">
                <button type="submit" class="register-button">
                    Create Account
                </button>
            </div>

            <div class="login-link">
                <p class="text-center text-gray-600">
                    Already have an account? 
                    <a href="{{ route('login') }}" class="auth-link">Sign in here</a>
                </p>
            </div>
        </form>
    </div>
</div>
@endsection