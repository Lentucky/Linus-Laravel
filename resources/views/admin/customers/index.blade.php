@extends('layouts.app')

@section('title', 'Customers')

@section('content')
<div class="admin-container">
    <h1 class="admin-title">Customer List</h1>

    <a href="{{ route('customers.create') }}" class="btn-new-customer">+ New Customer</a>

    <table class="admin-table">
        <thead class="admin-table-head">
            <tr>
                <th class="admin-table-cell">Name</th>
                <th class="admin-table-cell">Email</th>
                <th class="admin-table-cell">Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($customers as $customer)
                <tr class="admin-table-row">
                    <td class="admin-table-cell">{{ $customer->name }}</td>
                    <td class="admin-table-cell">{{ $customer->email }}</td>
                    <td class="admin-table-cell">
                        <a href="{{ route('customers.edit', $customer->id) }}" class="link-edit">Edit</a>
                        <form action="{{ route('customers.destroy', $customer->id) }}" method="POST" class="inline-block ml-2" onsubmit="return confirm('Delete this customer?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="link-delete">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
