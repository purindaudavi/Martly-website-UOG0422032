<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    
    {{-- We've set the body to be a simple white background --}}
    <body class="font-sans antialiased bg-white">   
    @include('layouts.navigation')
        <div class="min-h-screen">
            {{-- Your content from dashboard.blade.php will be placed here --}}
            @yield('content')
        </div>
    </body>
</html>