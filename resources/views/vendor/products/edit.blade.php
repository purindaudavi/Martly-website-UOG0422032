@extends('vendor.layout')

@section('page_title', 'Edit Product')

@section('content')
    <div class="bg-white p-6 rounded-lg shadow-md">
        <h2 class="text-xl font-bold">Edit Product: {{ $product->name }}</h2>
        <p class="mt-2 text-gray-600">Update the details for this product below.</p>

        @if(session('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
                <span class="block sm:inline">{{ session('success') }}</span>
            </div>
        @endif

        <form action="{{ route('vendor.products.update', $product) }}" method="POST" enctype="multipart/form-data" class="mt-4">
            @csrf
            @method('PUT')
            
            {{-- Display Approval Status --}}
            <div class="mb-4">
                <h3 class="text-lg font-semibold">Approval Status:
                    @if($product->is_approved)
                        <span class="text-green-600">Approved</span>
                    @else
                        <span class="text-yellow-600">Pending</span>
                    @endif
                </h3>
                @if($product->is_approved)
                    <p class="mt-2 text-gray-600">
                        Your product has been approved. Public Price: <strong>${{ number_format($product->price, 2) }}</strong>
                    </p>
                @else
                    <p class="mt-2 text-gray-600">
                        This product is currently pending admin review. The final public price will be set upon approval.
                    </p>
                @endif
            </div>

            <div class="mb-4">
                <label for="name" class="block text-gray-700 text-sm font-bold mb-2">Product Name</label>
                <input type="text" name="name" id="name" value="{{ old('name', $product->name) }}" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                @error('name')
                    <p class="text-red-500 text-xs italic mt-2">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-4">
                <label for="description" class="block text-gray-700 text-sm font-bold mb-2">Description</label>
                <textarea name="description" id="description" rows="4" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">{{ old('description', $product->description) }}</textarea>
                @error('description')
                    <p class="text-red-500 text-xs italic mt-2">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-4">
                <label for="vendor_price" class="block text-gray-700 text-sm font-bold mb-2">Your Price (Vendor Price)</label>
                <input type="number" step="0.01" name="vendor_price" id="vendor_price" value="{{ old('vendor_price', $product->vendor_price) }}" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                @error('vendor_price')
                    <p class="text-red-500 text-xs italic mt-2">{{ $message }}</p>
                @enderror
            </div>

            {{-- NEW: Input for Product Quantity --}}
            <div class="mb-4">
                <label for="quantity" class="block text-gray-700 text-sm font-bold mb-2">Quantity</label>
                <input type="number" name="quantity" id="quantity" value="{{ old('quantity', $product->quantity) }}" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" min="0">
                @error('quantity')
                    <p class="text-red-500 text-xs italic mt-2">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-4">
                <label for="category" class="block text-gray-700 text-sm font-bold mb-2">Category</label>
                <input type="text" name="category" id="category" value="{{ old('category', $product->category) }}" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                @error('category')
                    <p class="text-red-500 text-xs italic mt-2">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-4">
                <label for="image" class="block text-gray-700 text-sm font-bold mb-2">Product Image</label>
                <input type="file" name="image" id="image" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                <p class="text-xs text-gray-500 mt-1">Leave blank to keep the current image.</p>
                @error('image')
                    <p class="text-red-500 text-xs italic mt-2">{{ $message }}</p>
                @enderror
                @if ($product->image)
                    <img src="{{ asset('storage/' . $product->image) }}" alt="Current Product Image" class="mt-4 w-32 h-32 object-cover rounded-md">
                @endif
            </div>

            <div class="flex items-center justify-between">
                <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                    Update Product
                </button>
            </div>
        </form>
    </div>
@endsection