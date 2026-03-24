@extends('admin.layout')

@section('page_title', 'Admin Dashboard')

@section('content')
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-6 gap-4 mb-8">
        <div class="bg-white p-6 rounded-lg shadow">
            <h2 class="text-gray-500 text-sm font-medium mb-2">Total Users</h2>
            <p class="text-3xl font-bold text-gray-900">{{ $totalUsers }}</p>
        </div>
        <div class="bg-white p-6 rounded-lg shadow">
            <h2 class="text-gray-500 text-sm font-medium mb-2">Total Products</h2>
            <p class="text-3xl font-bold text-gray-900">{{ $totalProducts }}</p>
        </div>
        <div class="bg-white p-6 rounded-lg shadow">
            <h2 class="text-gray-500 text-sm font-medium mb-2">Total Sales</h2>
            <p class="text-3xl font-bold text-gray-900">${{ number_format($totalSales, 2) }}</p>
        </div>
        {{-- Card for Total Profit --}}
        <div class="bg-white p-6 rounded-lg shadow">
            <h2 class="text-gray-500 text-sm font-medium mb-2">Total Profit</h2>
            <p class="text-3xl font-bold text-gray-900">${{ number_format($totalProfit, 2) }}</p>
        </div>
        <div class="bg-white p-6 rounded-lg shadow">
            <h2 class="text-gray-500 text-sm font-medium mb-2">Pending Orders</h2>
            <p class="text-3xl font-bold text-gray-900">{{ $pendingOrders }}</p>
        </div>
        {{-- NEW: Card for Total Reviews with a link --}}
        <a href="{{ route('admin.reviews') }}" class="bg-white p-6 rounded-lg shadow hover:shadow-lg transition-shadow duration-300">
            <h2 class="text-gray-500 text-sm font-medium mb-2">Total Reviews</h2>
            <p class="text-3xl font-bold text-gray-900">{{ $totalReviews }}</p>
        </a>
    </div>
    
    <div class="bg-white p-8 rounded-lg shadow">
        <h2 class="text-xl font-semibold mb-4 text-gray-800">Welcome to the Admin Panel!</h2>
        <p class="text-gray-600">This is your main dashboard. You can navigate through the different sections using the sidebar on the left to manage your users, products, and orders.</p>
    </div>
@endsection