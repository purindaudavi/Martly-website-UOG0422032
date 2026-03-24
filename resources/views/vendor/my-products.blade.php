@extends('vendor.layout')

@section('page_title', 'My Products')

@section('content')
    <div class="bg-white p-6 rounded-lg shadow-md mb-6">
        <h2 class="text-xl font-bold">Your Product Listings</h2>
        <p class="mt-2 text-gray-600">This is where you will manage and view all of your products.</p>
        <a href="{{ route('vendor.products.create') }}" class="mt-4 inline-block bg-green-500 hover:bg-green-600 text-white font-bold py-2 px-4 rounded-full transition duration-300">
            Add New Product
        </a>
    </div>

    <div class="bg-white p-6 rounded-lg shadow-md">
        {{-- Display success message --}}
        @if(session('status'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
                <span class="block sm:inline">{{ session('status') }}</span>
            </div>
        @endif
        
        @forelse ($products as $product)
            <div class="flex items-center space-x-4 py-4 border-b border-gray-200 last:border-b-0">
                <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}" class="w-16 h-16 object-cover rounded-md">
                <div class="flex-1">
                    <h3 class="text-lg font-semibold text-gray-800">{{ $product->name }}</h3>
                    <p class="text-gray-600 text-sm line-clamp-2">{{ $product->description }}</p>

                    {{-- NEW: Display the approval status --}}
                    @if($product->is_approved)
                        <span class="inline-block mt-2 bg-green-200 text-green-800 text-xs px-2 py-1 font-semibold rounded-full">Approved</span>
                    @else
                        <span class="inline-block mt-2 bg-yellow-200 text-yellow-800 text-xs px-2 py-1 font-semibold rounded-full">Pending</span>
                    @endif

                    {{-- NEW: Display the vendor price and stock quantity --}}
                    <p class="text-gray-600 font-bold mt-1">${{ number_format($product->vendor_price, 2) }}</p>
                    
                    {{-- THIS IS THE NEW LINE OF CODE --}}
                    <p class="text-gray-500 text-sm mt-1">Stock: {{ $product->quantity }}</p>
                </div>
                <div>
                    {{-- Action buttons --}}
                    <a href="{{ route('vendor.products.edit', $product) }}" class="text-indigo-600 hover:text-indigo-900 font-semibold text-sm">Edit</a>
                    
                    {{-- The delete button is now a form --}}
                    <form action="{{ route('vendor.products.destroy', $product->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this product?');" class="inline-block ml-2">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="text-red-600 hover:text-red-900 font-semibold text-sm">
                            Delete
                        </button>
                    </form>
                </div>
            </div>
        @empty
            <div class="text-center py-10">
                <p class="text-gray-600 text-lg">You have not added any products yet.</p>
                <a href="{{ route('vendor.products.create') }}" class="mt-4 inline-block text-blue-500 hover:underline">Add your first product now!</a>
            </div>
        @endforelse
    </div>
@endsection