@extends('vendor.layout')

@section('page_title', 'My Sales')

@section('content')
    <div class="bg-white p-6 rounded-lg shadow">
        <h2 class="text-xl font-bold mb-4 text-gray-800">My Sales History</h2>
        
        @if ($orders->isEmpty())
            <p class="text-gray-600">You have not sold any products yet.</p>
        @else
            <div class="overflow-x-auto">
                <table class="min-w-full bg-white">
                    <thead>
                        <tr class="bg-gray-100 text-gray-600 uppercase text-sm leading-normal">
                            <th class="py-3 px-6 text-left">Order #</th>
                            <th class="py-3 px-6 text-left">Customer Name</th>
                            <th class="py-3 px-6 text-left">Items Sold</th>
                            <th class="py-3 px-6 text-left">Vendor Sales Total</th>
                            <th class="py-3 px-6 text-left">Status</th>
                        </tr>
                    </thead>
                    <tbody class="text-gray-600 text-sm font-light">
                        @foreach ($orders as $order)
                            <tr class="border-b border-gray-200 hover:bg-gray-100">
                                <td class="py-3 px-6 text-left whitespace-nowrap">{{ $order->id }}</td>
                                <td class="py-3 px-6 text-left">{{ $order->user->name ?? 'Guest' }}</td>
                                <td class="py-3 px-6 text-left">
                                    @foreach ($order->orderItems as $item)
                                        <p>{{ $item->product->name }} (x{{ $item->quantity }}) - ${{ number_format($item->product->vendor_price * $item->quantity, 2) }}</p>
                                    @endforeach
                                </td>
                                <td class="py-3 px-6 text-left">${{ number_format($order->vendor_total, 2) }}</td>
                                <td class="py-3 px-6 text-left">
                                    <span class="py-1 px-3 rounded-full text-xs font-semibold
                                        @if ($order->status === 'pending') bg-yellow-200 text-yellow-800
                                        @elseif ($order->status === 'shipped') bg-blue-200 text-blue-800
                                        @elseif ($order->status === 'delivered') bg-green-200 text-green-800
                                        @else bg-gray-200 text-gray-800 @endif">
                                        {{ ucfirst($order->status) }}
                                    </span>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @endif
    </div>
@endsection