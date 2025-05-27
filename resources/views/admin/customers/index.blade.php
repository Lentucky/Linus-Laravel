@extends('layouts.app')

@section('title', 'Customers')

@section('content')
    <div class="max-w-4xl mx-auto p-4">
        <h1 class="text-2xl font-bold mb-4">Customer List</h1>

        <a href="{{ route('customers.create') }}" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-500 mb-4 inline-block">+ New Customer</a>

        <table class="w-full bg-white shadow border rounded mt-4 text-sm">
            <thead class="bg-gray-100">
                <tr>
                    <th class="text-left p-2">Name</th>
                    <th class="text-left p-2">Email</th>
                    <th class="text-left p-2">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($customers as $customer)
                    <tr class="border-t">
                        <td class="p-2">{{ $customer->name }}</td>
                        <td class="p-2">{{ $customer->email }}</td>
                        <td class="p-2">
                            <a href="{{ route('customers.edit', $customer->id) }}" class="text-blue-600 hover:underline">Edit</a>
                            <form action="{{ route('customers.destroy', $customer->id) }}" method="POST" class="inline-block ml-2" onsubmit="return confirm('Delete this customer?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-600 hover:underline">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
