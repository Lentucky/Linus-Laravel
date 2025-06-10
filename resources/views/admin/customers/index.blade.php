@extends('layouts.app')

@section('title', 'Customers')

@section('head')
    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
@endsection

@section('content')
    <div class="max-w-7xl mx-auto p-6 pt-20">
        <!-- Header Section -->
        <div class="bg-white p-6 rounded-lg shadow-lg mb-8">
            <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-4">
                <div>
                    <h1 class="text-3xl font-bold text-gray-800 mb-2">👥 Customer Management</h1>
                    <p class="text-gray-600">Manage your cinema customers and their information</p>
                </div>
                <a href="{{ route('customers.create') }}">
                    <button class="bg-green-600 hover:bg-green-700 text-white font-semibold py-3 px-6 rounded-md shadow-md transition duration-200 transform hover:scale-105 focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-offset-2">
                        ➕ New Customer
                    </button>
                </a>
            </div>
        </div>

        <!-- Customer Statistics -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
            <div class="bg-gradient-to-r from-blue-500 to-blue-600 p-6 rounded-lg shadow-lg text-white">
                <div class="flex items-center justify-between">
                    <div>
                        <h3 class="text-lg font-semibold">Total Customers</h3>
                        <p class="text-3xl font-bold">{{ $customers->count() }}</p>
                    </div>
                    <div class="text-4xl opacity-80">👥</div>
                </div>
            </div>
            
            <div class="bg-gradient-to-r from-green-500 to-green-600 p-6 rounded-lg shadow-lg text-white">
                <div class="flex items-center justify-between">
                    <div>
                        <h3 class="text-lg font-semibold">Active Today</h3>
                        <p class="text-3xl font-bold">{{ $customers->where('created_at', '>=', today())->count() }}</p>
                    </div>
                    <div class="text-4xl opacity-80">⭐</div>
                </div>
            </div>
            
            <div class="bg-gradient-to-r from-purple-500 to-purple-600 p-6 rounded-lg shadow-lg text-white">
                <div class="flex items-center justify-between">
                    <div>
                        <h3 class="text-lg font-semibold">New This Week</h3>
                        <p class="text-3xl font-bold">{{ $customers->where('created_at', '>=', now()->startOfWeek())->count() }}</p>
                    </div>
                    <div class="text-4xl opacity-80">📈</div>
                </div>
            </div>
        </div>

        <!-- Customer Table -->
        <div class="bg-white rounded-lg shadow-lg overflow-hidden">
            <!-- Table Header -->
            <div class="bg-gradient-to-r from-blue-600 to-blue-700 text-white p-6">
                <h2 class="text-2xl font-bold text-center">📋 Customer Directory</h2>
            </div>

            <!-- Table Content -->
            @if($customers->count() > 0)
                <div class="overflow-x-auto">
                    <table class="w-full">
                        <thead class="bg-gray-50 border-b border-gray-200">
                            <tr>
                                <th class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    👤 Customer Name
                                </th>
                                <th class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    📧 Email Address
                                </th>
                                <th class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    📅 Joined Date
                                </th>
                                <th class="px-6 py-4 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    ⚙️ Actions
                                </th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @foreach ($customers as $customer)
                                <tr class="hover:bg-gray-50 transition-colors duration-200">
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="flex items-center">
                                            <div class="flex-shrink-0 h-10 w-10">
                                                <div class="h-10 w-10 rounded-full bg-gradient-to-r from-blue-400 to-blue-500 flex items-center justify-center text-white font-bold text-lg">
                                                    {{ strtoupper(substr($customer->name, 0, 1)) }}
                                                </div>
                                            </div>
                                            <div class="ml-4">
                                                <div class="text-sm font-medium text-gray-900">{{ $customer->name }}</div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="text-sm text-gray-900">{{ $customer->email }}</div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="text-sm text-gray-500">{{ $customer->created_at->format('M d, Y') }}</div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-center">
                                        <div class="flex items-center justify-center space-x-2">
                                            <a href="{{ route('customers.edit', $customer->id) }}" 
                                               class="bg-blue-500 hover:bg-blue-600 text-white px-3 py-2 rounded-md text-sm font-medium transition duration-200 transform hover:scale-105 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2">
                                                ✏️ Edit
                                            </a>
                                            <form action="{{ route('customers.destroy', $customer->id) }}" 
                                                  method="POST" 
                                                  class="inline-block" 
                                                  onsubmit="return confirm('Are you sure you want to delete {{ $customer->name }}? This action cannot be undone.');">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" 
                                                        class="bg-red-500 hover:bg-red-600 text-white px-3 py-2 rounded-md text-sm font-medium transition duration-200 transform hover:scale-105 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2">
                                                    🗑️ Delete
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @else
                <!-- Empty State -->
                <div class="text-center py-12">
                    <div class="text-6xl mb-4">👤</div>
                    <h3 class="text-xl font-semibold text-gray-800 mb-2">No Customers Yet</h3>
                    <p class="text-gray-600 mb-6">Get started by adding your first customer to the system.</p>
                    <a href="{{ route('customers.create') }}">
                        <button class="bg-green-600 hover:bg-green-700 text-white font-semibold py-3 px-6 rounded-md shadow-md transition duration-200 transform hover:scale-105 focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-offset-2">
                            ➕ Add First Customer
                        </button>
                    </a>
                </div>
            @endif
        </div>

        <!-- Quick Actions Section -->
        <div class="bg-gray-50 border border-gray-200 rounded-lg p-6 mt-8">
            <div class="text-center space-y-3">
                <h3 class="text-lg font-semibold text-gray-800">🚀 Quick Actions</h3>
                <div class="flex flex-col sm:flex-row justify-center gap-4">
                    <a href="{{ route('customers.create') }}" 
                       class="bg-green-500 hover:bg-green-600 text-white px-4 py-2 rounded-md font-medium transition duration-200">
                        ➕ Add New Customer
                    </a>
                    <button onclick="window.print()" 
                            class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded-md font-medium transition duration-200">
                        🖨️ Print Customer List
                    </button>
                    <button onclick="exportToCSV()" 
                            class="bg-purple-500 hover:bg-purple-600 text-white px-4 py-2 rounded-md font-medium transition duration-200">
                        📊 Export to CSV
                    </button>
                </div>
            </div>
        </div>
    </div>

    <script>
        function exportToCSV() {
            // Simple CSV export functionality
            let csv = 'Name,Email,Joined Date\n';
            @foreach($customers as $customer)
                csv += '{{ $customer->name }},{{ $customer->email }},{{ $customer->created_at->format("M d, Y") }}\n';
            @endforeach
            
            const blob = new Blob([csv], { type: 'text/csv' });
            const url = window.URL.createObjectURL(blob);
            const a = document.createElement('a');
            a.setAttribute('hidden', '');
            a.setAttribute('href', url);
            a.setAttribute('download', 'customers.csv');
            document.body.appendChild(a);
            a.click();
            document.body.removeChild(a);
        }
    </script>
@endsection