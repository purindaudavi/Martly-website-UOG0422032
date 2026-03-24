<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('page_title', 'Admin Dashboard')</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    @vite('resources/css/app.css')
</head>
<body class="bg-gray-100 font-sans leading-normal tracking-normal">

    <div class="flex h-screen">

        {{-- UPGRADE! Sidebar now starts shrunken and handles text visibility --}}
        <aside id="sidebar" class="w-20 bg-gray-900 text-gray-200 p-4 flex flex-col h-full shadow-lg transition-all duration-300 ease-in-out hover:w-64">
            {{-- CORRECTED! Fixed height and overflow to prevent layout jump --}}
            <div id="sidebar-header-container" class="h-10 overflow-hidden transition-all duration-300 mb-6 flex items-center justify-center">
                <div id="sidebar-header" class="text-2xl font-bold text-white whitespace-nowrap opacity-0 transition-opacity duration-300">Admin Panel</div>
            </div>
            <nav class="flex-1">
                <ul class="space-y-2">
                    {{-- Nav Links with new styling and active state --}}
                    <li>
                        <a href="{{ route('welcome') }}" class="flex items-center space-x-3 px-4 py-2 rounded-lg transition-colors duration-200 
                            {{ request()->routeIs('welcome') ? 'bg-indigo-600 text-white shadow' : 'text-gray-300 hover:bg-gray-800 hover:text-white' }}">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 flex-shrink-0" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path><polyline points="9 22 9 12 15 12 15 22"></polyline></svg>
                            <span class="ml-3 opacity-0 transition-opacity duration-300 whitespace-nowrap">Home</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('admin.dashboard') }}" class="flex items-center space-x-3 px-4 py-2 rounded-lg transition-colors duration-200
                            {{ request()->routeIs('admin.dashboard') ? 'bg-indigo-600 text-white shadow' : 'text-gray-300 hover:bg-gray-800 hover:text-white' }}">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 flex-shrink-0" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="3" width="7" height="9"></rect><rect x="14" y="3" width="7" height="5"></rect><rect x="14" y="12" width="7" height="9"></rect><rect x="3" y="16" width="7" height="5"></rect></svg>
                            <span class="ml-3 opacity-0 transition-opacity duration-300 whitespace-nowrap">Dashboard</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('admin.products') }}" class="flex items-center space-x-3 px-4 py-2 rounded-lg transition-colors duration-200
                            {{ request()->routeIs('admin.products') ? 'bg-indigo-600 text-white shadow' : 'text-gray-300 hover:bg-gray-800 hover:text-white' }}">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 flex-shrink-0" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M16 4h2a2 2 0 0 1 2 2v14a2 2 0 0 1-2 2H6a2 2 0 0 1-2-2V6a2 2 0 0 1 2-2h2"></path><path d="M15 2H9a1 1 0 0 0-1 1v2a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V3a1 1 0 0 0-1-1z"></path></svg>
                            <span class="ml-3 opacity-0 transition-opacity duration-300 whitespace-nowrap">Products</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('admin.users') }}" class="flex items-center space-x-3 px-4 py-2 rounded-lg transition-colors duration-200
                            {{ request()->routeIs('admin.users') ? 'bg-indigo-600 text-white shadow' : 'text-gray-300 hover:bg-gray-800 hover:text-white' }}">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 flex-shrink-0" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path><circle cx="9" cy="7" r="4"></circle><path d="M23 21v-2a4 4 0 0 0-3-3.87m-4-12a4 4 0 0 1 0 7.75"></path></svg>
                            <span class="ml-3 opacity-0 transition-opacity duration-300 whitespace-nowrap">Users</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('admin.orders.index') }}" class="flex items-center space-x-3 px-4 py-2 rounded-lg transition-colors duration-200
                            {{ request()->routeIs('admin.orders.index') ? 'bg-indigo-600 text-white shadow' : 'text-gray-300 hover:bg-gray-800 hover:text-white' }}">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 flex-shrink-0" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M6 2L3 6v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V6l-3-4z"></path><line x1="3" y1="6" x2="21" y2="6"></line><path d="M16 10a4 4 0 0 1-8 0"></path></svg>
                            <span class="ml-3 opacity-0 transition-opacity duration-300 whitespace-nowrap">Orders</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('admin.deals') }}" class="flex items-center space-x-3 px-4 py-2 rounded-lg transition-colors duration-200
                            {{ request()->routeIs('admin.deals') ? 'bg-indigo-600 text-white shadow' : 'text-gray-300 hover:bg-gray-800 hover:text-white' }}">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 flex-shrink-0" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polygon points="13 2 3 14 12 14 11 22 21 10 12 10 13 2"></polygon></svg>
                            <span class="ml-3 opacity-0 transition-opacity duration-300 whitespace-nowrap">Deals</span>
                        </a>
                    </li>
                </ul>
            </nav>
        </aside>

        <main id="main-content" class="flex-grow p-8 overflow-y-auto ml-20 transition-all duration-300 ease-in-out">
            <header class="bg-white shadow-md p-6 mb-8 rounded-xl w-full">
                <h1 class="text-2xl font-bold text-gray-800">@yield('page_title', 'Dashboard')</h1>
            </header>
            
            @if (session('success'))
                <div class="bg-green-500 text-white px-4 py-3 rounded-lg mb-6 shadow-md" role="alert">
                    <p class="font-bold">Success!</p>
                    <p class="text-sm">{{ session('success') }}</p>
                </div>
            @endif

            @yield('content')
        </main>
    </div>

    {{-- ZAP! The new JavaScript that handles the hover effect --}}
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const sidebar = document.getElementById('sidebar');
            const mainContent = document.getElementById('main-content');
            const sidebarHeader = document.getElementById('sidebar-header');
            const navSpans = document.querySelectorAll('#sidebar nav span');

            sidebar.addEventListener('mouseenter', () => {
                // Change the sidebar and content widths
                sidebar.classList.remove('w-20');
                mainContent.classList.remove('ml-20');
                sidebar.classList.add('w-64');
                mainContent.classList.add('ml-64');

                // Show the header
                sidebarHeader.classList.remove('opacity-0');
                sidebarHeader.classList.add('opacity-100');

                // Show the navigation text labels
                navSpans.forEach(span => {
                    span.classList.remove('opacity-0');
                    span.classList.add('opacity-100');
                });
            });

            sidebar.addEventListener('mouseleave', () => {
                // Hide the navigation text labels
                navSpans.forEach(span => {
                    span.classList.remove('opacity-100');
                    span.classList.add('opacity-0');
                });
                
                // Hide the header
                sidebarHeader.classList.remove('opacity-100');
                sidebarHeader.classList.add('opacity-0');

                // Change the sidebar and content widths back
                sidebar.classList.remove('w-64');
                mainContent.classList.remove('ml-64');
                sidebar.classList.add('w-20');
                mainContent.classList.add('ml-20');
            });
        });
    </script>
</body>
</html>