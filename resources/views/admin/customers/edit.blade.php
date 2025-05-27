@extends('layouts.app')

@section('title', 'Edit Customer')

@section('content')
<div class="max-w-lg mx-auto bg-white p-6 shadow rounded mt-6">
    <h2 class="text-xl font-semibold mb-4">Edit Customer</h2>

    <form action="{{ route('customers.update', $customer->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-4">
            <label class="block font-medium mb-1">Name</label>
            <input type="text" name="name" class="w-full border px-3 py-2 rounded" value="{{ old('name', $customer->name) }}" required>
            @error('name') <p class="text-red-500 text-sm">{{ $message }}</p> @enderror
        </div>

        <div class="mb-4">
            <label class="block font-medium mb-1">Email</label>
            <input type="email" name="email" class="w-full border px-3 py-2 rounded" value="{{ old('email', $customer->email) }}" required>
            @error('email') <p class="text-red-500 text-sm">{{ $message }}</p> @enderror
        </div>

        <button type="submit" class="bg-green-600 text-white px-4 py-2 rounded hover:bg-green-500">Update</button>
        <a href="{{ route('customers.index') }}" class="ml-2 text-sm text-gray-600 hover:underline">Cancel</a>
    </form>
</div>
@endsection
