@extends('layouts.admin')

@section('title', 'Tambah Produk')
@section('header_title', 'Tambah Produk Baru')

@section('content')
<div class="max-w-2xl bg-white rounded-xl shadow-lg border border-gray-100 p-8">
    @if(session('success'))
        <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-6 rounded shadow-sm" role="alert">
            <div class="flex">
                <div class="py-1"><svg class="fill-current h-6 w-6 text-green-500 mr-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M2.93 17.07A10 10 0 1 1 17.07 2.93 10 10 0 0 1 2.93 17.07zm12.73-1.41A8 8 0 1 0 4.34 4.34a8 8 0 0 0 11.32 11.32zM9 11V9h2v6H9v-4zm0-6h2v2H9V5z"/></svg></div>
                <div>
                    <p class="font-bold">Berhasil!</p>
                    <p class="text-sm">{{ session('success') }}</p>
                </div>
            </div>
        </div>
    @endif
    
    <form action="{{ route('product.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        
        {{-- 1. NAMA PRODUK --}}
        <div class="mb-5">
            <label class="block text-gray-700 font-semibold mb-2">Nama Produk</label>
            <input type="text" name="name" class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500" placeholder="Contoh: Box Makanan Large" required>
        </div>

        <div class="grid grid-cols-2 gap-4 mb-5">
            {{-- 2. KATEGORI (WAJIB DITAMBAHKAN) --}}
            <div>
                <label class="block text-gray-700 font-semibold mb-2">Kategori</label>
                <select name="category" class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500 bg-white">
                    <option value="Box Makanan">Box Makanan</option>
                    <option value="Box Gift">Box Gift</option>
                    <option value="Corrugated Box">Corrugated Box</option>
                    <option value="Paper Bag">Paper Bag</option>
                    <option value="Lainnya">Lainnya</option>
                </select>
            </div>

            {{-- 3. HARGA (Ganti name="price" jadi "price_min") --}}
            <div>
                <label class="block text-gray-700 font-semibold mb-2">Harga (Rp)</label>
                <input type="number" name="price_min" class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500" placeholder="15000" required>
            </div>
        </div>

        {{-- 4. STOK AWAL --}}
        <div class="mb-5">
            <label class="block text-gray-700 font-semibold mb-2">Stok Awal</label>
            <input type="number" name="stock" class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500" placeholder="100" required>
            <p class="text-xs text-gray-400 mt-1">*Jika stok > 0, status otomatis "Ready"</p>
        </div>

        {{-- 5. DESKRIPSI --}}
        <div class="mb-5">
            <label class="block text-gray-700 font-semibold mb-2">Deskripsi Produk</label>
            <textarea name="description" rows="3" class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500" placeholder="Deskripsi singkat..."></textarea>
        </div>

        {{-- 6. GAMBAR --}}
        <div class="mb-6">
            <label class="block text-gray-700 font-semibold mb-2">Gambar Produk</label>
            <input type="file" name="image" class="w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-green-50 file:text-green-700 hover:file:bg-green-100 transition"/>
        </div>

        <div class="flex gap-3">
            <button type="submit" class="bg-green-600 hover:bg-green-700 text-white font-bold py-2 px-6 rounded-lg shadow transition">Simpan Produk</button>
            {{-- Pastikan route 'product.index' sesuai dengan file route Anda --}}
            <a href="{{ route('products.index') }}" class="bg-gray-200 hover:bg-gray-300 text-gray-800 font-semibold py-2 px-6 rounded-lg transition">Batal</a>
        </div>
    </form>
</div>
@endsection