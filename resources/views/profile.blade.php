{{-- resources/views/profile.blade.php --}}

@extends('layouts.app')

@section('title', 'Profile')

@section('content')

<div class="max-w-4xl mx-auto mt-8">
    
    {{-- Header --}}
    <div class="text-center mb-8">
        <h1 class="text-4xl font-bold mb-2" style="color: #00ff00;">
            💀 User Profile
        </h1>
        <p class="text-gray-400">
            Informasi akun Elixir Of Life
        </p>
    </div>
    
    @if($username)
        
        {{-- Profile Card --}}
        <div class="bg-gray-800 border-2 border-green-500 rounded-lg p-8 mb-6">
            
            {{-- Avatar --}}
            <div class="flex items-center gap-6 mb-6">
                <div class="w-24 h-24 bg-green-500 rounded-full flex items-center justify-center text-4xl">
                    💀
                </div>
                <div>
                    <h2 class="text-3xl font-bold text-white mb-1">
                        {{ $username }}
                    </h2>
                    <p class="text-gray-400">
                        Member sejak {{ now()->format('F Y') }}
                    </p>
                </div>
            </div>
            
            {{-- Info Grid --}}
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mt-6">
                
                <div class="bg-gray-900 p-4 rounded">
                    <div class="text-gray-400 text-sm mb-1">Username</div>
                    <div class="text-white font-bold text-lg">{{ $username }}</div>
                </div>
                
                <div class="bg-gray-900 p-4 rounded">
                    <div class="text-gray-400 text-sm mb-1">Status</div>
                    <div class="text-green-500 font-bold text-lg">✅ Active</div>
                </div>
                
                <div class="bg-gray-900 p-4 rounded">
                    <div class="text-gray-400 text-sm mb-1">Total Produk Tersedia</div>
                    <div class="text-white font-bold text-lg">{{ $totalProducts }} produk</div>
                </div>
                
                <div class="bg-gray-900 p-4 rounded">
                    <div class="text-gray-400 text-sm mb-1">Level</div>
                    <div class="text-yellow-500 font-bold text-lg">⭐ Death Warrior</div>
                </div>
                
            </div>
            
        </div>
        
        {{-- Quick Actions --}}
        <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-6">
            
            <a href="{{ route('dashboard', ['username' => $username]) }}" 
               class="bg-gray-800 border border-green-500 p-6 rounded-lg text-center hover:bg-gray-700 transition-all">
                <div class="text-3xl mb-2">🏠</div>
                <div class="text-white font-bold">Dashboard</div>
                <p class="text-gray-400 text-sm mt-1">Kembali ke beranda</p>
            </a>
            
            <a href="{{ route('pengelolaan', ['username' => $username]) }}" 
               class="bg-gray-800 border border-green-500 p-6 rounded-lg text-center hover:bg-gray-700 transition-all">
                <div class="text-3xl mb-2">📦</div>
                <div class="text-white font-bold">Pengelolaan</div>
                <p class="text-gray-400 text-sm mt-1">Kelola produk</p>
            </a>
            
            <a href="{{ route('logout') }}" 
               class="bg-gray-800 border border-red-500 p-6 rounded-lg text-center hover:bg-gray-700 transition-all">
                <div class="text-3xl mb-2">🚪</div>
                <div class="text-red-500 font-bold">Logout</div>
                <p class="text-gray-400 text-sm mt-1">Keluar dari akun</p>
            </a>
            
        </div>
        
        {{-- Account Stats --}}
        <div class="bg-gray-800 border-2 border-green-500 rounded-lg p-6">
            <h3 class="text-xl font-bold mb-4" style="color: #00ff00;">
                📊 Statistics
            </h3>
            
            <div class="space-y-3">
                <div class="flex justify-between items-center">
                    <span class="text-gray-400">Produk Tersedia</span>
                    <span class="text-white font-bold">{{ $totalProducts }} items</span>
                </div>
                <div class="flex justify-between items-center">
                    <span class="text-gray-400">Login Terakhir</span>
                    <span class="text-white font-bold">{{ now()->format('d M Y, H:i') }}</span>
                </div>
                <div class="flex justify-between items-center">
                    <span class="text-gray-400">Account Type</span>
                    <span class="text-green-500 font-bold">Premium 💎</span>
                </div>
            </div>
        </div>
        
    @else
        
        {{-- Not Logged In State --}}
        <div class="bg-gray-800 border-2 border-red-500 rounded-lg p-12 text-center">
            <div class="text-6xl mb-4">⚠️</div>
            <h2 class="text-2xl font-bold text-white mb-4">
                Kamu Belum Login!
            </h2>
            <p class="text-gray-400 mb-6">
                Silakan login terlebih dahulu untuk melihat profile.
            </p>
            <a href="{{ route('login') }}" 
               class="bg-green-500 text-black font-bold px-8 py-