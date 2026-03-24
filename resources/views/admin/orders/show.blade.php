@extends('admin.layout')

@section('page_title', 'Order Details')

@section('content')
    <div class="bg-white shadow rounded-lg p-6">
        <div class="flex justify-between items-center mb-6">
            <h2 class="text-2xl font-bold text-gray-800">Order #{{ $order->id }}</h2>
            <span class="px-3 py-1 text-sm font-semibold rounded-full 
                @if ($order->status === 'pending') bg-yellow-200 text-yellow-800
                @elseif ($order->status === 'shipped') bg-blue-200 text-blue-800
                @elseif ($order->status === 'delivered') bg-green-200 text-green-800
                @else bg-gray-200 text-gray-800 @endif">
                {{ ucfirst($order->status) }}
            </span>
        </div>

        {{-- NEW: Order Status Update Form --}}
        <div class="mb-6">
            <h3 class="text-lg font-semibold text-gray-700 mb-2">Update Order Status</h3>
            <form action="{{ route('admin.orders.update_status', $order) }}" method="POST" class="flex space-x-2 items-center">
                @csrf
                @method('PUT')
                <select name="status" id="status" class="form-select mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                    <option value="pending" {{ $order->status === 'pending' ? 'selected' : '' }}>Pending</option>
                    <option value="shipped" {{ $order->status === 'shipped' ? 'selected' : '' }}>Shipped</option>
                    <option value="delivered" {{ $order->status === 'delivered' ? 'selected' : '' }}>Delivered</option>
                    <option value="cancelled" {{ $order->status === 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                </select>
                <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700 transition-colors duration-200">Update</button>
            </form>
            @error('status')
                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
            @enderror
        </div>
        
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
            <div>
                <h3 class="text-lg font-semibold text-gray-700 mb-2">Customer Details</h3>
                <p class="text-gray-600"><strong>Name:</strong> {{ $order->user->name ?? 'Guest' }}</p>
                <p class="text-gray-600"><strong>Email:</strong> {{ $order->user->email ?? 'N/A' }}</p>
            </div>
            <div>
                <h3 class="text-lg font-semibold text-gray-700 mb-2">Order Summary</h3>
                <p class="text-gray-600"><strong>Order Date:</strong> {{ $order->created_at->format('M d, Y') }}</p>
                <p class="text-gray-600"><strong>Total Price:</strong> ${{ number_format($order->total_price, 2) }}</p>
            </div>
        </div>

        <h3 class="text-lg font-semibold text-gray-700 mb-4">Ordered Items</h3>
        <div class="overflow-x-auto">
            <table class="min-w-full bg-white">
                <thead>
                    <tr>
                        <th class="py-2 px-4 border-b border-gray-200 bg-gray-100 text-left text-sm font-semibold text-gray-600">Product</th>
                        <th class="py-2 px-4 border-b border-gray-200 bg-gray-100 text-left text-sm font-semibold text-gray-600">Price</th>
                        <th class="py-2 px-4 border-b border-gray-200 bg-gray-100 text-left text-sm font-semibold text-gray-600">Quantity</th>
                        <th class="py-2 px-4 border-b border-gray-200 bg-gray-100 text-left text-sm font-semibold text-gray-600">Subtotal</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($order->orderItems as $item)
                        <tr class="hover:bg-gray-50">
                            <td class="py-2 px-4 border-b border-gray-200 text-sm flex items-center">
                                <img src="{{ asset('storage/' . $item->product->image) }}" alt="{{ $item->product->name }}" class="w-12 h-12 object-cover rounded-lg mr-4">
                                <span>{{ $item->product->name }}</span>
                            </td>
                            <td class="py-2 px-4 border-b border-gray-200 text-sm">${{ number_format($item->price, 2) }}</td>
                            <td class="py-2 px-4 border-b border-gray-200 text-sm">{{ $item->quantity }}</td>
                            <td class="py-2 px-4 border-b border-gray-200 text-sm">${{ number_format($item->price * $item->quantity, 2) }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection