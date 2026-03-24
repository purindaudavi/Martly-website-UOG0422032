@extends('layouts.guest')

@section('content')
  {{-- THIS IS THE NEW CONTAINER --}}
  <div class="container mx-auto px-4 py-8 flex items-center justify-center">
    <div class="bg-white rounded-3xl shadow-xl flex w-full max-w-7xl min-h-[600px] overflow-hidden">
    
    <div class="w-full md:w-1/2 bg-gray-900 text-white flex flex-col justify-between p-8 md:p-12">
      <div>
        <div class="flex items-center gap-2 text-2xl md:text-3xl font-extrabold mb-6">
          <svg class="w-7 h-7 text-green-400" fill="currentColor" viewBox="0 0 24 24">
            <path d="M12 2a10 10 0 00-3.16 19.45c.5.09.68-.22.68-.48v-1.71c-2.78.61-3.37-1.34-3.37-1.34-.45-1.15-1.11-1.45-1.11-1.45-.91-.63.07-.62.07-.62 1 .07 1.53 1.04 1.53 1.04.89 1.52 2.34 1.08 2.91.83.09-.65.35-1.08.63-1.33-2.22-.25-4.56-1.11-4.56-4.94 0-1.09.39-1.98 1.03-2.68-.1-.25-.45-1.26.1-2.63 0 0 .84-.27 2.75 1.02a9.52 9.52 0 015 0C17.1 5.7 17.94 5.97 17.94 5.97c.55 1.37.2 2.38.1 2.63.64.7 1.03 1.59 1.03 2.68 0 3.84-2.34 4.69-4.58 4.94.36.31.69.93.69 1.87v2.76c0 .27.18.58.69.48A10 10 0 0012 2z"/>
          </svg>
          Martly <span class="text-green-400">Lite</span>
        </div>
        <h3 class="text-xl md:text-2xl font-semibold mb-2">Log In</h3>
        <p class="text-sm text-gray-300">Shopped with us before? Log in below</p>
      </div>

      <div class="mt-10">
        <p class="text-sm mb-2">New here?</p>
        <a href="{{ route('register') }}" class="inline-block bg-green-500 hover:bg-green-600 transition text-white font-semibold rounded-full px-4 py-2">
          Create your account
        </a>
        <p class="text-xs text-gray-400 mt-6 leading-relaxed">
          Trouble logging in? Call us at <span class="text-green-400">0112303500</span><br>
          (Daily 8:00 a.m. – 8:00 p.m.)
        </p>
      </div>
    </div>

    <div class="w-full md:w-1/2 flex items-center justify-center bg-white p-6 sm:p-12">
      <div class="w-full max-w-md">
        <x-auth-session-status class="mb-4" :status="session('status')" />

        <form method="POST" action="{{ route('login') }}" class="space-y-6">
          @csrf

          <div>
            <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
            <input id="email" type="email" name="email" :value="old('email')" required autofocus autocomplete="username"
              class="mt-1 block w-full px-4 py-2 border border-green-400 rounded-lg focus:ring-2 focus:ring-green-300 focus:outline-none"
              placeholder="your@email.com" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
          </div>

          <div>
            <label for="password" class="block text-sm font-medium text-gray-700">Password</label>
            <input id="password" type="password" name="password" required autocomplete="current-password"
              class="mt-1 block w-full px-4 py-2 border border-green-400 rounded-lg focus:ring-2 focus:ring-green-300 focus:outline-none"
              placeholder="••••••••" />
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
            <div class="text-right mt-2">
              <a href="{{ route('password.request') }}" class="text-sm text-green-600 hover:underline">
                Forgot Password?
              </a>
            </div>
          </div>

          <div>
            <button type="submit"
              class="w-full bg-green-500 hover:bg-green-600 transition text-white font-bold py-2 px-4 rounded-full">
              Log In
            </button>
          </div>
        </form>

        <div class="mt-8 text-center text-sm text-gray-500">
          or continue with
        </div>

        <div class="mt-4 flex justify-center gap-4">
          <a href="#" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-full text-sm transition">Facebook</a>
          <a href="#" class="bg-red-500 hover:bg-red-600 text-white px-4 py-2 rounded-full text-sm transition">Google</a>
        </div>
      </div>
    </div>
  </div>
@endsection