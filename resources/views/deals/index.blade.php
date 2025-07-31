<x-app-layout>
    {{-- We are intentionally NOT using x-slot name="header" here for the Deals page.
         The header content is moved directly into the main section below
         so that the blur overlay can cover it for guests. --}}

    <section class="relative py-12 bg-[#faf3ef] min-h-screen flex flex-col items-center justify-center">
        {{-- Page Header - now placed directly inside this section to be covered by the blur --}}
        <h2 class="font-semibold text-xl text-gray-800 leading-tight mb-8"> {{-- Added mb-8 for spacing --}}
            Exclusive Deals Just For You!
        </h2>

        <div class="container mx-auto px-4 relative z-10"> {{-- Z-index to keep content above blur --}}

            {{-- "Hurry Up" Banner --}}
            <div class="bg-gradient-to-r from-green-400 to-green-600 text-white p-6 rounded-lg shadow-xl text-center mb-10 transform -rotate-1 skew-x-2">
                <h3 class="text-4xl font-extrabold mb-2 uppercase tracking-wide">⚡️ HURRY UP! LIMITED TIME DEALS! ⚡️</h3>
                <p class="text-xl">Incredible discounts waiting for you. Don't miss out!</p>
            </div>

            {{-- Deals Grid --}}
            <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-5 gap-6">
                @foreach ($deals as $deal)
                    {{-- ADDED x-data="{}" HERE --}}
                    <div x-data="{}" class="bg-white rounded-lg shadow-md overflow-hidden flex flex-col items-center p-4 relative">
                        {{-- Discount Tag --}}
                        <span class="absolute top-2 left-2 bg-red-500 text-white text-xs font-bold px-2 py-1 rounded-full z-20">
                            {{ $deal['discount_percentage'] }}% OFF
                        </span>
                        <img src="{{ asset('images/products/' . $deal['image']) }}" alt="{{ $deal['name'] }}" class="w-36 h-36 object-cover rounded-md mb-3">
                        <h3 class="font-semibold text-gray-800 text-lg text-center mb-1">{{ $deal['name'] }}</h3>
                        <p class="text-gray-500 text-sm line-clamp-2 mb-2">{{ $deal['description'] }}</p>
                        <div class="flex items-center justify-center mb-3">
                            <span class="text-gray-400 line-through mr-2">{{ $deal['formatted_original_price'] }}</span>
                            <span class="text-green-600 font-bold text-base">{{ $deal['formatted_discounted_price'] }}</span>
                        </div>
                        
                        {{-- FIX: Added the Tailwind CSS classes to the button --}}
                        <button @click="
                            fetch('http://127.0.0.1:8000/cart/add', {
                                method: 'POST',
                                headers: {
                                    'Content-Type': 'application/json',
                                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                                },
                                body: JSON.stringify({
                                    product_id: {{ Js::from($deal['id']) }},
                                    name: {{ Js::from($deal['name']) }},
                                    // Ensure price is a number
                                    price: parseFloat({{ Js::from(str_replace('$', '', $deal['formatted_discounted_price'])) }}),
                                    image: {{ Js::from($deal['image']) }},
                                    quantity: 1
                                })
                            })
                            .then(response => response.json())
                            .then(data => {
                                if (data.cartCount !== undefined) {
                                    window.dispatchEvent(new CustomEvent('cart-updated', { detail: { count: data.cartCount } }));
                                    
                                    alert(data.message + ' Current cart items: ' + data.cartCount);
                                } else {
                                    console.error('Failed to get cart count from response:', data);
                                    alert('Failed to add item to cart. Please try again.');
                                }
                            })
                            .catch(error => {
                                console.error('Error adding to cart:', error);
                                alert('Failed to add item to cart. Please try again.');
                            });
                        "
                        class="mt-auto bg-green-500 hover:bg-green-600 text-white font-bold py-2 px-4 rounded-full transition"> {{-- ADDED THESE CLASSES HERE --}}
                            Add to Cart
                        </button>
                        
                    </div>
                @endforeach
            </div>

        </div> {{-- End container --}}

        {{-- Authentication Overlay for Guests --}}
        @guest
            <div class="absolute inset-0 bg-white bg-opacity-5 backdrop-filter backdrop-blur-md flex items-center justify-center z-30 p-4">
                <div class="text-center bg-white p-8 rounded-lg shadow-xl max-w-sm w-full border border-gray-200">
                    <h3 class="text-2xl font-bold text-gray-800 mb-4">Unlock Exclusive Deals!</h3>
                    <p class="text-gray-600 mb-6">Login or register to view these amazing discounts.</p>
                    <div class="space-y-4">
                        <a href="{{ route('login') }}" class="block w-full bg-green-500 hover:bg-green-600 text-white font-bold py-3 px-4 rounded-full transition text-lg">
                            Login Now
                        </a>
                        <a href="{{ route('register') }}" class="block w-full bg-gray-200 hover:bg-gray-300 text-gray-800 font-bold py-3 px-4 rounded-full transition text-lg">
                            Register
                        </a>
                    </div>
                </div>
            </div>
        @endguest

    </section>

</x-app-layout>