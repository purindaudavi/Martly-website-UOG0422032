<x-app-layout>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Checkout
        </h2>
    </x-slot>

    <div class="py-12 bg-gray-100 min-h-screen">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-6">

                <h3 class="text-2xl font-bold mb-6">Shipping and Payment</h3>

                <form method="POST" action="{{ route('checkout.process') }}">
                    @csrf

                    {{-- Shipping Information Section --}}
                    <div class="mb-8">
                        <h4 class="text-xl font-semibold mb-4 border-b pb-2">Shipping Information</h4>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label for="name" class="block text-sm font-medium text-gray-700">Full Name</label>
                                <input type="text" name="name" id="name" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                            </div>
                            <div>
                                <label for="address" class="block text-sm font-medium text-gray-700">Shipping Address</label>
                                <input type="text" name="address" id="address" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                            </div>
                            <div>
                                <label for="city" class="block text-sm font-medium text-gray-700">City</label>
                                <input type="text" name="city" id="city" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                            </div>
                            <div>
                                <label for="postal_code" class="block text-sm font-medium text-gray-700">Postal Code</label>
                                <input type="text" name="postal_code" id="postal_code" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                            </div>
                        </div>
                    </div>

                    {{-- Payment Information Section --}}
                    <div class="mb-8">
                        <h4 class="text-xl font-semibold mb-4 border-b pb-2">Payment Information</h4>
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Payment Method</label>
                            <div class="mt-2 space-y-2">
                                <div class="flex items-center">
                                    <input id="payment_visa" name="payment_method" type="radio" value="visa" class="focus:ring-indigo-500 h-4 w-4 text-indigo-600 border-gray-300" checked>
                                    <label for="payment_visa" class="ml-3 block text-sm font-medium text-gray-700">
                                        Visa
                                    </label>
                                </div>
                            </div>
                        </div>
                        
                        {{-- New credit card form fields --}}
                        <div class="mt-6 grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div class="md:col-span-2">
                                <label for="card_number" class="block text-sm font-medium text-gray-700">Card Number</label>
                                <input type="text" name="card_number" id="card_number" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                            </div>
                            <div>
                                <label for="expiration_date" class="block text-sm font-medium text-gray-700">Expiration Date (MM/YY)</label>
                                <input type="text" name="expiration_date" id="expiration_date" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" placeholder="MM/YY">
                            </div>
                            <div>
                                <label for="cvc" class="block text-sm font-medium text-gray-700">CVC</label>
                                <input type="text" name="cvc" id="cvc" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                            </div>
                        </div>
                    </div>

                    {{-- Order Summary --}}
                    <div class="mb-6">
                        <h4 class="text-xl font-semibold mb-4 border-b pb-2">Order Summary</h4>
                        <div class="flex justify-between font-bold text-lg mb-4">
                            <span>Grand Total:</span>
                            <span>${{ number_format($grandTotal, 2) }}</span>
                        </div>
                    </div>

                    {{-- The Submit Button --}}
                    <div class="flex justify-end">
                        <button type="submit" class="bg-green-500 hover:bg-green-600 text-white font-bold py-3 px-6 rounded-full transition duration-300">
                            Pay ${{ number_format($grandTotal, 2) }}
                        </button>
                    </div>

                </form>

            </div>
        </div>
    </div>

</x-app-layout>