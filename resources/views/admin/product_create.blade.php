@extends('layouts.admin')

@section('title', 'Tambah Produk')
@section('header_title', 'Tambah Produk Baru')

@section('content')
<div class="max-w-2xl bg-white rounded-xl shadow-lg border border-gray-100 p-8">
    
    <form action="{{ route('product.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        
        <div class="mb-5">
            <label class="block text-gray-700 font-semibold mb-2">Nama Produk</label>
            <input type="text" name="name" class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500" placeholder="Contoh: Box Makanan Large" required>
        </div>

        <div class="grid grid-cols-2 gap-4 mb-5">
            <div>
                <label class="block text-gray-700 font-semibold mb-2">Harga (Rp)</label>
                <input type="number" name="price" class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500" placeholder="15000" required>
            </div>
            <div>
                <label class="block text-gray-700 font-semibold mb-2">Stok Awal</label>
                <input type="number" name="stock" class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500" placeholder="100" required>
            </div>
        </div>

        <div class="mb-5">
            <label class="block text-gray-700 font-semibold mb-2">Deskripsi Produk</label>
            <textarea name="description" rows="3" class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500" placeholder="Deskripsi singkat..."></textarea>
        </div>

        <div class="mb-6">
            <label class="block text-gray-700 font-semibold mb-2">Gambar Produk</label>
            <input type="file" name="image" class="w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-green-50 file:text-green-700 hover:file:bg-green-100 transition"/>
        </div>

        <div class="flex gap-3">
            <button type="submit" class="bg-green-600 hover:bg-green-700 text-white font-bold py-2 px-6 rounded-lg shadow transition">Simpan Produk</button>
            <a href="{{ route('admin.products') }}" class="bg-gray-200 hover:bg-gray-300 text-gray-800 font-semibold py-2 px-6 rounded-lg transition">Batal</a>
        </div>
    </form>
</div>
@endsection