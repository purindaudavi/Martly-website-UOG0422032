@extends('admin.layout')

@section('page_title', 'Edit Product')

@section('content')
    <div class="flex justify-between items-center mb-6">
        <h2 class="text-xl font-semibold">Edit Product: {{ $product->name }}</h2>
    </div>

    <div class="bg-white p-8 rounded-lg shadow">
        <form action="{{ route('admin.products.update', $product) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="mb-4">
                <label for="name" class="block text-gray-700 font-bold mb-2">Product Name:</label>
                <input type="text" id="name" name="name" value="{{ old('name', $product->name) }}" required
                    class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                @error('name') <p class="text-red-500 text-xs italic mt-2">{{ $message }}</p> @enderror
            </div>

            <div class="mb-4">
                <label for="description" class="block text-gray-700 font-bold mb-2">Description:</label>
                <textarea id="description" name="description" rows="4" required
                    class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">{{ old('description', $product->description) }}</textarea>
                @error('description') <p class="text-red-500 text-xs italic mt-2">{{ $message }}</p> @enderror
            </div>

            <div class="mb-4">
                <label for="price" class="block text-gray-700 font-bold mb-2">Price ($):</label>
                <input type="number" id="price" name="price" value="{{ old('price', $product->price) }}" step="0.01" required
                    class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                @error('price') <p class="text-red-500 text-xs italic mt-2">{{ $message }}</p> @enderror
            </div>

            <div class="mb-4">
                <label for="category" class="block text-gray-700 font-bold mb-2">Category:</label>
                <input type="text" id="category" name="category" value="{{ old('category', $product->category) }}" required
                    class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                @error('category') <p class="text-red-500 text-xs italic mt-2">{{ $message }}</p> @enderror
            </div>

            <div class="mb-6">
                <label for="image" class="block text-gray-700 font-bold mb-2">Product Image:</label>
                <input type="file" id="image" name="image"
                    class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-violet-50 file:text-violet-700 hover:file:bg-violet-100">
                @error('image') <p class="text-red-500 text-xs italic mt-2">{{ $message }}</p> @enderror
                @if ($product->image)
                    <p class="mt-2 text-sm text-gray-600">Current image:</p>
                    <img src="{{ asset('storage/' . $product->image) }}" alt="Current Product Image" class="w-32 h-32 object-cover rounded mt-2">
                @endif
            </div>

            <div class="mb-4">
                <label class="block text-gray-700 font-bold mb-2">
                    <input type="checkbox" id="is_deal" name="is_deal" value="1" {{ old('is_deal', $product->is_deal) ? 'checked' : '' }}>
                    Mark as a Deal
                </label>
            </div>

            <div class="mb-4" id="discount_percentage_field" style="{{ old('is_deal', $product->is_deal) ? '' : 'display:none;' }}">
                <label for="discount_percentage" class="block text-gray-700 font-bold mb-2">Discount Percentage (%):</label>
                <input type="number" id="discount_percentage" name="discount_percentage" value="{{ old('discount_percentage', $product->discount_percentage) }}" step="0.01" min="0" max="100"
                    class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                @error('discount_percentage') <p class="text-red-500 text-xs italic mt-2">{{ $message }}</p> @enderror
            </div>


            <div class="flex items-center justify-between">
                <button type="submit"
                    class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                    Update Product
                </button>
                <a href="{{ route('admin.products') }}" class="inline-block align-baseline font-bold text-sm text-blue-500 hover:text-blue-800">
                    Cancel
                </a>
            </div>
        </form>
    </div>

    <script>
        // NEW: JavaScript to toggle the discount percentage field
        const isDealCheckbox = document.getElementById('is_deal');
        const discountField = document.getElementById('discount_percentage_field');

        isDealCheckbox.addEventListener('change', () => {
            if (isDealCheckbox.checked) {
                discountField.style.display = 'block';
            } else {
                discountField.style.display = 'none';
            }
        });
    </script>
@endsection