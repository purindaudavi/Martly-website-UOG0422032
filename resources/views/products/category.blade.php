<x-app-layout>

    {{-- You can optionally add a header slot if you want a specific header for category pages --}}
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ $categoryName }}
        </h2>
    </x-slot>

    <section class="py-12 bg-[#faf3ef]">
        <div class="container mx-auto px-4">
            {{-- We moved the h1 into the header slot above, but you can keep it here if you prefer a double title --}}
            {{-- <h1 class="text-3xl font-extrabold text-center text-gray-800 mb-8">{{ $categoryName }} Products</h1> --}}
            <p class="text-center text-gray-600 mb-12">Explore our selection of {{ strtolower($categoryName) }}.</p>

            {{-- Product Grid --}}
            <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-5 gap-6">

                @forelse ($products as $product)
                    {{-- ADDED x-data="{}" HERE --}}
                    <div x-data="{}" class="bg-white rounded-lg shadow-md overflow-hidden flex flex-col items-center p-4">
                        <img src="{{ asset('images/products/' . $product['image']) }}" alt="{{ $product['name'] }}" class="w-36 h-36 object-cover rounded-md mb-3">
                        <h3 class="font-semibold text-gray-800 text-lg text-center mb-1">{{ $product['name'] }}</h3>
                        <p class="text-green-600 font-bold text-base mb-2">{{ $product['price'] }}</p>
                        <p class="text-gray-500 text-sm text-center line-clamp-2">{{ $product['description'] }}</p>

                        {{-- Corrected the @click attribute's content --}}
                        <button @click="
                            fetch('{{ route('cart.add') }}', {
                                method: 'POST',
                                headers: {
                                    'Content-Type': 'application/json',
                                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                                },
                                body: JSON.stringify({
                                    product_id: {{ Js::from($product['id']) }},
                                    name: {{ Js::from($product['name']) }},
                                    price: parseFloat({{ Js::from(str_replace('$', '', $product['price'])) }}), // Ensure price is a number
                                    image: {{ Js::from($product['image']) }},
                                    quantity: 1
                                })
                            })
                            .then(response => response.json())
                            .then(data => {
                                if (data.cartCount !== undefined) {
                                    window.dispatchEvent(new CustomEvent('cart-updated', { detail: { count: data.cartCount } }));

                                    // FIX: Removed the extra double quotes that caused the syntax error
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
                        " class="mt-auto bg-green-500 hover:bg-green-600 text-white font-bold py-2 px-4 rounded-full transition">
                            Add to Cart
                        </button>
                    </div>
                @empty
                    <div class="col-span-full text-center text-gray-600 text-xl py-10">
                        No products found in this category yet.
                    </div>
                @endforelse

            </div>
        </div>
    </section>

</x-app-layout>