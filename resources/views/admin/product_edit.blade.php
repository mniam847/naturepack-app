@extends('layouts.admin')

@section('title', 'Edit Produk')
@section('header_title', 'Edit Produk')

@section('content')
<div class="max-w-4xl mx-auto bg-white rounded-xl shadow-lg border border-gray-100 p-8">
    
    <div class="flex justify-between items-center mb-6">
        <h2 class="text-2xl font-bold text-gray-800">Edit Produk</h2>
        <a href="{{ route('admin.products') }}" class="text-gray-500 hover:text-red-500 transition flex items-center gap-2">
            <i class="fas fa-times"></i> Batal
        </a>
    </div>

    @if ($errors->any())
    <div class="bg-red-50 border-l-4 border-red-500 text-red-700 p-4 mb-6 rounded-r">
        <strong class="font-bold">Gagal Menyimpan!</strong>
        <p class="text-sm mt-1">Mohon periksa inputan Anda:</p>
        <ul class="list-disc list-inside mt-2 text-sm">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    {{-- PERHATIKAN: route saya ubah jadi 'product.update' agar sesuai dengan web.php sebelumnya --}}
    <form action="{{ route('products.update', $product->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="grid gap-6 mb-6">
            
            <div>
                <label class="block mb-2 text-sm font-semibold text-gray-700">Nama Produk</label>
                <input type="text" name="name" value="{{ old('name', $product->name) }}" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full p-2.5 transition" required>
            </div>

            <div>
                <label class="block mb-2 text-sm font-semibold text-gray-700">Harga Min (Rp)</label>
                <input type="number" name="price_min" value="{{ old('price_min', $product->price_min) }}" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full p-2.5 transition" required>
            </div>
            
            <div>
                <label class="block mb-2 text-sm font-semibold text-gray-700">Stok</label>
                <input type="number" name="stock" value="{{ old('stock', $product->stock) }}" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full p-2.5 transition" required>
            </div>

            <div>
                <label class="block mb-2 text-sm font-semibold text-gray-700">Deskripsi</label>
                <textarea name="description" rows="4" class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-green-500 focus:border-green-500 transition">{{ old('description', $product->description) }}</textarea>
            </div>

            <div>
                <label class="block mb-2 text-sm font-semibold text-gray-700">Gambar (Biarkan kosong jika tetap)</label>
                
                <div class="flex items-center gap-4 mb-2">
                    @if($product->image)
                        <div class="shrink-0">
                            <p class="text-xs text-gray-500 mb-1">Saat ini:</p>
                            {{-- Menggunakan path uploads/products/ sesuai request --}}
                            <img src="{{ asset('uploads/products/'.$product->image) }}" class="h-20 w-20 object-cover rounded-lg border border-gray-200">
                        </div>
                    @endif
                    
                    <div class="w-full">
                        <input type="file" name="image" class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 focus:outline-none file:mr-4 file:py-2 file:px-4 file:rounded-l-lg file:border-0 file:text-sm file:font-semibold file:bg-green-600 file:text-white hover:file:bg-green-700 transition">
                        <p class="mt-1 text-xs text-gray-500">Format: JPG, PNG, JPEG.</p>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="flex items-center gap-3 mt-6">
            <button type="submit" class="text-white bg-green-600 hover:bg-green-700 font-medium rounded-lg text-sm w-full sm:w-auto px-6 py-2.5 text-center shadow-md transition">Simpan Perubahan</button>
            <a href="{{ route('admin.products') }}" class="text-gray-700 bg-gray-200 hover:bg-gray-300 font-medium rounded-lg text-sm w-full sm:w-auto px-6 py-2.5 text-center transition">Batal</a>
        </div>
    </form>
</div>
@endsection