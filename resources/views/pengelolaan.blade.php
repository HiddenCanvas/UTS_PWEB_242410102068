@extends('layouts.app')
@section('title', 'Pengelolaan Produk')
@section('content')

<div class="container mx-auto max-w-7xl text-white">
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-4xl font-bold">Manajemen Produk</h1>
        <a href="{{ route('pengelolaan.create') }}" 
           class="bg-blue-600 hover:bg-blue-700 px-4 py-2 rounded-lg text-white font-medium">
           + Tambah Produk
        </a>
    </div>

    {{-- ALERT --}}
    @if(session('success'))
        <div class="bg-green-600/20 text-green-400 p-3 rounded-lg mb-4">{{ session('success') }}</div>
    @endif
    @if(session('error'))
        <div class="bg-red-600/20 text-red-400 p-3 rounded-lg mb-4">{{ session('error') }}</div>
    @endif

    {{-- SEARCH & FILTER --}}
    <form method="GET" action="{{ route('pengelolaan') }}" class="grid md:grid-cols-4 gap-4 mb-6">
        <input type="text" name="search" placeholder="Cari produk..."
               value="{{ $search }}" class="col-span-2 bg-gray-900 border border-gray-700 text-white rounded-lg p-2">

        <select name="category" class="bg-gray-900 border border-gray-700 text-white rounded-lg p-2">
            <option value="">Semua Kategori</option>
            @foreach($categories as $cat)
                <option value="{{ $cat }}" {{ $filterCategory === $cat ? 'selected' : '' }}>
                    {{ $cat }}
                </option>
            @endforeach
        </select>

        <select name="stock_status" class="bg-gray-900 border border-gray-700 text-white rounded-lg p-2">
            <option value="">Semua Stok</option>
            <option value="low" {{ $filterStock === 'low' ? 'selected' : '' }}>Stok Rendah (≤5)</option>
            <option value="available" {{ $filterStock === 'available' ? 'selected' : '' }}>Stok Cukup</option>
        </select>

        <button type="submit" class="md:col-span-4 bg-blue-600 hover:bg-blue-700 rounded-lg py-2">Terapkan</button>
    </form>

    {{-- SORT LINK --}}
    <div class="flex justify-end mb-3 text-sm text-gray-300">
        <span class="mr-2">Urutkan:</span>
        <a href="{{ route('pengelolaan', array_merge(request()->query(), ['sort_by' => 'name', 'sort_order' => $sortOrder === 'asc' ? 'desc' : 'asc'])) }}" 
           class="px-2 py-1 bg-gray-800 hover:bg-gray-700 rounded-md {{ $sortBy === 'name' ? 'text-blue-400' : '' }}">Nama</a>
        <a href="{{ route('pengelolaan', array_merge(request()->query(), ['sort_by' => 'price', 'sort_order' => $sortOrder === 'asc' ? 'desc' : 'asc'])) }}" 
           class="ml-2 px-2 py-1 bg-gray-800 hover:bg-gray-700 rounded-md {{ $sortBy === 'price' ? 'text-blue-400' : '' }}">Harga</a>
        <a href="{{ route('pengelolaan', array_merge(request()->query(), ['sort_by' => 'stock', 'sort_order' => $sortOrder === 'asc' ? 'desc' : 'asc'])) }}" 
           class="ml-2 px-2 py-1 bg-gray-800 hover:bg-gray-700 rounded-md {{ $sortBy === 'stock' ? 'text-blue-400' : '' }}">Stok</a>
    </div>

    {{-- TABEL PRODUK --}}
    <div class="overflow-x-auto bg-gray-900 rounded-lg shadow border border-gray-800">
        <table class="min-w-full text-sm text-left">
            <thead class="bg-gray-800 text-gray-300 uppercase text-xs">
                <tr>
                    <th class="px-4 py-3">#</th>
                    <th class="px-4 py-3">Nama</th>
                    <th class="px-4 py-3">Kategori</th>
                    <th class="px-4 py-3 text-right">Harga</th>
                    <th class="px-4 py-3 text-center">Stok</th>
                    <th class="px-4 py-3 text-center">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($products as $p)
                <tr class="border-t border-gray-800 hover:bg-gray-800/60">
                    <td class="px-4 py-3">{{ $p['id'] }}</td>
                    <td class="px-4 py-3">{{ $p['name'] }}</td>
                    <td class="px-4 py-3">{{ $p['category'] }}</td>
                    <td class="px-4 py-3 text-right">Rp {{ number_format($p['price'], 0, ',', '.') }}</td>
                    <td class="px-4 py-3 text-center {{ $p['stock'] <= 5 ? 'text-red-400' : 'text-green-400' }}">
                        {{ $p['stock'] }}
                    </td>
                    <td class="px-4 py-3 text-center space-x-2">
                        <a href="{{ route('pengelolaan.edit', $p['id']) }}"  class="bg-blue-500 hover:bg-blue-600 text-white px-3 py-1 rounded-md text-xs">Edit</a>
                        <form action="{{ route('pengelolaan.destroy', $p['id']) }}" method="POST" class="inline">
                            @csrf
                            <button type="submit" onclick="return confirm('Hapus {{ $p['name'] }}?')"
                                class="bg-red-500 hover:bg-red-600 text-white px-3 py-1 rounded-md text-xs">
                                Hapus
                            </button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" class="text-center py-6 text-gray-400">Tidak ada produk ditemukan.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
