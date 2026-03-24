<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('page_title', 'Vendor Dashboard')</title>
    @vite('resources/css/app.css')

    <style>
        #sidebar-header-container {
            height: 0;
            overflow: hidden;
            transition: height 300ms ease-in-out, opacity 300ms ease-in-out;
            opacity: 0;
            margin-bottom: 0;
        }
        #sidebar.sidebar-expanded #sidebar-header-container {
            height: 2.5rem; /* Sufficient height for the h1 text */
            opacity: 1;
            margin-bottom: 0;
        }
    </style>
</head>
<body class="bg-gray-100 font-sans leading-normal tracking-normal">

    <div class="flex h-screen">

        <aside id="sidebar" class="w-20 bg-gray-900 text-gray-200 p-4 flex flex-col h-full shadow-lg transition-all duration-300 ease-in-out hover:w-64">
            <div id="sidebar-header-container" class="flex items-center justify-center">
                <div id="sidebar-header" class="text-2xl font-bold text-white whitespace-nowrap">Vendor Panel</div>
            </div>
            <nav class="flex-1">
                <ul class="space-y-2">
                    <li>
                        <a href="{{ route('welcome') }}" class="flex items-center space-x-3 px-4 py-2 rounded-lg transition-colors duration-200 
                            {{ request()->routeIs('welcome') ? 'bg-indigo-600 text-white shadow' : 'text-gray-300 hover:bg-gray-800 hover:text-white' }}">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 flex-shrink-0" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path><polyline points="9 22 9 12 15 12 15 22"></polyline></svg>
                            <span class="ml-3 opacity-0 transition-opacity duration-300 whitespace-nowrap">Home</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('vendor.dashboard') }}" class="flex items-center space-x-3 px-4 py-2 rounded-lg transition-colors duration-200
                            {{ request()->routeIs('vendor.dashboard') ? 'bg-indigo-600 text-white shadow' : 'text-gray-300 hover:bg-gray-800 hover:text-white' }}">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 flex-shrink-0" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="3" width="7" height="9"></rect><rect x="14" y="3" width="7" height="5"></rect><rect x="14" y="12" width="7" height="9"></rect><rect x="3" y="16" width="7" height="5"></rect></svg>
                            <span class="ml-3 opacity-0 transition-opacity duration-300 whitespace-nowrap">Dashboard</span>
                        </a>
                    </li>
                    <li class="has-submenu">
                        <div class="flex items-center justify-between">
                            <a href="{{ route('vendor.products') }}" class="flex-1 flex items-center space-x-3 px-4 py-2 rounded-lg transition-colors duration-200 text-gray-300 hover:bg-gray-800 hover:text-white">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 flex-shrink-0" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M6 2L3 6v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V6l-3-4z"></path><line x1="3" y1="6" x2="21" y2="6"></line><path d="M16 10a4 4 0 0 1-8 0"></path></svg>
                                <span class="ml-3 opacity-0 transition-opacity duration-300 whitespace-nowrap">My Products</span>
                            </a>
                            <button id="products-toggle" class="flex-shrink-0 p-1 rounded-lg hover:bg-gray-800 focus:outline-none">
                                <svg id="products-toggle-icon" class="h-4 w-4 transform transition-transform duration-200" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
                            </button>
                        </div>
                        <ul id="products-submenu" class="ml-4 mt-2 space-y-2 hidden">
                            <li><a href="{{ route('vendor.products.create') }}" class="flex items-center space-x-3 px-4 py-2 rounded-lg transition-colors duration-200 hover:bg-gray-800 {{ request()->routeIs('vendor.products.create') ? 'bg-indigo-600 text-white shadow' : 'text-gray-300' }}">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path></svg>
                                <span class="ml-3 opacity-0 transition-opacity duration-300 whitespace-nowrap">Add New Product</span>
                            </a></li>
                        </ul>
                    </li>
                    <li>
                        <a href="{{ route('vendor.sales') }}" class="flex items-center space-x-3 px-4 py-2 rounded-lg transition-colors duration-200
                            {{ request()->routeIs('vendor.sales') ? 'bg-indigo-600 text-white shadow' : 'text-gray-300 hover:bg-gray-800 hover:text-white' }}">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 flex-shrink-0" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M18 20a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2V4a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v12l4-4v12a2 2 0 0 1-2 2zM8 12V6M12 16V6M16 12V6"></path></svg>
                            <span class="ml-3 opacity-0 transition-opacity duration-300 whitespace-nowrap">My Sales</span>
                        </a>
                    </li>
                </ul>
            </nav>
        </aside>

        <main id="main-content" class="flex-grow p-8 overflow-y-auto ml-20 transition-all duration-300 ease-in-out">
            <header class="bg-white shadow-md p-6 mb-8 rounded-xl w-full">
                <h1 class="text-2xl font-bold text-gray-800">@yield('page_title', 'Dashboard')</h1>
            </header>
            
            @yield('content')
        </main>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const sidebar = document.getElementById('sidebar');
            const mainContent = document.getElementById('main-content');
            const sidebarHeader = document.getElementById('sidebar-header');
            const navSpans = document.querySelectorAll('#sidebar nav span');
            
            const productsToggle = document.getElementById('products-toggle');
            const productsSubmenu = document.getElementById('products-submenu');
            const productsToggleIcon = document.getElementById('products-toggle-icon');

            sidebar.addEventListener('mouseenter', () => {
                sidebar.classList.add('sidebar-expanded');
                mainContent.classList.remove('ml-20');
                mainContent.classList.add('ml-64');
                sidebarHeader.classList.remove('opacity-0');
                sidebarHeader.classList.add('opacity-100');
                navSpans.forEach(span => {
                    span.classList.remove('opacity-0');
                    span.classList.add('opacity-100');
                });
            });

            sidebar.addEventListener('mouseleave', () => {
                navSpans.forEach(span => {
                    span.classList.remove('opacity-100');
                    span.classList.add('opacity-0');
                });
                sidebarHeader.classList.remove('opacity-100');
                sidebarHeader.classList.add('opacity-0');
                sidebar.classList.remove('sidebar-expanded');
                mainContent.classList.remove('ml-64');
                mainContent.classList.add('ml-20');
            });

            productsToggle.addEventListener('click', () => {
                productsSubmenu.classList.toggle('hidden');
                productsToggleIcon.classList.toggle('rotate-180');
            });
            
            const isActive = productsSubmenu.querySelector('.bg-indigo-600');
            if (isActive) {
                productsSubmenu.classList.remove('hidden');
                productsToggleIcon.classList.add('rotate-180');
            }
        });
    </script>
</body>
</html>