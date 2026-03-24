<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Your Shopping Cart
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">

                @if (empty($cart))
                    <div class="text-center py-10">
                        <p class="text-gray-600 text-lg mb-4">Your cart is empty! Time to fill it with amazing deals and products.</p>
                        <a href="{{ route('products.index') }}" class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-green-500 hover:bg-green-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500">
                            Start Shopping
                        </a>
                        <a href="{{ route('deals.index') }}" class="ml-4 inline-flex items-center px-4 py-2 border border-green-500 text-sm font-medium rounded-md text-green-700 bg-white hover:bg-green-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500">
                            Check Out Deals
                        </a>
                    </div>
                @else
                    {{-- The x-data attribute should contain the Alpine.js data object --}}
                    <div class="space-y-6"
                         x-data="{
                             // Ensure $cart is correctly passed and JSON encoded.
                             // The `Js::from()` helper is the safest way to inject PHP arrays/objects into JS.
                             cartItems: {{ Js::from($cart) }},
                             get totalItems() {
                                 return Object.values(this.cartItems).reduce((sum, item) => sum + item.quantity, 0);
                             },
                             get grandTotal() {
                                 return Object.values(this.cartItems).reduce((sum, item) => sum + (parseFloat(item.price) * item.quantity), 0).toFixed(2);
                             },
                             updateQuantity(productId, newQuantity) {
                                 newQuantity = parseInt(newQuantity);
                                 if (isNaN(newQuantity) || newQuantity <= 0) {
                                     this.removeCartItem(productId); // Remove if quantity is invalid or zero/negative
                                     return;
                                 }
                                 if (this.cartItems[productId]) {
                                     this.cartItems[productId].quantity = newQuantity;
                                     // OPTIONAL: Send update to backend. For now, client-side only for quantity input.
                                     // You'd add a fetch call here similar to removeCartItem if you want immediate backend persistence.
                                 }
                             },
                             removeCartItem(productId) {
                                 if (confirm('Are you sure you want to remove this item from your cart?')) {
                                     // FIX: Use route() helper instead of hardcoded URL for robustness
                                     fetch('{{ route('cart.remove') }}', {
                                         method: 'POST',
                                         headers: {
                                             'Content-Type': 'application/json',
                                             'X-CSRF-TOKEN': '{{ csrf_token() }}'
                                         },
                                         body: JSON.stringify({ product_id: productId })
                                     })
                                     .then(response => response.json())
                                     .then(data => {
                                         if(data.success) {
                                             // Update Alpine.js cartItems reactivity
                                             this.cartItems = Object.fromEntries(
                                                 Object.entries(this.cartItems).filter(([id]) => id != productId)
                                             );
                                             // Dispatch event to update cart count in navigation
                                             window.dispatchEvent(new CustomEvent('cart-updated', { detail: { count: data.cartCount } }));
                                             // FIX: Use template literal for clearer alert message
                                             alert(`${data.message} Current cart items: ${data.cartCount}`);
                                         } else {
                                             alert('Failed to remove item: ' + (data.message || 'Unknown error.'));
                                         }
                                     })
                                     .catch(error => {
                                         console.error('Error removing item:', error);
                                         alert('Error communicating with server to remove item.');
                                     });
                                 }
                             }
                         }">
                        <h3 class="text-2xl font-bold text-gray-800 mb-6">Items in your Cart</h3>

                        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                            {{-- Cart Items Section --}}
                            <div class="md:col-span-2 bg-gray-50 rounded-lg p-4 shadow-sm">
                                {{-- Use x-for to loop through cartItems --}}
                                <template x-for="(item, productId) in cartItems" :key="productId">
                                    <div class="flex items-center py-4 border-b border-gray-200 last:border-b-0">
                                        <img :src="'{{ asset('images/products/') }}' + '/' + item.image" :alt="item.name" class="w-20 h-20 object-cover rounded-md mr-4">
                                        <div class="flex-grow">
                                            <h4 class="font-semibold text-lg text-gray-800" x-text="item.name"></h4>
                                            <p class="text-gray-600">Price: <span x-text="'$' + parseFloat(item.price).toFixed(2)"></span></p>
                                        </div>
                                        <div class="flex items-center space-x-2 mr-4">
                                            <button @click="updateQuantity(productId, item.quantity - 1)" class="bg-gray-200 text-gray-700 px-2 py-1 rounded-md hover:bg-gray-300">-</button>
                                            <input type="number" x-model.number="item.quantity"
                                                @change="updateQuantity(productId, $event.target.value)"
                                                min="0" {{-- Allow 0 so it can trigger removal --}}
                                                class="w-16 text-center border-gray-300 rounded-md shadow-sm focus:border-green-300 focus:ring focus:ring-green-200 focus:ring-opacity-50">
                                            <button @click="updateQuantity(productId, item.quantity + 1)" class="bg-gray-200 text-gray-700 px-2 py-1 rounded-md hover:bg-gray-300">+</button>
                                        </div>
                                        <div class="text-right">
                                            <p class="font-bold text-gray-800" x-text="'$' + (parseFloat(item.price) * item.quantity).toFixed(2)"></p>
                                            <button @click="removeCartItem(productId)" class="text-red-500 hover:text-red-700 text-sm mt-1">Remove</button>
                                        </div>
                                    </div>
                                </template>
                                {{-- Handle case where cart becomes empty after removal --}}
                                <template x-if="Object.keys(cartItems).length === 0">
                                    <div class="text-center py-10">
                                        <p class="text-gray-600 text-lg mb-4">Your cart is empty! Add some delicious items.</p>
                                        <a href="{{ route('products.index') }}" class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-green-500 hover:bg-green-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500">
                                            Start Shopping
                                        </a>
                                    </div>
                                </template>
                            </div>

                            {{-- Cart Summary Section --}}
                            <div class="md:col-span-1 bg-gray-50 rounded-lg p-6 shadow-sm flex flex-col justify-between">
                                <div>
                                    <h3 class="text-xl font-bold text-gray-800 mb-4">Order Summary</h3>
                                    <div class="flex justify-between text-gray-700 mb-2">
                                        <span>Total Items:</span>
                                        <span x-text="totalItems"></span>
                                    </div>
                                    <div class="flex justify-between text-gray-700 font-semibold text-lg border-t pt-4 mt-4">
                                        <span>Grand Total:</span>
                                        <span x-text="'$' + grandTotal"></span>
                                    </div>
                                </div>
                                <a href="{{ route('checkout.index') }}" 
                                    class="block text-center w-full bg-green-600 hover:bg-green-700 text-white font-bold py-3 px-4 rounded-md transition mt-6">
                                     Proceed to Checkout
                                </a>
                            </div>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>