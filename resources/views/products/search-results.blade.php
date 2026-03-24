<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Search Results for "{{ $searchQuery }}"
        </h2>
    </x-slot>

    <section class="py-12 bg-[#faf3ef]">
        <div class="container mx-auto px-4">
            @if(count($products) > 0)
                <p class="text-center text-gray-600 mb-8">Found {{ count($products) }} item(s) matching "{{ $searchQuery }}".</p>

                {{-- Product Grid (similar to category.blade.php) --}}
                <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-5 gap-6">

                    @foreach ($products as $product)
                        <div class="bg-white rounded-lg shadow-md overflow-hidden flex flex-col items-center p-4">
                            <img src="{{ asset('images/products/' . $product['image']) }}" alt="{{ $product['name'] }}" class="w-36 h-36 object-cover rounded-md mb-3">
                            <h3 class="font-semibold text-gray-800 text-lg text-center mb-1">{{ $product['name'] }}</h3>
                            <p class="text-green-600 font-bold text-base mb-2">{{ $product['price'] }}</p>
                            <p class="text-gray-500 text-sm text-center line-clamp-2">{{ $product['description'] }}</p>
                            <button class="mt-4 bg-green-500 hover:bg-green-600 text-white font-bold py-2 px-4 rounded-full transition">Add to Cart</button>
                        </div>
                    @endforeach

                </div>
            @else
                <div class="text-center text-gray-600 text-xl py-10">
                    No products found matching "{{ $searchQuery }}". Try a different search term!
                </div>
            @endif
        </div>
    </section>

</x-app-layout>