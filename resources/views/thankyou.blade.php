<x-app-layout>

    <div class="py-12 bg-gray-100 min-h-screen">
        <div class="max-w-xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-6 text-center">

                @if (session('status'))
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-20 w-20 text-green-500 mx-auto mb-4" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                    </svg>

                    <h2 class="text-3xl font-bold text-gray-800 mb-2">Order Confirmed!</h2>
                    <p class="text-lg text-gray-600 mb-6">{{ session('status') }}</p>

                    <p class="text-sm text-gray-500 mb-8">
                        Thank you for your purchase. We have received your order and will send you a confirmation email shortly.
                    </p>

                    <a href="{{ route('dashboard') }}" class="inline-flex items-center px-6 py-3 border border-transparent text-base font-medium rounded-md shadow-sm text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                        Continue Shopping
                    </a>
                @else
                    {{-- If no status message, maybe the user arrived here by accident. --}}
                    <h2 class="text-3xl font-bold text-gray-800 mb-4">Something went wrong!</h2>
                    <p class="text-lg text-gray-600 mb-8">It seems there was an issue with your order. Please try again or contact support.</p>
                    <a href="{{ route('cart.index') }}" class="inline-flex items-center px-6 py-3 border border-transparent text-base font-medium rounded-md shadow-sm text-white bg-red-600 hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500">
                        Return to Cart
                    </a>
                @endif

            </div>
        </div>
    </div>

</x-app-layout>