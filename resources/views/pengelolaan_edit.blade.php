@extends('layouts.app')
@section('title', 'Edit Produk')
@section('content')
<div class="max-w-xl mx-auto text-white">
    <h1 class="text-3xl font-bold mb-6">Edit Produk</h1>

    <form action="{{ route('pengelolaan.update', $product['id']) }}" method="POST" class="space-y-4">
        @csrf
        <div>
            <label class="block text-sm mb-1">Nama Produk</label>
            <input type="text" name="name" value="{{ $product['name'] }}" 
                   class="w-full p-2 bg-gray-900 border border-gray-700 rounded" required>
        </div>

        <div>
            <label class="block text-sm mb-1">Harga (Rp)</label>
            <input type="number" name="price" value="{{ $product['price'] }}"
                   class="w-full p-2 bg-gray-900 border border-gray-700 rounded" required>
        </div>

        <div>
            <label class="block text-sm mb-1">Stok</label>
            <input type="number" name="stock" value="{{ $product['stock'] }}"
                   class="w-full p-2 bg-gray-900 border border-gray-700 rounded" required>
        </div>

        <div>
            <label class="block text-sm mb-1">Kategori</label>
            <input type="text" name="category" value="{{ $product['category'] }}"
                   class="w-full p-2 bg-gray-900 border border-gray-700 rounded">
        </div>

        <div class="flex justify-end gap-3 pt-4">
            <a href="{{ route('pengelolaan') }}" class="px-4 py-2 bg-gray-700 rounded-lg">Batal</a>
            <button type="submit" class="px-4 py-2 bg-blue-600 hover:bg-blue-700 rounded-lg">Update</button>
        </div>
    </form>
</div>
@endsection
