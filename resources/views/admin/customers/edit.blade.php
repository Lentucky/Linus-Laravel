@extends('layouts.app')

@section('title', 'Edit Customer')

@section('content')
<div class="admin-form-wrapper">
    <h2 class="admin-form-title">Edit Customer</h2>

    <form action="{{ route('customers.update', $customer->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-4">
            <label class="admin-form-label">Name</label>
            <input type="text" name="name" class="admin-form-input" value="{{ old('name', $customer->name) }}" required>
            @error('name') <p class="admin-error-text">{{ $message }}</p> @enderror
        </div>

        <div class="mb-4">
            <label class="admin-form-label">Email</label>
            <input type="email" name="email" class="admin-form-input" value="{{ old('email', $customer->email) }}" required>
            @error('email') <p class="admin-error-text">{{ $message }}</p> @enderror
        </div>

        <button type="submit" class="admin-btn btn-blue">Update</button>
        <a href="{{ route('customers.index') }}" class="admin-link">Cancel</a>
    </form>
</div>
@endsection
