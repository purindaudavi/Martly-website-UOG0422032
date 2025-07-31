<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Our Products') }}
        </h2>
    </x-slot>

    <section class="w-full">
        <div class="relative w-full overflow-hidden">
            <img src="{{ asset('images/products/banner.png') }}" alt="Everything You Need to Stock a Healthier Home" class="w-full h-80 object-cover">
            <div class="absolute inset-0 flex items-center justify-center bg-black bg-opacity-10">
                <div class="text-center text-white">
                    {{--<h1 class="text-4xl md:text-5xl font-extrabold mb-4">Everything You Need to Stock a Healthier Home</h1>--}}
                   {{-- <a href="#" class="inline-block bg-[#f97316] hover:bg-[#ea580c] text-white font-bold py-3 px-8 rounded-full shadow-lg transition duration-300">--}}
                        {{--Get Started--}}
                    {{--</a>--}}
                </div>
            </div>
        </div>
    </section>

    <section class="py-12 bg-[#faf3ef]">
        <div class="container mx-auto px-4">
            <h2 class="text-3xl font-extrabold text-center text-gray-800 mb-8">Shop Our Diverse Range of Groceries</h2>
            <p class="text-center text-gray-600 mb-12">Find everything you need for a healthier lifestyle, from fresh produce to pantry staples</p>

            {{-- **THE CORE CHANGES START HERE** --}}
            {{-- This grid setup ensures 2 columns on small screens and up --}}
            <div class="grid grid-cols-1 sm:grid-cols-4 gap-2 max-w-1xl mx-auto"> {{-- max-w-4xl mx-auto centers the grid --}}

                {{-- Each of these divs is ONE grid item, containing both image and text --}}

                {{-- Category Tile: Meat & Seafood --}}
                <div class="flex flex-col items-center"> {{-- Flex column to stack image and text --}}
                <a href="{{ route('products.category', ['category' => 'meat-seafood']) }}" class="block bg-white rounded-xl shadow-md overflow-hidden hover:shadow-lg transition duration-300 transform hover:-translate-y-1 w-full"> {{-- w-full makes the image-container fill the column --}}
                        <img src="{{ asset('images/products/meat.jpg') }}" alt="Meat & Seafood" class="w-full h-96 object-cover"> {{-- h-96 for larger tile size --}}
                    </a>
                    <div class="text-center mt-4 w-full"> {{-- Text below, centered, with increased margin-top --}}
                        <h3 class="font-semibold text-gray-800 text-2xl">Meat & Seafood</h3> {{-- Larger text size --}}
                    </div>
                </div>

                {{-- Category Tile: Snacks, Bars & Treats --}}
                <div class="flex flex-col items-center">
                <a href="{{ route('products.category', ['category' => 'snacks-bars-treats']) }}" class="block bg-white rounded-xl shadow-md overflow-hidden hover:shadow-lg transition duration-300 transform hover:-translate-y-1 w-full">
                        <img src="{{ asset('images/products/snacks.jpg') }}" alt="Snacks, Bars & Treats" class="w-full h-96 object-cover">
                    </a>
                    <div class="text-center mt-4 w-full">
                        <h3 class="font-semibold text-gray-800 text-2xl">Snacks, Bars & Treats</h3>
                    </div>
                </div>

                {{-- Category Tile: Beverages --}}
                <div class="flex flex-col items-center">
                    <a href="{{ route('products.category', ['category' => 'beverages']) }}" class="block bg-white rounded-xl shadow-md overflow-hidden hover:shadow-lg transition duration-300 transform hover:-translate-y-1 w-full">
                        <img src="{{ asset('images/products/beverages.jpg') }}" alt="Beverages" class="w-full h-96 object-cover">
                    </a>
                    <div class="text-center mt-4 w-full">
                        <h3 class="font-semibold text-gray-800 text-2xl">Beverages</h3>
                    </div>
                </div>

                {{-- Category Tile: Frozen --}}
                <div class="flex flex-col items-center">
                <a href="{{ route('products.category', ['category' => 'frozen']) }}" class="block bg-white rounded-xl shadow-md overflow-hidden hover:shadow-lg transition duration-300 transform hover:-translate-y-1 w-full">
                        <img src="{{ asset('images/products/frozen.jpg') }}" alt="Frozen" class="w-full h-96 object-cover">
                    </a>
                    <div class="text-center mt-4 w-full">
                        <h3 class="font-semibold text-gray-800 text-2xl">Frozen</h3>
                    </div>
                </div>

                {{-- Category Tile: Wine --}}
                <div class="flex flex-col items-center">
                <a href="{{ route('products.category', ['category' => 'wine']) }}" class="block bg-white rounded-xl shadow-md overflow-hidden hover:shadow-lg transition duration-300 transform hover:-translate-y-1 w-full">
                        <img src="{{ asset('images/products/wine.jpg') }}" alt="Wine" class="w-full h-96 object-cover">
                    </a>
                    <div class="text-center mt-4 w-full">
                        <h3 class="font-semibold text-gray-800 text-2xl">Wine</h3>
                    </div>
                </div>

                {{-- Category Tile: Household & Cleaning --}}
                <div class="flex flex-col items-center">
                <a href="{{ route('products.category', ['category' => 'household-cleaning']) }}" class="block bg-white rounded-xl shadow-md overflow-hidden hover:shadow-lg transition duration-300 transform hover:-translate-y-1 w-full">
                        <img src="{{ asset('images/products/household.jpg') }}" alt="Household & Cleaning" class="w-full h-96 object-cover">
                    </a>
                    <div class="text-center mt-4 w-full">
                        <h3 class="font-semibold text-gray-800 text-2xl">Household & Cleaning</h3>
                    </div>
                </div>

                {{-- Category Tile: Vitamins & Supplements --}}
                <div class="flex flex-col items-center">
                <a href="{{ route('products.category', ['category' => 'vitamins-supplements']) }}" class="block bg-white rounded-xl shadow-md overflow-hidden hover:shadow-lg transition duration-300 transform hover:-translate-y-1 w-full">
                        <img src="{{ asset('images/products/vitamins.jpg') }}" alt="Vitamins & Supplements" class="w-full h-96 object-cover">
                    </a>
                    <div class="text-center mt-4 w-full">
                        <h3 class="font-semibold text-gray-800 text-2xl">Vitamins & Supplements</h3>
                    </div>
                </div>

                {{-- Category Tile: Trending Now --}}
                <div class="flex flex-col items-center">
                <a href="{{ route('products.category', ['category' => 'trending-now']) }}" class="block bg-white rounded-xl shadow-md overflow-hidden hover:shadow-lg transition duration-300 transform hover:-translate-y-1 w-full">
                        <img src="{{ asset('images/products/trending.jpg') }}" alt="Trending Now" class="w-full h-96 object-cover">
                    </a>
                    <div class="text-center mt-4 w-full">
                        <h3 class="font-semibold text-gray-800 text-2xl">Trending Now</h3>
                    </div>
                </div>

                

            </div>
        </div>
    </section>

</x-app-layout>