{{-- resources/views/auth/testing.blade.php --}}

@extends('layouts.guest')

@section('content')
{{-- The entire content block from your original HTML, should start IMMEDIATELY after @extends --}}
<div class="bg-white rounded-3xl shadow-xl flex w-full max-w-7xl min-h-[600px] overflow-hidden">
    <div class="w-[40%] bg-gray-800 text-white p-10 flex flex-col justify-between">
        <div>
            <h2 class="text-3xl font-bold mb-4">Martly Lite</h2>
            <h3 class="text-xl font-semibold">Log In</h3>
            <p class="text-sm mt-2">Shopped with us before? Log in with your details</p>
        </div>
        <div>
            <p class="text-sm">New member?</p>
            <a href="{{ route('register') }}" class="inline-block bg-green-500 text-white font-semibold rounded-full px-4 py-2 mt-2 hover:bg-green-600 transition">Click here to register</a>
            <p class="text-xs mt-6">Have trouble logging in? Call us on <span class="text-green-400">0112303500</span><br>(Daily operating hours 8.00a.m to 8.00p.m)</p>
        </div>
    </div>

    <div class="w-[60%] p-14 flex items-center justify-center">
        <div class="w-full max-w-md">
            @if (session('status'))
                <div class="mb-4 text-sm text-green-600">
                    {{ session('status') }}
                </div>
            @endif

            <form method="POST" action="{{ route('login') }}">
                @csrf

                <div>
                    <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                    <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus autocomplete="username"
                        class="mt-1 block w-full px-4 py-2 border border-green-400 rounded-lg focus:ring focus:ring-green-300" placeholder="Email" />
                    @error('email')
                        <div class="mt-2 text-sm text-red-600">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mt-4">
                    <label for="password" class="block text-sm font-medium text-gray-700">Password</label>
                    <input id="password" type="password" name="password" required autocomplete="current-password"
                        class="mt-1 block w-full px-4 py-2 border rounded-lg focus:ring focus:ring-green-300" placeholder="Password" />
                    @error('password')
                        <div class="mt-2 text-sm text-red-600">{{ $message }}</div>
                    @enderror
                    <div class="text-right mt-2">
                        <a class="text-sm text-green-500 hover:underline" href="{{ route('password.request') }}">
                            Forgot Password?
                        </a>
                    </div>
                </div>

                <div class="mt-6">
                    <button type="submit"
                        class="w-full bg-green-500 hover:bg-green-600 text-white font-bold py-2 px-4 rounded-full transition">
                        Log In
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection