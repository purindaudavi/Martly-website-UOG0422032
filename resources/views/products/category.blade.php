<x-app-layout>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ $categoryName }}
        </h2>
    </x-slot>

    <section class="py-12 bg-[#faf3ef]">
        <div class="container mx-auto px-4">
            <p class="text-center text-gray-600 mb-12">Explore our selection of {{ strtolower($categoryName) }}.</p>

            <div class="flex flex-col sm:flex-row justify-between items-center mb-6 p-4 bg-white rounded-lg shadow-md">
                <h3 class="text-lg font-semibold text-gray-800 mb-4 sm:mb-0">Filter & Sort</h3>

                {{-- POW! This form's action now uses the correct hyphenated $category variable --}}
                <form id="filter-sort-form" method="GET" action="{{ route('products.category', ['category' => $category]) }}" class="flex flex-col sm:flex-row items-center gap-4 w-full sm:w-auto">

                    <div class="flex items-center gap-2">
                        <label for="sort_by" class="text-sm font-medium text-gray-700">Sort by:</label>
                        <select name="sort_by" id="sort_by" onchange="this.form.submit()"
                                class="mt-1 block w-full pl-3 pr-10 py-2 text-base border-gray-300 focus:outline-none focus:ring-green-500 focus:border-green-500 sm:text-sm rounded-md shadow-sm">
                            <option value="">Default</option>
                            <option value="newest" @if(request('sort_by') == 'newest') selected @endif>Newest</option>
                            <option value="price_asc" @if(request('sort_by') == 'price_asc') selected @endif>Lowest Price</option>
                            <option value="price_desc" @if(request('sort_by') == 'price_desc') selected @endif>Highest Price</option>
                            <option value="best_rated" @if(request('sort_by') == 'best_rated') selected @endif>Best Rated</option>
                            <option value="most_reviewed" @if(request('sort_by') == 'most_reviewed') selected @endif>Most Reviewed</option>
                        </select>
                    </div>

                    <div class="flex items-center gap-2">
                        <label for="price_min" class="text-sm font-medium text-gray-700">Price:</label>
                        <input type="number" name="price_min" id="price_min" placeholder="Min"
                               value="{{ request('price_min') }}"
                               class="w-24 mt-1 block pl-3 pr-2 py-2 text-base border-gray-300 focus:outline-none focus:ring-green-500 focus:border-green-500 sm:text-sm rounded-md shadow-sm">
                        <span>-</span>
                        <input type="number" name="price_max" id="price_max" placeholder="Max"
                               value="{{ request('price_max') }}"
                               class="w-24 mt-1 block pl-3 pr-2 py-2 text-base border-gray-300 focus:outline-none focus:ring-green-500 focus:border-green-500 sm:text-sm rounded-md shadow-sm">
                    </div>

                    <div class="flex items-center gap-2">
                        <label for="rating" class="text-sm font-medium text-gray-700">Rating:</label>
                        <select name="rating" id="rating" onchange="this.form.submit()"
                                class="mt-1 block w-full pl-3 pr-10 py-2 text-base border-gray-300 focus:outline-none focus:ring-green-500 focus:border-green-500 sm:text-sm rounded-md shadow-sm">
                            <option value="">Any</option>
                            <option value="5" @if(request('rating') == '5') selected @endif>5 Stars</option>
                            <option value="4" @if(request('rating') == '4') selected @endif>4+ Stars</option>
                            <option value="3" @if(request('rating') == '3') selected @endif>3+ Stars</option>
                            <option value="2" @if(request('rating') == '2') selected @endif>2+ Stars</option>
                            <option value="1" @if(request('rating') == '1') selected @endif>1+ Star</option>
                        </select>
                    </div>
                    
                    <button type="submit" class="bg-green-500 hover:bg-green-600 text-white font-bold py-2 px-4 rounded-md transition duration-300">
                        Apply
                    </button>
                    
                    @if (request()->hasAny(['sort_by', 'price_min', 'price_max', 'rating']))
                        <a href="{{ route('products.category', ['category' => $category]) }}" class="text-red-500 hover:underline">
                            Clear Filters
                        </a>
                    @endif
                </form>
            </div>
            
            <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-5 gap-6">

                @forelse ($products as $product)
                    <div x-data="{}" class="bg-white rounded-lg shadow-md overflow-hidden flex flex-col items-center p-4 relative">

                        @if ($product->quantity <= 0)
                            <div class="absolute inset-0 bg-gray-900 bg-opacity-75 flex justify-center items-center z-10">
                                <span class="text-white text-xl font-bold uppercase tracking-wider">Sold Out</span>
                            </div>
                        @endif
                        
                        @if($product->is_deal)
                            <span class="absolute top-2 right-2 bg-red-600 text-white text-xs font-bold px-2 py-1 rounded-full z-10 transform -rotate-12">
                                DEAL!
                            </span>
                        @endif

                        <a href="{{ route('products.show', ['id' => $product->id]) }}" class="flex flex-col items-center text-center">
                            <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}" class="w-36 h-36 object-cover rounded-md mb-3">
                            <h3 class="font-semibold text-gray-800 text-lg text-center mb-1 hover:text-green-500">{{ $product->name }}</h3>
                        </a>
                        
                        @if ($product->is_deal)
                            <p class="text-gray-500 line-through text-sm">${{ number_format($product->price, 2) }}</p>
                            <p class="text-green-600 font-bold text-base mb-2">
                                ${{ number_format($product->deal_price, 2) }}
                            </p>
                        @else
                            <p class="text-green-600 font-bold text-base mb-2">
                                ${{ number_format($product->price, 2) }}
                            </p>
                        @endif

                        @php
                            // ZAP! The query now provides these values directly, no need to rely on the relationship!
                            $avgRating = $product->reviews_avg_rating ?? 0;
                            $reviewCount = $product->reviews_count ?? 0;
                        @endphp
                        <div class="flex items-center justify-center text-yellow-400 mb-2">
                            @for ($i = 1; $i <= 5; $i++)
                                @if ($avgRating >= $i)
                                    <svg class="w-4 h-4 fill-current" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M10 15l-5.878 3.09 1.123-6.545L.489 7.027l6.572-.955L10 0l2.939 6.072 6.572.955-4.756 4.618 1.123 6.545z"/></svg>
                                @elseif($avgRating > $i - 1)
                                    <svg class="w-4 h-4 fill-current" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M10 15l-5.878 3.09 1.123-6.545L.489 7.027l6.572-.955L10 0l2.939 6.072 6.572.955-4.756 4.618 1.123 6.545z" fill="url(#half-star)"/><defs><linearGradient id="half-star"><stop offset="50%" stop-color="currentColor"/><stop offset="50%" stop-color="transparent"/></linearGradient></defs></svg>
                                @else
                                    <svg class="w-4 h-4 fill-current text-gray-300" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M10 15l-5.878 3.09 1.123-6.545L.489 7.027l6.572-.955L10 0l2.939 6.072 6.572.955-4.756 4.618 1.123 6.545z"/></svg>
                                @endif
                            @endfor
                            <span class="text-gray-600 text-xs ml-1">({{ $reviewCount }} reviews)</span>
                        </div>
                        
                        <p class="text-gray-500 text-sm text-center line-clamp-2">{{ $product->description }}</p>

                        @if ($product->quantity > 0)
                            <button @click="
                                fetch('{{ route('cart.add') }}', {
                                        method: 'POST',
                                        headers: {
                                            'Content-Type': 'application/json',
                                            'X-CSRF-TOKEN': '{{ csrf_token() }}'
                                        },
                                        body: JSON.stringify({
                                            product_id: {{ Js::from($product->id) }},
                                            name: {{ Js::from($product->name) }},
                                            price: parseFloat({{ Js::from($product->price) }}),
                                            image: {{ Js::from($product->image) }},
                                            quantity: 1
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
                                " class="mt-auto bg-green-500 hover:bg-green-600 text-white font-bold py-2 px-4 rounded-full transition">
                                Add to Cart
                            </button>
                        @else
                            <button class="mt-auto bg-gray-400 text-white font-bold py-2 px-4 rounded-full cursor-not-allowed" disabled>
                                Sold Out
                            </button>
                        @endif
                    </div>
                @empty
                    <div class="col-span-full text-center text-gray-600 text-xl py-10">
                        No products found with these filters.
                    </div>
                @endforelse

            </div>
        </div>
    </section>

</x-app-layout>