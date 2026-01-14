@extends('layouts.app')
@section('title', 'Tambah Produk Baru')

@section('content')
<div class="max-w-4xl mx-auto px-4 py-12 mt-20">
    <div class="bg-white p-8 rounded-lg shadow-lg">
        <h2 class="text-2xl font-bold text-gray-800 mb-6">Tambah Produk Baru</h2>

        <form action="{{ route('product.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="mb-4">
                <label class="block text-gray-700 font-bold mb-2">Nama Produk</label>
                <input type="text" name="name" class="w-full border p-2 rounded" required placeholder="Contoh: Box Pizza Premium">
            </div>

            <div class="mb-4">
                <label class="block text-gray-700 font-bold mb-2">Kategori (Label)</label>
                <input type="text" name="category" class="w-full border p-2 rounded" required placeholder="Contoh: Food Grade / Shipping">
            </div>

            <div class="mb-4">
                <label class="block text-gray-700 font-bold mb-2">Harga Mulai (Rp)</label>
                <input type="number" name="price_min" class="w-full border p-2 rounded" required placeholder="1500">
            </div>

            <div class="mb-4">
                <label class="block text-gray-700 font-bold mb-2">Deskripsi Singkat</label>
                <textarea name="description" class="w-full border p-2 rounded" rows="3"></textarea>
            </div>

            <div class="mb-6">
                <label class="block text-gray-700 font-bold mb-2">Foto Produk</label>
                <input type="file" name="image" class="w-full border p-2 rounded" required>
                <p class="text-sm text-gray-500 mt-1">*Format: JPG/PNG, Maks 2MB</p>
            </div>

            <button type="submit" class="bg-blue-900 text-white px-6 py-2 rounded font-bold hover:bg-blue-800 transition">
                + Simpan Produk
            </button>
        </form>
    </div>
</div>
@endsection