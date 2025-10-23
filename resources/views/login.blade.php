@extends('layouts.app')
@section('title', 'Login')
@section('content')
<div class="flex items-center justify-center min-h-[70vh] text-white">
    <div class="bg-gray-900 border border-gray-800 rounded-xl p-8 w-full max-w-md shadow-lg">
        <h1 class="text-3xl font-bold mb-6 text-center">Login to Elixir Of Life</h1>

        {{-- Alert jika ada error validasi --}}
        @if($errors->any())
            <div class="bg-red-500/20 text-red-400 p-3 rounded-lg mb-4">
                <ul class="list-disc list-inside text-sm">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="POST" action="{{ route('login') }}" class="space-y-5">
            @csrf

            {{-- Username --}}
            <div>
                <label class="block text-sm mb-1">Username</label>
                <input type="text" name="username" value="{{ old('username') }}" required
                       class="w-full p-2 bg-gray-800 border border-gray-700 rounded focus:ring-2 focus:ring-blue-500 focus:outline-none">
            </div>

            {{-- Password --}}
            <div>
                <label class="block text-sm mb-1">Password</label>
                <input type="password" name="password" required
                       class="w-full p-2 bg-gray-800 border border-gray-700 rounded focus:ring-2 focus:ring-blue-500 focus:outline-none">
            </div>

            {{-- Remember Me (opsional) --}}
            <div class="flex items-center justify-between text-sm">
                <label class="flex items-center gap-2">
                    <input type="checkbox" name="remember" class="rounded bg-gray-800 border-gray-600">
                    <span>Remember Me</span>
                </label>
                <a href="#" class="text-blue-400 hover:underline">Forgot Password?</a>
            </div>

            {{-- Tombol Submit --}}
            <button type="submit" class="w-full bg-blue-600 hover:bg-blue-700 p-2 rounded-lg font-semibold">
                Login
            </button>
        </form>

        {{-- Optional: link ke dashboard tanpa login --}}
        <p class="mt-6 text-center text-sm text-gray-400">
            Belum punya akun? <a href="{{ route('dashboard') }}" class="text-blue-400 hover:underline">Masuk sebagai tamu</a>
        </p>
    </div>
</div>
@endsection
