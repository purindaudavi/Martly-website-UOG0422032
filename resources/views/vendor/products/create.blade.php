@extends('vendor.layout')

@section('page_title', 'Add New Product')

@section('content')
    <div class="bg-white p-6 rounded-lg shadow-md">
        <h2 class="text-2xl font-bold mb-4">Add a New Product</h2>

        {{-- Success Message --}}
        @if (session('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
                <span class="block sm:inline">{{ session('success') }}</span>
            </div>
        @endif

        {{-- Validation Errors --}}
        @if ($errors->any())
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4" role="alert">
                <strong class="font-bold">Oops!</strong>
                <span class="block sm:inline">There were some problems with your input.</span>
                <ul class="mt-2 list-disc list-inside">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('vendor.products.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            
            <div class="mb-4">
                <label for="name" class="block text-gray-700 text-sm font-bold mb-2">Product Name</label>
                <input type="text" name="name" id="name" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" value="{{ old('name') }}">
            </div>

            <div class="mb-4">
                <label for="description" class="block text-gray-700 text-sm font-bold mb-2">Description</label>
                <textarea name="description" id="description" rows="4" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">{{ old('description') }}</textarea>
            </div>

            <div class="mb-4">
                <label for="vendor_price" class="block text-gray-700 text-sm font-bold mb-2">Your Price (per unit)</label>
                <input type="number" name="vendor_price" id="vendor_price" step="0.01" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" value="{{ old('vendor_price') }}">
            </div>

            {{-- NEW: Input for Product Quantity --}}
            <div class="mb-4">
                <label for="quantity" class="block text-gray-700 text-sm font-bold mb-2">Quantity</label>
                <input type="number" name="quantity" id="quantity" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" value="{{ old('quantity') }}" min="0">
                @error('quantity')
                    <p class="text-red-500 text-xs italic mt-2">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-4">
                <label for="category" class="block text-gray-700 text-sm font-bold mb-2">Category</label>
                <select name="category" id="category" class="shadow border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                    <option value="">Select a Category</option>
                    <option value="meat-seafood" {{ old('category') == 'meat-seafood' ? 'selected' : '' }}>Meat & Seafood</option>
                    <option value="snacks-bars-treats" {{ old('category') == 'snacks-bars-treats' ? 'selected' : '' }}>Snacks, Bars & Treats</option>
                    <option value="beverages" {{ old('category') == 'beverages' ? 'selected' : '' }}>Beverages</option>
                    <option value="frozen" {{ old('category') == 'frozen' ? 'selected' : '' }}>Frozen</option>
                    <option value="wine" {{ old('category') == 'wine' ? 'selected' : '' }}>Wine</option>
                    <option value="household-cleaning" {{ old('category') == 'household-cleaning' ? 'selected' : '' }}>Household & Cleaning</option>
                    <option value="trending-now" {{ old('category') == 'trending-now' ? 'selected' : '' }}>Trending Now</option>
                    <option value="vitamins-supplements" {{ old('category') == 'vitamins-supplements' ? 'selected' : '' }}>Vitamins & Supplements</option>
                </select>
            </div>

            <div class="mb-4">
                <label for="image" class="block text-gray-700 text-sm font-bold mb-2">Product Image</label>
                <input type="file" name="image" id="image" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
            </div>

            <div class="flex items-center justify-between">
                <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                    Add Product
                </button>
            </div>
        </form>
    </div>
@endsection