@extends('layouts.app')

@section('title', 'Tambah Produk')

@push('styles')
<style>
    .form-container {
        max-width: 600px;
        margin: 4rem auto;
        background: linear-gradient(135deg, rgba(0,77,64,0.95), rgba(0,150,136,0.95));
        padding: 2rem;
        border-radius: 1rem;
        box-shadow: 0 8px 30px rgba(0, 77, 64, 0.4);
        color: #fff;
    }

    .form-container h2 {
        text-align: center;
        margin-bottom: 1.5rem;
        font-weight: 700;
        text-shadow: 0 2px 10px rgba(129,199,132,0.5);
    }

    .form-group {
        margin-bottom: 1rem;
    }

    .form-group label {
        font-weight: 600;
        margin-bottom: 0.5rem;
        display: block;
    }

    .form-control {
        width: 100%;
        padding: 0.7rem 1rem;
        border-radius: 8px;
        border: 1px solid rgba(129,199,132,0.3);
        background: rgba(255,255,255,0.1);
        color: #fff;
        outline: none;
    }

    .form-control:focus {
        border-color: #81C784;
        box-shadow: 0 0 10px rgba(129,199,132,0.5);
    }

    .btn-submit {
        width: 100%;
        padding: 0.8rem;
        border: none;
        border-radius: 10px;
        background: linear-gradient(135deg, #81C784, #4CAF50);
        color: white;
        font-weight: 700;
        cursor: pointer;
        transition: 0.3s;
        box-shadow: 0 5px 15px rgba(129,199,132,0.3);
    }

    .btn-submit:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 25px rgba(129,199,132,0.5);
    }
</style>
@endpush

@section('content')
<div class="form-container">
    <h2>Tambah Produk Baru</h2>
    <form action="{{ route('pengelolaan.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="name">Nama Produk</label>
            <input type="text" id="name" name="name" class="form-control" placeholder="Masukkan nama produk" required>
        </div>
        <div class="form-group">
            <label for="price">Harga (Rp)</label>
            <input type="number" id="price" name="price" class="form-control" placeholder="Masukkan harga produk" required>
        </div>
        <div class="form-group">
            <label for="stock">Stok</label>
            <input type="number" id="stock" name="stock" class="form-control" placeholder="Masukkan jumlah stok" required>
        </div>
        <button type="submit" class="btn-submit">Simpan Produk</button>
    </form>
</div>
@endsection
