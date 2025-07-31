<nav x-data="{ cartItemCount: 0 }" x-init="
        fetch('{{ route('cart.count') }}')
            .then(response => response.json())
            .then(data => {
                cartItemCount = data.count;
            })
            .catch(error => console.error('Error fetching cart count:', error));

        // Listen for custom events to update cart count (will be dispatched by 'Add to Cart' buttons)
        window.addEventListener('cart-updated', (event) => {
            cartItemCount = event.detail.count;
        });
    "
    class="bg-[#faf3ef] text-gray-800 shadow-lg p-4">
    <div class="container mx-auto flex items-center justify-between">
        
        <div class="flex items-center space-x-6">
            <a href="/" class="text-2xl font-bold flex items-center gap-2">
                <img src="{{ asset('images/martly-lite-logo.png') }}" alt="Martly Lite Logo" class="h-8 w-auto">
                Martly <span class="text-green-400">Lite</span>
            </a>
            
            <div class="hidden md:flex space-x-6">
                <a href="{{ route('deals.index') }}" class="hover:text-green-400 transition">Deals</a>
                <a href="{{ route('products.index') }}" class="hover:text-green-400 transition">Our Products</a>
            </div>
        </div>
        
        <div class="flex items-center space-x-4">
            {{-- Search Bar with Alpine.js for expand/collapse --}}
            <div x-data="{ open: false }" class="relative flex items-center">
                {{-- Search Icon (always visible) --}}
                <button @click="open = !open; $nextTick(() => { if(open) $refs.searchInput.focus() })"
                        class="hover:text-green-400 transition p-1 rounded-full focus:outline-none focus:ring-2 focus:ring-green-300"
                        aria-label="Toggle Search">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                    </svg>
                </button>

                {{-- Search Input Field (expands/collapses) --}}
                <div x-show="open"
                        x-transition:enter="transition ease-out duration-300"
                        x-transition:enter-start="opacity-0"
                        x-transition:enter-end="opacity-100"
                        x-transition:leave="transition ease-in duration-200"
                        x-transition:leave-start="opacity-100"
                        x-transition:leave-end="opacity-0"
                        class="absolute right-full mr-2 overflow-hidden w-64"
                    >
                    <form action="{{ route('products.search') }}" method="GET">
                        <input type="search"
                                name="query"
                                x-ref="searchInput"
                                @click.outside="open = false"
                                class="form-input rounded-full border-gray-300 focus:border-green-300 focus:ring focus:ring-green-200 focus:ring-opacity-50 w-full px-4 py-2 text-sm text-gray-700 bg-white shadow-sm"
                                placeholder="Search products..."
                                value="{{ request('query') }}"
                            >
                    </form>
                </div>
            </div>

            {{-- Existing Auth Links and Icons --}}
            @auth
                <form method="POST" action="{{ route('logout') }}" class="hidden md:block">
                    @csrf
                    <button type="submit" class="hover:text-red-400 transition">Log Out</button>
                </form>

                <a href="{{ route('profile.edit') }}" class="hover:text-green-400 transition">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                    </svg>
                </a>
            @else
                <a href="{{ route('login') }}" class="hover:text-green-400 transition hidden md:block">Login</a>
                <a href="{{ route('register') }}" class="hover:text-green-400 transition hidden md:block">Register</a>
            @endauth

            {{-- Cart Icon with Item Count --}}
            <a href="{{ route('cart.index') }}" class="relative hover:text-green-400 transition">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.182 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z" />
                </svg>
                <span x-show="cartItemCount > 0"
                      x-text="cartItemCount"
                      class="absolute -top-2 -right-2 bg-red-500 text-white text-xs font-bold rounded-full w-5 h-5 flex items-center justify-center animate-bounce-once"
                      style="font-size: 0.65rem;">
                </span>
            </a>
        </div>
    </div>
</nav>