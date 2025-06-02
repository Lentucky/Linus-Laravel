@extends('layouts.app')

@section('title', 'Add Customer')

@section('content')
<div class="admin-form-wrapper">
    <h2 class="admin-form-title">Add New Customer</h2>

    <form action="{{ route('customers.store') }}" method="POST">
        @csrf

        <div class="mb-4">
            <label class="admin-form-label">Name</label>
            <input type="text" name="name" class="admin-form-input" value="{{ old('name') }}" required>
            @error('name') <p class="admin-error-text">{{ $message }}</p> @enderror
        </div>

        <div class="mb-4">
            <label class="admin-form-label">Email</label>
            <input type="email" name="email" class="admin-form-input" value="{{ old('email') }}" required>
            @error('email') <p class="admin-error-text">{{ $message }}</p> @enderror
        </div>

        <div class="mb-4">
            <label class="admin-form-label">Password</label>
            <input type="password" name="password" class="admin-form-input" required>
            @error('password') <p class="admin-error-text">{{ $message }}</p> @enderror
        </div>

        <div class="mb-6">
            <label class="admin-form-label">Confirm Password</label>
            <input type="password" name="password_confirmation" class="admin-form-input" required>
        </div>

        <button type="submit" class="admin-btn btn-blue">Create</button>
        <a href="{{ route('customers.index') }}" class="admin-link">Cancel</a>
    </form>
</div>
@endsection
