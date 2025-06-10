@extends('layouts.app')

@section('title', 'Login - Cinema')

@section('content')
<div class="login-container">
    <div class="login-card">
        <div class="login-header">
            <h1 class="login-title">Welcome Back</h1>
            <p class="login-subtitle">Sign in to your Cinema account</p>
        </div>

        <form method="POST" action="{{ route('login') }}" class="login-form">
            @csrf
            
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
                    placeholder="Enter your password" 
                    class="form-input @error('password') form-input-error @enderror"
                    required
                >
                @error('password')
                    <span class="form-error">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-options">
                <label class="remember-label">
                    <input 
                        type="checkbox" 
                        name="remember" 
                        class="remember-checkbox"
                    >
                    <span class="remember-text">Remember me</span>
                </label>
                
                @if (Route::has('password.request'))
                    <a href="{{ route('password.request') }}" class="forgot-password-link">
                        Forgot password?
                    </a>
                @endif
            </div>

            <div class="form-actions">
                <button type="submit" class="login-button">
                    Sign In
                </button>
            </div>

            <div class="register-link">
                <p class="text-center text-gray-600">
                    Don't have an account? 
                    <a href="{{ route('register') }}" class="auth-link">
                        Create one here
                    </a>
                </p>
            </div>
        </form>
    </div>
</div>
@endsection