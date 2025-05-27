@extends('layouts.app')

@section('title', 'Add Customer')

@section('content')
<div class="max-w-lg mx-auto bg-white p-6 shadow rounded mt-6">
    <h2 class="text-xl font-semibold mb-4">Add New Customer</h2>

    <form action="{{ route('customers.store') }}" method="POST">
        @csrf

        <div class="mb-4">
            <label class="block font-medium mb-1">Name</label>
            <input type="text" name="name" class="w-full border px-3 py-2 rounded" value="{{ old('name') }}" required>
            @error('name') <p class="text-red-500 text-sm">{{ $message }}</p> @enderror
        </div>

        <div class="mb-4">
            <label class="block font-medium mb-1">Email</label>
            <input type="email" name="email" class="w-full border px-3 py-2 rounded" value="{{ old('email') }}" required>
            @error('email') <p class="text-red-500 text-sm">{{ $message }}</p> @enderror
        </div>

        <div class="mb-4">
            <label class="block font-medium mb-1">Password</label>
            <input type="password" name="password" class="w-full border px-3 py-2 rounded" required>
            @error('password') <p class="text-red-500 text-sm">{{ $message }}</p> @enderror
        </div>

        <div class="mb-6">
            <label class="block font-medium mb-1">Confirm Password</label>
            <input type="password" name="password_confirmation" class="w-full border px-3 py-2 rounded" required>
        </div>

        <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-500">Create</button>
        <a href="{{ route('customers.index') }}" class="ml-2 text-sm text-gray-600 hover:underline">Cancel</a>
    </form>
</div>
@endsection
