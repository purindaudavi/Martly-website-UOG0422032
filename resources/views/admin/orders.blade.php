@extends('admin.layout')

@section('page_title', 'Orders')

@section('content')
    <div class="bg-white shadow rounded-lg p-6">
        <h2 class="text-2xl font-bold text-gray-800 mb-4">Order Management</h2>
        <div class="overflow-x-auto">
            <table class="min-w-full bg-white">
                <thead>
                    <tr>
                        <th class="py-2 px-4 border-b border-gray-200 bg-gray-100 text-left text-sm font-semibold text-gray-600">Order ID</th>
                        <th class="py-2 px-4 border-b border-gray-200 bg-gray-100 text-left text-sm font-semibold text-gray-600">Customer</th>
                        <th class="py-2 px-4 border-b border-gray-200 bg-gray-100 text-left text-sm font-semibold text-gray-600">Total</th>
                        <th class="py-2 px-4 border-b border-gray-200 bg-gray-100 text-left text-sm font-semibold text-gray-600">Status</th>
                        <th class="py-2 px-4 border-b border-gray-200 bg-gray-100"></th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($orders as $order)
                        <tr class="hover:bg-gray-50">
                            <td class="py-2 px-4 border-b border-gray-200 text-sm">#{{ $order->id }}</td>
                            <td class="py-2 px-4 border-b border-gray-200 text-sm">{{ $order->user->name ?? 'N/A' }}</td>
                            <td class="py-2 px-4 border-b border-gray-200 text-sm">${{ number_format($order->total_price, 2) }}</td>
                            <td class="py-2 px-4 border-b border-gray-200 text-sm">
                                @if ($order->status == 'pending')
                                    <span class="px-2 py-1 text-xs font-semibold rounded-full bg-yellow-200 text-yellow-800">{{ ucfirst($order->status) }}</span>
                                @elseif ($order->status == 'shipped')
                                    <span class="px-2 py-1 text-xs font-semibold rounded-full bg-blue-200 text-blue-800">{{ ucfirst($order->status) }}</span>
                                @elseif ($order->status == 'delivered')
                                    <span class="px-2 py-1 text-xs font-semibold rounded-full bg-green-200 text-green-800">{{ ucfirst($order->status) }}</span>
                                @else
                                    <span class="px-2 py-1 text-xs font-semibold rounded-full bg-gray-200 text-gray-800">{{ ucfirst($order->status) }}</span>
                                @endif
                            </td>
                            <td class="py-2 px-4 border-b border-gray-200 text-right text-sm">
                                {{-- UPDATED: Route name changed to 'admin.orders.index' to fix the error --}}
                                <a href="{{ route('admin.orders.show', $order) }}" class="text-blue-600 hover:underline">View</a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="py-4 text-center text-gray-500">No orders found.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection