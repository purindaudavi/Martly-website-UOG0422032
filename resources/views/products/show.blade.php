<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ $product->name }}
        </h2>
    </x-slot>

    <div class="py-12 bg-[#faf3ef]">
        <div class="container mx-auto px-4">
            <div class="bg-white rounded-lg shadow-lg overflow-hidden md:flex">
                {{-- Product Image Section --}}
                <div class="md:flex-shrink-0 md:w-1/2 p-6 flex justify-center items-center">
                    <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}" class="w-full max-w-lg h-auto object-contain rounded-md shadow-md">
                </div>
                
                {{-- Product Details Section --}}
                <div class="md:w-1/2 p-6 flex flex-col justify-between">
                    <div>
                        <h1 class="text-4xl font-extrabold text-gray-800 mb-2">{{ $product->name }}</h1>
                        
                        {{-- Price Display --}}
                        <div class="flex items-baseline mb-4">
                            @if ($product->is_deal)
                                @php
                                    $discountedPrice = $product->price - ($product->price * $product->discount_percentage / 100);
                                @endphp
                                <span class="text-gray-400 text-xl font-bold line-through mr-4">${{ number_format($product->price, 2) }}</span>
                                <span class="text-3xl font-extrabold text-red-600">${{ number_format($discountedPrice, 2) }}</span>
                                <span class="ml-2 text-sm text-red-500 font-semibold">({{ number_format($product->discount_percentage, 0) }}% OFF)</span>
                            @else
                                <p class="text-2xl font-bold text-green-600">${{ number_format($product->price, 2) }}</p>
                            @endif
                        </div>

                        <p class="text-gray-700 text-lg mb-6">{{ $product->description }}</p>

                        {{-- Rating System --}}
                        @php
                            $averageRating = $reviews->avg('rating');
                            $reviewCount = $reviews->count();
                        @endphp
                        <div class="flex items-center text-yellow-400 mb-6">
                            @for ($i = 0; $i < 5; $i++)
                                <svg class="h-5 w-5" fill="currentColor" viewBox="0 0 20 20">
                                    <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.286 3.96a1 1 0 00.95.69h4.161c.969 0 1.371 1.24.588 1.81l-3.37 2.45a1 1 0 00-.364 1.118l1.287 3.96c.3.921-.755 1.68-1.538 1.118l-3.37-2.45a1 1 0 00-1.176 0l-3.37 2.45c-.783.562-1.838-.197-1.538-1.118l1.287-3.96a1 1 0 00-.364-1.118L2.516 9.387c-.783-.57-.38-1.81.588-1.81h4.161a1 1 0 00.95-.69l1.286-3.96z" />
                                </svg>
                            @endfor
                            <span class="text-gray-600 ml-2 text-sm">({{ number_format($averageRating, 1) }} out of 5) - {{ $reviewCount }} reviews</span>
                        </div>

                        {{-- Conditional display for quantity selector and "Sold Out" status --}}
                        @if ($product->quantity > 0)
                            <div x-data="{ quantity: 1 }" class="flex items-center space-x-4">
                                <label for="quantity" class="font-semibold text-gray-700">Quantity:</label>
                                <div class="flex items-center border border-gray-300 rounded-md">
                                    <button type="button" @click="quantity = quantity > 1 ? quantity - 1 : 1" class="px-3 py-1 text-gray-600 hover:bg-gray-200">-</button>
                                    <input type="number" id="quantity" x-model="quantity" min="1" class="w-16 text-center border-0 focus:ring-0">
                                    <button type="button" @click="quantity++" class="px-3 py-1 text-gray-600 hover:bg-gray-200">+</button>
                                </div>
                                <button 
                                    @click="
                                        fetch('{{ route('cart.add') }}', {
                                            method: 'POST',
                                            headers: {
                                                'Content-Type': 'application/json',
                                                'X-CSRF-TOKEN': '{{ csrf_token() }}'
                                            },
                                            body: JSON.stringify({
                                                product_id: {{ Js::from($product->id) }},
                                                name: {{ Js::from($product->name) }},
                                                price: parseFloat({{ Js::from($product->is_deal ? $discountedPrice : $product->price) }}),
                                                image: {{ Js::from($product->image) }},
                                                quantity: quantity
                                            })
                                        })
                                        .then(response => {
                                            if (!response.ok) {
                                                return response.json().then(errorData => {
                                                    throw new Error(errorData.message);
                                                });
                                            }
                                            return response.json();
                                        })
                                        .then(data => {
                                            window.dispatchEvent(new CustomEvent('cart-updated', { detail: { count: data.cartCount } }));
                                            alert(data.message);
                                        })
                                        .catch(error => {
                                            alert(error.message);
                                        });
                                    "
                                    class="flex-1 bg-green-500 hover:bg-green-600 text-white font-bold py-3 px-6 rounded-full transition duration-300">
                                    <i class="fa-solid fa-cart-shopping mr-2"></i> Add to Cart
                                </button>
                            </div>
                            <div class="mt-4 text-sm text-gray-500">
                                <p>Only {{ $product->quantity }} remaining!</p>
                            </div>
                        @else
                            <div class="mt-4 text-center">
                                <span class="inline-block bg-red-500 text-white font-bold py-3 px-6 rounded-full text-lg">Sold Out</span>
                            </div>
                        @endif
                    </div>
                </div>
            </div>

            {{-- Reviews Section --}}
            <div class="mt-12">
                <h3 class="text-2xl font-bold text-gray-800 border-b-2 border-green-500 pb-2 mb-6">Customer Reviews</h3>
                
                {{-- Display success or error messages --}}
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

                {{-- Display existing reviews --}}
                @if ($reviews->isEmpty())
                    <p class="text-gray-600">No reviews yet. Be the first to review this product!</p>
                @else
                    <div class="space-y-6">
                        @foreach ($reviews as $review)
                            <div class="bg-white p-6 rounded-lg shadow-md" x-data="{ openEdit: false }">
                                <div class="flex justify-between items-center mb-2">
                                    <div class="flex items-center">
                                        <span class="font-semibold text-gray-800">{{ $review->user->name }}</span>
                                        <div class="flex text-yellow-400 ml-4">
                                            @for ($i = 0; $i < 5; $i++)
                                                @if ($review->rating > $i)
                                                    <i class="fa-solid fa-star"></i>
                                                @else
                                                    <i class="fa-regular fa-star"></i>
                                                @endif
                                            @endfor
                                        </div>
                                    </div>

                                    {{-- NEW: Edit and Delete buttons, only for the review's owner --}}
                                    @auth
                                        @if ($review->user_id === Auth::id())
                                            <div class="flex space-x-2">
                                                <button @click="openEdit = !openEdit" class="text-blue-500 hover:text-blue-700 text-sm">
                                                    Edit
                                                </button>
                                                <form action="{{ route('reviews.delete', $review->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this review?');">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="text-red-500 hover:text-red-700 text-sm">
                                                        Delete
                                                    </button>
                                                </form>
                                            </div>
                                        @endif
                                    @endauth
                                </div>
                                <p class="text-gray-600" x-show="!openEdit">{{ $review->comment }}</p>

                                {{-- NEW: Edit Review Form (Hidden by default) --}}
                                <div x-show="openEdit" x-transition>
                                    <form action="{{ route('reviews.update', $review->id) }}" method="POST" class="mt-4">
                                        @csrf
                                        @method('PATCH')
                                        <div class="mb-4">
                                            <label for="rating-{{ $review->id }}" class="block text-gray-700 font-bold mb-2">Rating</label>
                                            <select name="rating" id="rating-{{ $review->id }}" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                                                @for ($i = 5; $i >= 1; $i--)
                                                    <option value="{{ $i }}" {{ $review->rating == $i ? 'selected' : '' }}>{{ $i }} Stars</option>
                                                @endfor
                                            </select>
                                        </div>
                                        <div class="mb-4">
                                            <label for="comment-{{ $review->id }}" class="block text-gray-700 font-bold mb-2">Your Review</label>
                                            <textarea name="comment" id="comment-{{ $review->id }}" rows="4" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">{{ $review->comment }}</textarea>
                                        </div>
                                        <div class="flex space-x-2">
                                            <button type="submit" class="bg-blue-500 hover:bg-blue-600 text-white font-bold py-2 px-4 rounded">Update Review</button>
                                            <button type="button" @click="openEdit = false" class="bg-gray-500 hover:bg-gray-600 text-white font-bold py-2 px-4 rounded">Cancel</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @endif

                {{-- Review form --}}
                @if ($canReview)
                    <div class="mt-8 bg-white p-6 rounded-lg shadow-md">
                        <h4 class="text-xl font-bold text-gray-800 mb-4">Write a Review</h4>
                        <form action="{{ route('products.review.store', $product->id) }}" method="POST">
                            @csrf
                            <div class="mb-4">
                                <label for="rating" class="block text-gray-700 font-bold mb-2">Rating</label>
                                <select name="rating" id="rating" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                                    <option value="5">5 Stars</option>
                                    <option value="4">4 Stars</option>
                                    <option value="3">3 Stars</option>
                                    <option value="2">2 Stars</option>
                                    <option value="1">1 Star</option>
                                </select>
                                @error('rating')
                                    <p class="text-red-500 text-xs italic mt-2">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="mb-4">
                                <label for="comment" class="block text-gray-700 font-bold mb-2">Your Review</label>
                                <textarea name="comment" id="comment" rows="4" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" placeholder="Tell us what you think..."></textarea>
                                @error('comment')
                                    <p class="text-red-500 text-xs italic mt-2">{{ $message }}</p>
                                @enderror
                            </div>
                            <button type="submit" class="bg-green-500 hover:bg-green-600 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">Submit Review</button>
                        </form>
                    </div>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>