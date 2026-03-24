@extends('vendor.layout')

@section('page_title', 'Dashboard')

@section('content')
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
        <div class="bg-white p-6 rounded-lg shadow">
            <h2 class="text-gray-500 text-sm font-medium">Total Products</h2>
            {{-- UPDATED: Use a variable for the count --}}
            <p class="text-3xl font-bold mt-2">{{ $totalProducts }}</p>
        </div>
        <div class="bg-white p-6 rounded-lg shadow">
            <h2 class="text-gray-500 text-sm font-medium">Total Sales</h2>
            {{-- UPDATED: Use a variable for the total sales --}}
            <p class="text-3xl font-bold mt-2">${{ number_format($vendorSales, 2) }}</p>
        </div>
        {{-- NEW: Card for Total Profit --}}
        <div class="bg-white p-6 rounded-lg shadow">
            <h2 class="text-gray-500 text-sm font-medium">Total Profit</h2>
            <p class="text-3xl font-bold mt-2">${{ number_format($vendorProfit, 2) }}</p>
        </div>
        {{-- NEW: Card for Pending Approval --}}
        <div class="bg-white p-6 rounded-lg shadow">
            <h2 class="text-gray-500 text-sm font-medium">Pending Approval</h2>
            <p class="text-3xl font-bold mt-2">{{ $pendingApproval }}</p>
        </div>
    </div>

    <div class="bg-white p-6 rounded-lg shadow">
        <h2 class="text-xl font-bold">Recent Orders</h2>
        <p class="mt-2 text-gray-600">This is where a list of your recent sales will appear.</p>
    </div>
@endsection