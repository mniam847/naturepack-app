@extends('layouts.admin')

@section('title', 'Edit Produk')
@section('header_title', 'Edit Produk')

@section('content')
<div class="max-w-4xl bg-white rounded-xl shadow-lg border border-gray-100 p-8">
    
    <div class="flex justify-between items-center mb-6">
        <h2 class="text-2xl font-bold text-gray-800">Edit Produk: {{ $product->name }}</h2>
        {{-- Tombol Batal --}}
        <a href="{{ route('admin.products') }}" class="text-gray-500 hover:text-red-500 transition flex items-center gap-2">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
            Batal
        </a>
    </div>

    @if ($errors->any())
    <div class="bg-red-50 border-l-4 border-red-500 text-red-700 p-4 mb-6 rounded-r">
        <strong class="font-bold">Gagal Menyimpan!</strong>
        <ul class="list-disc list-inside mt-2 text-sm">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    <form action="{{ route('products.update', $product->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        {{-- ========================================== --}}
        {{-- 1. DATA UMUM (Berlaku untuk semua bahasa) --}}
        {{-- ========================================== --}}
        <h3 class="text-lg font-bold text-gray-800 border-b pb-2 mb-4">Data Umum Produk</h3>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
            
            {{-- KATEGORI --}}
            <div>
                <label class="block mb-2 text-sm font-semibold text-gray-700">Kategori</label>
                <select name="category" class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500 bg-white">
                    <option value="Box Makanan" {{ $product->category == 'Box Makanan' ? 'selected' : '' }}>Box Makanan</option>
                    <option value="Box Gift" {{ $product->category == 'Box Gift' ? 'selected' : '' }}>Box Gift</option>
                    <option value="Corrugated Box" {{ $product->category == 'Corrugated Box' ? 'selected' : '' }}>Corrugated Box</option>
                    <option value="Paper Bag" {{ $product->category == 'Paper Bag' ? 'selected' : '' }}>Paper Bag</option>
                    <option value="Lainnya" {{ $product->category == 'Lainnya' ? 'selected' : '' }}>Lainnya</option>
                </select>
            </div>

            {{-- HARGA --}}
            <div>
                <label class="block mb-2 text-sm font-semibold text-gray-700">Harga (Rp)</label>
                {{-- Gunakan $product->price atau $product->price_min sesuai database --}}
                <input type="number" name="price_min" value="{{ old('price_min', $product->price_min) }}" class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500" required>
            </div>
            
            {{-- STOK --}}
            <div>
                <label class="block mb-2 text-sm font-semibold text-gray-700">Status Ketersediaan</label>
                <select name="is_ready_stock" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full p-2.5">
                    <option value="1" {{ $product->is_ready_stock == 1 ? 'selected' : '' }}>
                        ✅ Ready Stock (Tersedia)
                    </option>
                    <option value="0" {{ $product->is_ready_stock == 0 ? 'selected' : '' }}>
                        ❌ Out of Stock (Habis)
                    </option>
                </select>
            </div>

            {{-- GAMBAR --}}
            <div class="col-span-1 md:col-span-2">
                <label class="block mb-2 text-sm font-semibold text-gray-700">Gambar (Biarkan kosong jika tidak diganti)</label>
                <div class="flex items-center gap-4">
                    @if($product->image)
                        <div class="shrink-0">
                            {{-- Tampilkan gambar lama --}}
                            <img src="{{ asset('uploads/products/'.$product->image) }}" class="h-20 w-20 object-cover rounded-lg border border-gray-200">
                        </div>
                    @endif
                    <div class="w-full">
                        <input type="file" name="image" class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 focus:outline-none file:mr-4 file:py-2 file:px-4 file:rounded-l-lg file:border-0 file:text-sm file:font-semibold file:bg-green-600 file:text-white hover:file:bg-green-700 transition">
                    </div>
                </div>
            </div>
        </div>
        
        {{-- ========================================== --}}
        {{-- 2. DATA TERJEMAHAN (Tab System)           --}}
        {{-- ========================================== --}}
        <h3 class="text-lg font-bold text-gray-800 border-b pb-2 mb-4 mt-8">Edit Nama & Deskripsi</h3>

        {{-- Navigasi Tab --}}
        <div class="flex space-x-2 mb-4 border-b">
            <button type="button" onclick="switchTab('id')" id="btn-id" class="tab-btn px-4 py-2 bg-green-600 text-white rounded-t-lg font-semibold">
                🇮🇩 Indonesia
            </button>
            <button type="button" onclick="switchTab('en')" id="btn-en" class="tab-btn px-4 py-2 bg-gray-200 text-gray-600 rounded-t-lg font-semibold hover:bg-gray-300">
                🇬🇧 English
            </button>
            <button type="button" onclick="switchTab('zh')" id="btn-zh" class="tab-btn px-4 py-2 bg-gray-200 text-gray-600 rounded-t-lg font-semibold hover:bg-gray-300">
                🇨🇳 Mandarin
            </button>
        </div>

        {{-- TAB: INDONESIA --}}
        <div id="tab-id" class="tab-content block">
            <div class="mb-5">
                <label class="block text-gray-700 font-semibold mb-2">Nama Produk (ID)</label>
                <input type="text" name="name" value="{{ old('name', $product->name) }}" class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500" required>
            </div>
            <div class="mb-5">
                <label class="block text-gray-700 font-semibold mb-2">Deskripsi (ID)</label>
                <textarea name="description" rows="4" class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500">{{ old('description', $product->description) }}</textarea>
            </div>
        </div>

        {{-- TAB: INGGRIS --}}
        <div id="tab-en" class="tab-content hidden">
            <div class="mb-5">
                <label class="block text-gray-700 font-semibold mb-2">Product Name (EN)</label>
                {{-- Ambil data lama name_en --}}
                <input type="text" name="name_en" value="{{ old('name_en', $product->name_en) }}" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 bg-blue-50" placeholder="English Name">
            </div>
            <div class="mb-5">
                <label class="block text-gray-700 font-semibold mb-2">Description (EN)</label>
                <textarea name="description_en" rows="4" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 bg-blue-50" placeholder="English Description">{{ old('description_en', $product->description_en) }}</textarea>
            </div>
        </div>

        {{-- TAB: MANDARIN --}}
        <div id="tab-zh" class="tab-content hidden">
            <div class="mb-5">
                <label class="block text-gray-700 font-semibold mb-2">产品名称 (ZH)</label>
                {{-- Ambil data lama name_zh --}}
                <input type="text" name="name_zh" value="{{ old('name_zh', $product->name_zh) }}" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-red-500 bg-red-50" placeholder="中文名称">
            </div>
            <div class="mb-5">
                <label class="block text-gray-700 font-semibold mb-2">描述 (ZH)</label>
                <textarea name="description_zh" rows="4" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-red-500 bg-red-50" placeholder="中文描述">{{ old('description_zh', $product->description_zh) }}</textarea>
            </div>
        </div>

        {{-- TOMBOL SIMPAN --}}
        <div class="flex items-center gap-3 mt-8 pt-6 border-t">
            <button type="submit" class="text-white bg-green-600 hover:bg-green-700 font-medium rounded-lg text-sm w-full sm:w-auto px-8 py-3 text-center shadow-md transition">
                Update Produk
            </button>
            <a href="{{ route('admin.products') }}" class="text-gray-700 bg-gray-200 hover:bg-gray-300 font-medium rounded-lg text-sm w-full sm:w-auto px-8 py-3 text-center transition">
                Batal
            </a>
        </div>
    </form>
</div>

<script>
    function switchTab(lang) {
        // Sembunyikan semua tab content
        document.querySelectorAll('.tab-content').forEach(el => el.classList.add('hidden'));
        
        // Reset style tombol tab
        document.querySelectorAll('.tab-btn').forEach(btn => {
            btn.classList.remove('bg-green-600', 'text-white');
            btn.classList.add('bg-gray-200', 'text-gray-600');
        });

        // Tampilkan tab yang dipilih
        document.getElementById('tab-' + lang).classList.remove('hidden');

        // Highlight tombol aktif
        let activeBtn = document.getElementById('btn-' + lang);
        activeBtn.classList.remove('bg-gray-200', 'text-gray-600');
        activeBtn.classList.add('bg-green-600', 'text-white');
    }
</script>

@endsection