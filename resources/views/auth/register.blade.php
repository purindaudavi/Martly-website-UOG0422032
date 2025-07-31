@extends('layouts.guest')

@section('content')
    {{-- THIS IS THE NEW CONTAINER - Replicating login.blade.php's structure --}}
    <div class="container mx-auto px-4 py-8 flex items-center justify-center">
        <div class="bg-white rounded-3xl shadow-xl flex w-full max-w-7xl min-h-[600px] overflow-hidden">

            {{-- Left Panel: Martly Lite Info (Dark Background) --}}
            <div class="w-full md:w-1/2 bg-gray-900 text-white flex flex-col justify-between p-8 md:p-12">
                <div>
                    <div class="flex items-center gap-2 text-2xl md:text-3xl font-extrabold mb-6">
                        {{-- Martly Lite Logo/Icon --}}
                        <svg class="w-7 h-7 text-green-400" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M12 2a10 10 0 00-3.16 19.45c.5.09.68-.22.68-.48v-1.71c-2.78.61-3.37-1.34-3.37-1.34-.45-1.15-1.11-1.45-1.11-1.45-.91-.63.07-.62.07-.62 1 .07 1.53 1.04 1.53 1.04.89 1.52 2.34 1.08 2.91.83.09-.65.35-1.08.63-1.33-2.22-.25-4.56-1.11-4.56-4.94 0-1.09.39-1.98 1.03-2.68-.1-.25-.45-1.26.1-2.63 0 0 .84-.27 2.75 1.02a9.52 9.52 0 015 0C17.1 5.7 17.94 5.97 17.94 5.97c.55 1.37.2 2.38.1 2.63.64.7 1.03 1.59 1.03 2.68 0 3.84-2.34 4.69-4.58 4.94.36.31.69.93.69 1.87v2.76c0 .27.18.58.69.48A10 10 0 0012 2z"/>
                        </svg>
                        Martly <span class="text-green-400">Lite</span>
                    </div>
                    <h3 class="text-xl md:text-2xl font-semibold mb-2">Register</h3> {{-- Changed from "Log In" to "Register" --}}
                    <p class="text-sm text-gray-300">Join us to explore a world of healthy groceries!</p> {{-- Custom message for register --}}
                </div>

                <div class="mt-10">
                    <p class="text-sm mb-2">Already have an account?</p> {{-- Changed text --}}
                    <a href="{{ route('login') }}" class="inline-block bg-green-500 hover:bg-green-600 transition text-white font-semibold rounded-full px-4 py-2">
                        Log In
                    </a>
                    <p class="text-xs text-gray-400 mt-6 leading-relaxed">
                        Need help? Contact us at <span class="text-green-400">0112303500</span><br> {{-- Changed text --}}
                        (Daily 8:00 a.m. – 8:00 p.m.)
                    </p>
                </div>
            </div>

            {{-- Right Panel: Registration Form (White Background) --}}
            <div class="w-full md:w-1/2 flex items-center justify-center bg-white p-6 sm:p-12">
                <div class="w-full max-w-md">
                    {{-- Manual display of validation errors, styled like login's status message --}}
                    @if ($errors->any())
                        <div class="mb-4 font-medium text-red-600">
                            {{ __('Whoops! Something went wrong.') }}
                        </div>

                        <ul class="mt-3 list-disc list-inside text-sm text-red-600">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    @endif

                    <form method="POST" action="{{ route('register') }}" class="space-y-6"> {{-- Changed action to register route --}}
                        @csrf

                        <div>
                            <label for="name" class="block text-sm font-medium text-gray-700">Name</label> {{-- Replaced x-input-label --}}
                            <input id="name" type="text" name="name" :value="old('name')" required autofocus autocomplete="name"
                                class="mt-1 block w-full px-4 py-2 border border-green-400 rounded-lg focus:ring-2 focus:ring-green-300 focus:outline-none" /> {{-- Replaced x-text-input and added styling --}}
                            {{-- <x-input-error :messages="$errors->get('name')" class="mt-2" /> --}} {{-- Keeping x-input-error for now, will remove if it errors --}}
                        </div>

                        <div> {{-- Removed mt-4, using space-y-6 on form --}}
                            <label for="email" class="block text-sm font-medium text-gray-700">Email</label> {{-- Replaced x-input-label --}}
                            <input id="email" type="email" name="email" :value="old('email')" required autocomplete="username"
                                class="mt-1 block w-full px-4 py-2 border border-green-400 rounded-lg focus:ring-2 focus:ring-green-300 focus:outline-none" /> {{-- Replaced x-text-input and added styling --}}
                            {{-- <x-input-error :messages="$errors->get('email')" class="mt-2" /> --}}
                        </div>

                        <div> {{-- Removed mt-4, using space-y-6 on form --}}
                            <label for="password" class="block text-sm font-medium text-gray-700">Password</label> {{-- Replaced x-input-label --}}
                            <input id="password" type="password" name="password" required autocomplete="new-password"
                                class="mt-1 block w-full px-4 py-2 border border-green-400 rounded-lg focus:ring-2 focus:ring-green-300 focus:outline-none" /> {{-- Replaced x-text-input and added styling --}}
                            {{-- <x-input-error :messages="$errors->get('password')" class="mt-2" /> --}}
                        </div>

                        <div> {{-- Removed mt-4, using space-y-6 on form --}}
                            <label for="password_confirmation" class="block text-sm font-medium text-gray-700">Confirm Password</label> {{-- Replaced x-input-label --}}
                            <input id="password_confirmation" type="password" name="password_confirmation" required autocomplete="new-password"
                                class="mt-1 block w-full px-4 py-2 border border-green-400 rounded-lg focus:ring-2 focus:ring-green-300 focus:outline-none" /> {{-- Replaced x-text-input and added styling --}}
                            {{-- <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" /> --}}
                        </div>

                        <div class="flex items-center justify-end mt-4">
                            <a class="text-sm text-green-600 hover:underline" href="{{ route('login') }}"> {{-- Styled like login's Forgot Password --}}
                                {{ __('Already registered?') }}
                            </a>

                            <button type="submit"
                                class="w-full bg-green-500 hover:bg-green-600 transition text-white font-bold py-2 px-4 rounded-full mt-4"> {{-- Styled like login's Log In button --}}
                                {{ __('Register') }}
                            </button>
                        </div>
                    </form>

                    {{-- Social Login - Optional, if you want to include it for register too --}}
                    {{-- <div class="mt-8 text-center text-sm text-gray-500">
                        or continue with
                    </div>

                    <div class="mt-4 flex justify-center gap-4">
                        <a href="#" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-full text-sm transition">Facebook</a>
                        <a href="#" class="bg-red-500 hover:bg-red-600 text-white px-4 py-2 rounded-full text-sm transition">Google</a>
                    </div> --}}
                </div>
            </div>
        </div>
    </div>
@endsection