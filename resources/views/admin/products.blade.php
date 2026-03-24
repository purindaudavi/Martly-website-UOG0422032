@extends('admin.layout')

@section('page_title', 'Manage Products')

@section('content')
    <div class="flex justify-between items-center mb-6">
        <h2 class="text-xl font-semibold">Product List</h2>
        <a href="{{ route('admin.products.create') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
            + Add New Product
        </a>
    </div>

    @if(session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
            <span class="block sm:inline">{{ session('success') }}</span>
        </div>
    @endif
    
    <div class="bg-white p-8 rounded-lg shadow overflow-x-auto">
        <table class="min-w-full divide-y divide-gray-200">
            <thead>
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Product Name</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Vendor</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Category</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Vendor Price</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Public Price</th>
                    {{-- NEW: Added Quantity Header --}}
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Quantity</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Deal Status</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @foreach($products as $product)
                    <tr>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="flex items-center">
                                <img class="h-10 w-10 rounded-full" src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}">
                                <div class="ml-4">
                                    <div class="text-sm font-medium text-gray-900">{{ $product->name }}</div>
                                </div>
                            </div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="text-sm text-gray-900">{{ $product->vendor->name ?? 'N/A' }}</div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="text-sm text-gray-900">{{ $product->category }}</div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="text-sm text-gray-900">${{ number_format($product->vendor_price, 2) }}</div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="text-sm text-gray-900">
                                @if($product->price)
                                    ${{ number_format($product->price, 2) }}
                                @else
                                    <span class="text-gray-500">Pending</span>
                                @endif
                            </div>
                        </td>
                        {{-- NEW: Added Quantity Column --}}
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="text-sm text-gray-900">{{ $product->quantity }}</div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            @if ($product->is_approved)
                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">Approved</span>
                            @else
                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-yellow-100 text-yellow-800">Pending</span>
                            @endif
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            @if ($product->is_approved)
                                @if ($product->is_deal)
                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-100 text-red-800">
                                        On Deal
                                    </span>
                                @else
                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                                        Not a Deal
                                    </span>
                                @endif
                            @else
                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-gray-100 text-gray-800">
                                    N/A
                                </span>
                            @endif
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                            @if (!$product->is_approved)
                                <form action="{{ route('admin.products.approve', $product) }}" method="POST" class="inline-block">
                                    @csrf
                                    <button type="submit" class="text-blue-600 hover:text-blue-900 mx-2">Approve</button>
                                </form>
                                <a href="{{ route('admin.products.edit', $product) }}" class="text-indigo-600 hover:text-indigo-900 mx-2">Edit</a>
                                <form action="{{ route('admin.products.destroy', $product) }}" method="POST" class="inline-block" onsubmit="return confirm('Are you sure you want to delete this product?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-600 hover:text-red-900 mx-2">Delete</button>
                                </form>
                            @else
                                @if ($product->is_deal)
                                    <form action="{{ route('admin.deals.toggle', $product) }}" method="POST" class="inline-block">
                                        @csrf
                                        <button type="submit" class="text-red-600 hover:text-red-900 mx-2">Remove Deal</button>
                                    </form>
                                @else
                                    <button type="button" class="open-deal-modal text-green-600 hover:text-green-900 mx-2" data-product-id="{{ $product->id }}">Mark as Deal</button>
                                @endif
                                <a href="{{ route('admin.products.edit', $product) }}" class="text-indigo-600 hover:text-indigo-900 mx-2">Edit</a>
                                <form action="{{ route('admin.products.destroy', $product) }}" method="POST" class="inline-block" onsubmit="return confirm('Are you sure you want to delete this product?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-600 hover:text-red-900 mx-2">Delete</button>
                                </form>
                            @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    {{-- The deal modal remains the same --}}
    <div id="dealModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full hidden">
        <div class="relative top-20 mx-auto p-5 border w-96 shadow-lg rounded-md bg-white">
            <div class="mt-3 text-center">
                <h3 class="text-lg leading-6 font-medium text-gray-900">Set Discount Percentage</h3>
                <div class="mt-2 px-7 py-3">
                    <p class="text-sm text-gray-500">Enter the discount percentage for this product.</p>
                    <form id="dealForm" class="mt-4">
                        @csrf
                        <input type="hidden" id="modalProductId" name="product_id">
                        <div class="mb-4">
                            <label for="discount_percentage" class="sr-only">Discount Percentage</label>
                            <input type="number" id="discount_percentage" name="discount_percentage" placeholder="e.g., 20" min="1" max="100" required
                                class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                        </div>
                    </form>
                </div>
                <div class="items-center px-4 py-3">
                    <button id="submitDealBtn" class="px-4 py-2 bg-green-500 text-white text-base font-medium rounded-md w-full shadow-sm hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-green-300">
                        Confirm Deal
                    </button>
                    <button id="closeModalBtn" class="mt-2 px-4 py-2 bg-gray-200 text-gray-700 text-base font-medium rounded-md w-full shadow-sm hover:bg-gray-400 focus:outline-none focus:ring-2 focus:ring-gray-300">
                        Cancel
                    </button>
                </div>
            </div>
        </div>
    </div>
    
    <script>
        const dealModal = document.getElementById('dealModal');
        const openDealButtons = document.querySelectorAll('.open-deal-modal');
        const closeModalBtn = document.getElementById('closeModalBtn');
        const modalProductIdInput = document.getElementById('modalProductId');
        const dealForm = document.getElementById('dealForm');
        const submitDealBtn = document.getElementById('submitDealBtn');

        openDealButtons.forEach(button => {
            button.addEventListener('click', () => {
                const productId = button.getAttribute('data-product-id');
                modalProductIdInput.value = productId;
                dealModal.classList.remove('hidden');
            });
        });

        closeModalBtn.addEventListener('click', () => {
            dealModal.classList.add('hidden');
        });

        window.onclick = function(event) {
            if (event.target == dealModal) {
                dealModal.classList.add('hidden');
            }
        }

        submitDealBtn.addEventListener('click', (e) => {
            e.preventDefault();
            
            const formData = new FormData(dealForm);
            
            fetch("{{ route('admin.products.updateDealPercentage') }}", {
                method: 'POST',
                body: formData,
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                }
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    alert('Deal status and percentage updated successfully!');
                    window.location.reload();
                } else {
                    alert('Failed to update deal: ' + data.message);
                }
            })
            .catch(error => {
                console.error('Error:', error);
                alert('An error occurred. Please try again.');
            });
            
            dealModal.classList.add('hidden');
        });
    </script>
@endsection