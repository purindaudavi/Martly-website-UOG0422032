<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('My Orders') }}
        </h2>
    </x-slot>

    <div class="py-12 bg-gray-100">
        <div class="container mx-auto px-4">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h3 class="text-2xl font-bold mb-6">Your Order History</h3>
                    
                    @if (session('success'))
                        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
                            <span class="block sm:inline">{{ session('success') }}</span>
                        </div>
                    @endif

                    @if (session('error'))
                        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4" role="alert">
                            <span class="block sm:inline">{{ session('error') }}</span>
                        </div>
                    @endif
                    
                    @if($orders->isEmpty())
                        <p class="text-gray-600">You haven't placed any orders yet. Time to start shopping!</p>
                    @else
                        <div class="overflow-x-auto">
                            <table class="min-w-full divide-y divide-gray-200">
                                <thead class="bg-gray-50">
                                    <tr>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Order ID
                                        </th>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Total Price
                                        </th>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Status
                                        </th>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Date
                                        </th>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Actions
                                        </th>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Print
                                        </th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white divide-y divide-gray-200">
                                    @foreach($orders as $order)
                                        <tr class="hover:bg-gray-50">
                                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                                {{ $order->id }}
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                                ${{ number_format($order->total_price, 2) }}
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full 
                                                    @if($order->status === 'delivered') bg-green-100 text-green-800
                                                    @elseif($order->status === 'shipped') bg-blue-100 text-blue-800
                                                    @elseif($order->status === 'cancelled') bg-red-100 text-red-800
                                                    @else bg-yellow-100 text-yellow-800
                                                    @endif">
                                                    {{ ucfirst($order->status) }}
                                                </span>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                                {{ $order->created_at->format('M d, Y') }}
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                                @if($order->status === 'pending')
                                                    <form action="{{ route('customer.orders.cancel', $order->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to cancel this order?');">
                                                        @csrf
                                                        @method('PUT')
                                                        <button type="submit" class="text-red-600 hover:text-red-900">
                                                            Cancel Order
                                                        </button>
                                                    </form>
                                                @else
                                                    <span class="text-gray-400">Not Cancellable</span>
                                                @endif
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                                <button onclick="printOrderDetails({{ json_encode(['id' => $order->id, 'total_price' => number_format($order->total_price, 2), 'status' => ucfirst($order->status), 'date' => $order->created_at->format('M d, Y')]) }})" class="bg-indigo-500 text-white px-4 py-2 rounded-lg text-sm hover:bg-indigo-600 transition">
                                                    Print
                                                </button>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

<script>
    function printOrderDetails(order) {
        // Create a new window for printing
        const printWindow = window.open('', '', 'height=600,width=800');
        
        // Build the HTML content for printing
        let printContent = `
            <!DOCTYPE html>
            <html lang="en">
            <head>
                <meta charset="UTF-8">
                <title>Print Order Details</title>
                <style>
                    body { font-family: sans-serif; padding: 20px; color: #333; }
                    h1 { color: #4a5568; }
                    .details-box { border: 1px solid #e2e8f0; padding: 20px; border-radius: 8px; margin-top: 20px; }
                    .detail-row { display: flex; margin-bottom: 10px; }
                    .label { font-weight: bold; width: 120px; }
                    .value { flex-grow: 1; }
                </style>
            </head>
            <body>
                <h1>Order Details</h1>
                <div class="details-box">
                    <div class="detail-row">
                        <span class="label">Order ID:</span>
                        <span class="value">${order.id}</span>
                    </div>
                    <div class="detail-row">
                        <span class="label">Total Price:</span>
                        <span class="value">$${order.total_price}</span>
                    </div>
                    <div class="detail-row">
                        <span class="label">Status:</span>
                        <span class="value">${order.status}</span>
                    </div>
                    <div class="detail-row">
                        <span class="label">Date:</span>
                        <span class="value">${order.date}</span>
                    </div>
                </div>
                <script>
                    window.onload = function() {
                        window.print();
                        window.onafterprint = function() {
                            window.close();
                        };
                    };
                <\/script>
            </body>
            </html>
        `;

        // Write the content to the new window
        printWindow.document.open();
        printWindow.document.write(printContent);
        printWindow.document.close();
    }
</script>