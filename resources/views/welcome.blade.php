@extends('layouts.guest')

@section('content')
<main class="container mx-auto px-4 py-8">

<section class="relative w-full max-w-6xl mx-auto overflow-hidden rounded-xl shadow-lg mb-8" style="padding-top: 40.8125%; /* Adjusted for 2048x1184 aspect ratio */">
    <div id="carousel-container" class="absolute inset-0 flex transition-transform ease-out duration-500">
        <div class="w-full flex-shrink-0 bg-green-500 text-white flex items-center justify-center p-8" style="background-image: url('{{ asset('images/dashboard/dashslide2.png') }}'); background-size: cover; background-position: center;">
            </div>
        <div class="w-full flex-shrink-0 bg-yellow-500 text-white flex items-center justify-center p-8" style="background-image: url('{{ asset('images/dashboard/dashslide1.png') }}'); background-size: cover; background-position: center;">
            </div>
        <div class="w-full flex-shrink-0 bg-blue-500 text-white flex items-center justify-center p-8" style="background-image: url('{{ asset('images/dashboard/dashslide3.png') }}'); background-size: cover; background-position: center;">
            </div>
        <div class="w-full flex-shrink-0 bg-purple-500 text-white flex items-center justify-center p-8" style="background-image: url('{{ asset('images/dashboard/dashslide4.png') }}'); background-size: cover; background-position: center;">
            </div>
    </div>
    <div class="absolute bottom-4 left-1/2 -translate-x-1/2 flex space-x-2">
        <button class="w-3 h-3 bg-green-500 rounded-full opacity-50 hover:opacity-100 transition duration-300 carousel-dot active"></button>
        <button class="w-3 h-3 bg-green-500 rounded-full opacity-50 hover:opacity-100 transition duration-300 carousel-dot"></button>
        <button class="w-3 h-3 bg-green-500 rounded-full opacity-50 hover:opacity-100 transition duration-300 carousel-dot"></button>
        <button class="w-3 h-3 bg-green-500 rounded-full opacity-50 hover:opacity-100 transition duration-300 carousel-dot"></button>
    </div>
</section>

<section class="grid grid-cols-1 md:grid-cols-3 gap-8 mb-8">
    <div class="bg-white rounded-xl shadow-lg p-6 flex items-start hover:shadow-xl transition-shadow duration-300">
        <img src="{{ asset('images/dashboard/smallimages1.png') }}" alt="On Sale" class="rounded-lg w-24 h-24 object-cover mr-4 flex-shrink-0">
        <div>
            <h3 class="text-2xl font-bold text-gray-800 mb-2">On Sale This Week</h3>
            <p class="text-gray-600">Great discounts on your favorite products.</p>
        </div>
    </div>
    <div class="bg-white rounded-xl shadow-lg p-6 flex items-start hover:shadow-xl transition-shadow duration-300">
        <img src="{{ asset('images/dashboard/smallimages2.png') }}" alt="Trending" class="rounded-lg w-24 h-24 object-cover mr-4 flex-shrink-0">
        <div>
            <h3 class="text-2xl font-bold text-gray-800 mb-2">Trending Items</h3>
            <p class="text-gray-600">See what everyone's loving right now!</p>
        </div>
    </div>
    <div class="bg-white rounded-xl shadow-lg p-6 flex items-start hover:shadow-xl transition-shadow duration-300">
        <img src="{{ asset('images/dashboard/smallimages3.png') }}" alt="Best Sellers" class="rounded-lg w-24 h-24 object-cover mr-4 flex-shrink-0">
        <div>
            <h3 class="text-2xl font-bold text-gray-800 mb-2">Best Sellers</h3>
            <p class="text-gray-600">The most popular products of the month.</p>
        </div>
    </div>
</section>

    <section class="bg-white rounded-xl shadow-lg p-8 md:p-12 mb-8">
        <h2 class="text-3xl md:text-4xl font-extrabold text-gray-800 mb-6">Why Martly Lite is Your Best Choice</h2>
        <ul class="space-y-4 text-gray-600 text-lg">
            <li class="flex items-start">
                <svg class="w-6 h-6 text-green-500 mr-2 flex-shrink-0 mt-1" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path></svg>
                <span>Thousands of the highest-quality organic and sustainable products.</span>
            </li>
            <li class="flex items-start">
                <svg class="w-6 h-6 text-green-500 mr-2 flex-shrink-0 mt-1" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path></svg>
                <span>Specialty items for 90+ lifestyle and dietary needs.</span>
            </li>
            <li class="flex items-start">
                <svg class="w-6 h-6 text-green-500 mr-2 flex-shrink-0 mt-1" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path></svg>
                <span>No artificial flavors or synthetic colors.</span>
            </li>
            <li class="flex items-start">
                <svg class="w-6 h-6 text-green-500 mr-2 flex-shrink-0 mt-1" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path></svg>
                <span>Rigorous quality standards with hundreds of restricted ingredients.</span>
            </li>
        </ul>
    </section>

    <section class="py-12 bg-white">
    <div class="container mx-auto px-4">
        <h2 class="text-3xl font-extrabold text-center text-gray-800 mb-8">Save On 5,000+ Healthy and Organic Groceries</h2>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            {{-- Card 1: Low price promise --}}
            <div class="bg-[#bce1d7] rounded-xl shadow-md p-6 flex items-start">
                <img src="{{ asset('images/dashboard/sm1.jpg') }}" alt="Keto Products" class="w-24 h-24 mr-4 rounded object-cover flex-shrink-0 border-0">
                <div class="flex-grow">
                    <h3 class="font-semibold text-gray-700 mb-1">Low price promise</h3>
                    <p class="text-gray-600 text-sm">See a cheaper product elsewhere? We’ll match it—guaranteed through our Price Match Program.</p>
                </div>
            </div>
            {{-- Card 2: FREE gifts on qualifying orders --}}
            <div class="bg-[#aae8f7] rounded-xl shadow-md p-6 flex items-start">
                <img src="{{ asset('images/dashboard/sm4.jpg') }}" alt="Free Gifts" class="w-24 h-24 mr-4 rounded object-cover flex-shrink-0 border-0">
                <div class="flex-grow">
                    <h3 class="font-semibold text-gray-700 mb-1">FREE gifts on qualifying orders</h3>
                    <p class="text-gray-600 text-sm">Enjoy full-size products from some of your favorite brands, on us.</p>
                </div>
            </div>
            {{-- Card 3: Save an extra 5-10% on thousands of items with Autoship --}}
            <div class="bg-[#dadfba] rounded-xl shadow-md p-6 flex items-start">
                <img src="{{ asset('images/dashboard/sm2.jpg') }}" alt="Autoship Savings" class="w-24 h-24 mr-4 rounded object-cover flex-shrink-0 border-0">
                <div class="flex-grow">
                    <h3 class="font-semibold text-gray-700 mb-1">Save an extra 5-10% on thousands of items with Autoship</h3>
                    <p class="text-gray-600 text-sm">Edit items, skip or pause recurring deliveries, or place one-time orders anytime.</p>
                </div>
            </div>
            {{-- Card 4: Exclusive deals, coupons, and Thrive Cash --}}
            <div class="bg-[#f9c9a5] rounded-xl shadow-md p-6 flex items-start">
                <img src="{{ asset('images/dashboard/sm5.jpg') }}" alt="Exclusive Deals" class="w-24 h-24 mr-4 rounded object-cover flex-shrink-0 border-0">
                <div class="flex-grow">
                    <h3 class="font-semibold text-gray-700 mb-1">Exclusive deals, coupons, and Thrive Cash</h3>
                    <p class="text-gray-600 text-sm">Discover special weekly sales and earn store credit as you shop.</p>
                </div>
            </div>
            {{-- Card 5: Thrive Market Brands --}}
            <div class="bg-[#e2d2df] rounded-xl shadow-md p-6 flex items-start">
                <img src="{{ asset('images/dashboard/sm3.jpg') }}" alt="Thrive Market Brands" class="w-24 h-24 mr-4 rounded object-cover flex-shrink-0 border-0">
                <div class="flex-grow">
                    <h3 class="font-semibold text-gray-700 mb-1">Thrive Market Brands</h3>
                    <p class="text-gray-600 text-sm">Shop our top-rated, affordable line of 600+ pantry staples and sustainably sourced proteins.</p>
                </div>
            </div>
            {{-- Card 6: Try us risk-free --}}
            <div class="bg-[#c6f2e1] rounded-xl shadow-md p-6 flex items-start">
                <img src="{{ asset('images/dashboard/sm6.jpg') }}" alt="Try Risk-Free" class="w-24 h-24 mr-4 rounded object-cover flex-shrink-0 border-0">
                <div class="flex-grow">
                    <h3 class="font-semibold text-gray-700 mb-1">Try us risk-free</h3>
                    <p class="text-gray-600 text-sm">Make back the cost of your annual membership in savings within one year, or we’ll credit you the difference in Thrive Cash when you renew. <a href="#" class="underline text-green-500">See Terms</a>. Not available for monthly memberships.</p>
                </div>
            </div>
        </div>
        <div class="text-center mt-8">
            <button class="bg-[#f97316] hover:bg-[#ea580c] text-white font-bold py-3 px-8 rounded-full shadow-lg transition duration-300">
                Start Shopping
            </button>
        </div>
    </div>
</section>

<section class="mb-8">
    <h2 class="text-3xl font-bold text-center text-gray-800 mb-6">What Our Customers Say</h2>
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        <div class="bg-white rounded-xl shadow-lg p-6">
            <p class="text-gray-700 mb-4 italic">"Martly Lite has the best organic produce I've ever had delivered. The quality is exceptional and the service is always reliable!"</p>
            <div class="flex items-center">
                <img class="w-12 h-12 rounded-full mr-4 object-cover" src="{{ asset('images/dashboard/ppl1.png') }}" alt="Jane Doe">
                <div>
                    <p class="font-bold text-gray-800">Jane Doe</p>
                    <p class="text-sm text-gray-500">Regular Customer</p>
                </div>
            </div>
        </div>
        <div class="bg-white rounded-xl shadow-lg p-6">
            <p class="text-gray-700 mb-4 italic">"The variety of products for my dietary needs is incredible. I can find everything in one place, and the delivery is so fast."</p>
            <div class="flex items-center">
                <img class="w-12 h-12 rounded-full mr-4 object-cover" src="{{ asset('images/dashboard/ppl2.png') }}" alt="John Smith">
                <div>
                    <p class="font-bold text-gray-800">John Smith</p>
                    <p class="text-sm text-gray-500">New Shopper</p>
                </div>
            </div>
        </div>
        <div class="bg-white rounded-xl shadow-lg p-6">
            <p class="text-gray-700 mb-4 italic">"I'm so impressed with the quality standards. It gives me peace of mind knowing I'm feeding my family the very best. Thank you Martly Lite!"</p>
            <div class="flex items-center">
                <img class="w-12 h-12 rounded-full mr-4 object-cover" src="{{ asset('images/dashboard/ppl3.png') }}" alt="Sarah Jones">
                <div>
                    <p class="font-bold text-gray-800">Sarah Jones</p>
                    <p class="text-sm text-gray-500">Verified User</p>
                </div>
            </div>
        </div>
    </div>
</section>
</main>

<footer class="bg-gray-800 text-white p-12">
    <div class="container mx-auto grid grid-cols-1 md:grid-cols-3 gap-8 text-center md:text-left">
        <div>
            <h4 class="text-xl font-bold mb-4">Contact Us</h4>
            <p class="text-gray-400 mb-1">Jaykay Marketing Services Pvt Ltd.</p>
            <p class="text-gray-400 mb-4">No:148, margobring Street, eveny, chargram.</p>
            <p class="text-gray-400">Phone: 0112303500</p>
            <p class="text-gray-400">Mobile: 0771234567</p>
        </div>

        <div>
            <h4 class="text-xl font-bold mb-4">Quick Links</h4>
            <ul class="space-y-2">
                <li><a href="#" class="text-gray-400 hover:text-green-400 transition">Home</a></li>
                <li><a href="#" class="text-gray-400 hover:text-green-400 transition">Deals</a></li>
                <li><a href="#" class="text-gray-400 hover:text-green-400 transition">Products</a></li>
                <li><a href="#" class="text-gray-400 hover:text-green-400 transition">Customer Service</a></li>
                <li><a href="#" class="text-gray-400 hover:text-green-400 transition">FAQs</a></li>
                <li><a href="#" class="text-gray-400 hover:text-green-400 transition">About Us</a></li>
            </ul>
        </div>

        <div class="md:text-right">
            <h4 class="text-xl font-bold mb-4">Follow Us</h4>
            <div class="flex justify-center md:justify-end space-x-4">
                <a href="#" class="text-gray-400 hover:text-green-400 transition">
                    <svg class="w-7 h-7" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2.034c-5.52 0-10 4.48-10 10s4.48 10 10 10 10-4.48 10-10-4.48-10-10-10zm-1.5 17h-2v-7h2v7zm1-1.5c.83 0 1.5-.67 1.5-1.5s-.67-1.5-1.5-1.5-1.5.67-1.5 1.5.67 1.5 1.5 1.5zm1.5-3.5h-3c0-.85.65-1.5 1.5-1.5s1.5-.65 1.5-1.5h-3v-2h3c0-2.21 1.79-4 4-4s4 1.79 4 4h-2c0-1.1-.9-2-2-2s-2 .9-2 2h3v2h-3c0 .85.65 1.5 1.5 1.5s1.5.65 1.5 1.5h-3v2h3c0 2.21-1.79 4-4 4s-4-1.79-4-4z" fill-rule="evenodd" clip-rule="evenodd" d="M12 2.034c-5.52 0-10 4.48-10 10s4.48 10 10 10 10-4.48 10-10-4.48-10-10-10zm-1.5 17h-2v-7h2v7zm1-1.5c.83 0 1.5-.67 1.5-1.5s-.67-1.5-1.5-1.5-1.5.67-1.5 1.5.67 1.5 1.5 1.5zm1.5-3.5h-3c0-.85.65-1.5 1.5-1.5s1.5-.65 1.5-1.5h-3v-2h3c0-2.21 1.79-4 4-4s4 1.79 4 4h-2c0-1.1-.9-2-2-2s-2 .9-2 2h3v2h-3c0 .85.65 1.5 1.5 1.5s1.5.65 1.5 1.5h-3v2h3c0 2.21-1.79 4-4 4s-4-1.79-4-4z"></path></svg>
                    <span class="sr-only">Facebook</span>
                </a>
                <a href="#" class="text-gray-400 hover:text-green-400 transition">
                    <svg class="w-7 h-7" fill="currentColor" viewBox="0 0 24 24"><path d="M22 6.033c-.76.336-1.57.56-2.42.66.88-.53 1.56-1.37 1.88-2.37-.83.49-1.75.85-2.73 1.04-.78-.83-1.89-1.35-3.13-1.35-2.37 0-4.29 1.92-4.29 4.29 0 .34.04.67.11.99-3.57-.18-6.73-1.89-8.85-4.49-.37.64-.58 1.39-.58 2.19 0 1.49.76 2.81 1.92 3.59-.71-.02-1.38-.22-1.97-.54v.05c0 2.08 1.48 3.82 3.44 4.21-.36.1-.74.15-1.13.15-.28 0-.55-.03-.82-.08.55 1.71 2.13 2.96 4.02 2.99-1.47 1.15-3.33 1.83-5.36 1.83-.35 0-.7-.02-1.04-.06 1.9 1.22 4.16 1.94 6.59 1.94 7.91 0 12.24-6.56 12.24-12.24 0-.19-.01-.39-.01-.58.84-.6 1.56-1.36 2.14-2.22z" fill-rule="evenodd" clip-rule="evenodd" d="M22 6.033c-.76.336-1.57.56-2.42.66.88-.53 1.56-1.37 1.88-2.37-.83.49-1.75.85-2.73 1.04-.78-.83-1.89-1.35-3.13-1.35-2.37 0-4.29 1.92-4.29 4.29 0 .34.04.67.11.99-3.57-.18-6.73-1.89-8.85-4.49-.37.64-.58 1.39-.58 2.19 0 1.49.76 2.81 1.92 3.59-.71-.02-1.38-.22-1.97-.54v.05c0 2.08 1.48 3.82 3.44 4.21-.36.1-.74.15-1.13.15-.28 0-.55-.03-.82-.08.55 1.71 2.13 2.96 4.02 2.99-1.47 1.15-3.33 1.83-5.36 1.83-.35 0-.7-.02-1.04-.06 1.9 1.22 4.16 1.94 6.59 1.94 7.91 0 12.24-6.56 12.24-12.24 0-.19-.01-.39-.01-.58.84-.6 1.56-1.36 2.14-2.22z"></path></svg>
                    <span class="sr-only">Twitter</span>
                </a>
                <a href="#" class="text-gray-400 hover:text-green-400 transition">
                    <svg class="w-7 h-7" fill="currentColor" viewBox="0 0 24 24"><path d="M16.98 0c2.42 0 3.99.27 4.81.57.77.29 1.35.79 1.93 1.37.58.58 1.08 1.16 1.37 1.93.3.82.57 2.39.57 4.81v6.4c0 2.42-.27 3.99-.57 4.81-.29.77-.79 1.35-1.37 1.93-.58.58-1.16 1.08-1.93 1.37-.82.3-2.39.57-4.81.57h-6.4c-2.42 0-3.99-.27-4.81-.57-.77-.29-1.35-.79-1.93-1.37-.58-.58-1.08-1.16-1.37-1.93-.3-.82-.57-2.39-.57-4.81v-6.4c0-2.42.27-3.99.57-4.81.29-.77.79-1.35 1.37-1.93.58-.58 1.16-1.08 1.93-1.37.82-.3 2.39-.57 4.81-.57h6.4zm-.02 2c-2.37 0-3.9.06-4.7.35-.55.22-.97.51-1.31.85-.34.34-.63.76-.85 1.31-.29.8-.35 2.33-.35 4.7v6.4c0 2.37.06 3.9.35 4.7.22.55.51.97.85 1.31.34.34.76.63.85 1.31.8.29 2.33.35 4.7.35h6.4c2.37 0 3.9-.06 4.7-.35.55-.22.97-.51 1.31-.85.34-.34.63-.76.85-1.31.29-.8.35-2.33.35-4.7v-6.4c0-2.37-.06-3.9-.35-4.7-.22-.55-.51-.97-.85-1.31-.34-.34-.76-.63-1.31-.85-.8-.29-2.33-.35-4.7-.35h-6.4zm-8.58 6c1.66 0 3 1.34 3 3s-1.34 3-3 3-3-1.34-3-3 1.34-3 3-3zm0 2c-.55 0-1 .45-1 1s.45 1 1 1 1-.45 1-1-.45-1-1-1zm6.5-7.5c.69 0 1.25.56 1.25 1.25s-.56 1.25-1.25 1.25-1.25-.56-1.25-1.25.56-1.25 1.25-1.25z"></path></svg>
                    <span class="sr-only">Instagram</span>
                </a>
            </div>
        </div>
    </div>
    <div class="border-t border-gray-700 mt-8 pt-8 text-center text-sm text-gray-500">
        © 2025 Martly Lite. All rights reserved.
    </div>
</footer>

<script>
    document.addEventListener('DOMContentLoaded', () => {
        const carouselContainer = document.getElementById('carousel-container');
        const dots = document.querySelectorAll('.carousel-dot');
        const totalSlides = dots.length;
        let currentSlide = 0;

        function showSlide(index) {
            carouselContainer.style.transform = `translateX(-${index * 100}%)`;
            dots.forEach(dot => dot.classList.remove('active'));
            dots[index].classList.add('active');
        }

        dots.forEach((dot, index) => {
            dot.addEventListener('click', () => {
                currentSlide = index;
                showSlide(currentSlide);
            });
        });

        function nextSlide() {
            currentSlide = (currentSlide + 1) % totalSlides;
            showSlide(currentSlide);
        }

        // Automatic sliding every 5 seconds
        setInterval(nextSlide, 5000);

        // Initial state
        showSlide(currentSlide);
    });
</script>
@endsection