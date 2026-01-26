@extends('layouts.admin')

@section('title', 'Edit Product')
@section('header_title', 'Edit Product')

@section('content')
<div class="max-w-4xl bg-white rounded-xl shadow-lg border border-gray-100 p-8">
    
    <div class="flex justify-between items-center mb-6">
        <h2 class="text-2xl font-bold text-gray-800">Edit Product: {{ $product->name }}</h2>
        {{-- Tombol Cancel --}}
        <a href="{{ route('admin.products') }}" class="text-gray-500 hover:text-red-500 transition flex items-center gap-2">
            <i class="fas fa-times"></i> Cancel
        </a>
    </div>

    @if ($errors->any())
    <div class="bg-red-50 border-l-4 border-red-500 text-red-700 p-4 mb-6 rounded-r">
        <strong class="font-bold">Error Saving!</strong>
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
        {{-- 1. GENERAL INFO (Data Umum)               --}}
        {{-- ========================================== --}}
        <h3 class="text-lg font-bold text-gray-800 border-b pb-2 mb-4">General Information</h3>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
            
            {{-- KATEGORI --}}
            <div>
                <label class="block mb-2 text-sm font-semibold text-gray-700">Category</label>
                <select name="category" class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500 bg-white">
                    <option value="Box Makanan" {{ $product->category == 'Box Makanan' ? 'selected' : '' }}>Box Makanan</option>
                    <option value="Box Gift" {{ $product->category == 'Box Gift' ? 'selected' : '' }}>Box Gift</option>
                    <option value="Corrugated Box" {{ $product->category == 'Corrugated Box' ? 'selected' : '' }}>Corrugated Box</option>
                    <option value="Paper Bag" {{ $product->category == 'Paper Bag' ? 'selected' : '' }}>Paper Bag</option>
                    <option value="Lainnya" {{ $product->category == 'Lainnya' ? 'selected' : '' }}>Others</option>
                </select>
            </div>

            {{-- HARGA --}}
            <div>
                <label class="block mb-2 text-sm font-semibold text-gray-700">Price (Rp)</label>
                <input type="number" name="price_min" value="{{ old('price_min', $product->price_min) }}" class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500" required>
            </div>
            
            {{-- STATUS STOK --}}
            <div class="md:col-span-2">
                <label class="block mb-2 text-sm font-semibold text-gray-700">Availability Status</label>
                <select name="is_ready_stock" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full p-2.5">
                    <option value="1" {{ $product->is_ready_stock == 1 ? 'selected' : '' }}>
                        ✅ Ready Stock
                    </option>
                    <option value="0" {{ $product->is_ready_stock == 0 ? 'selected' : '' }}>
                        ❌ Out of Stock
                    </option>
                </select>
            </div>

            {{-- ====================== --}}
            {{-- AREA UPLOAD GAMBAR     --}}
            {{-- ====================== --}}
            
            {{-- GAMBAR 1 (UTAMA) --}}
            <div>
                <label class="block mb-2 text-sm font-semibold text-gray-700">Main Image</label>
                <div class="border p-4 rounded-lg bg-gray-50">
                    @if($product->image)
                        <div class="mb-3">
                            <span class="text-xs text-gray-500 block mb-1">Current Image:</span>
                            <img src="{{ asset('uploads/products/'.$product->image) }}" class="h-32 w-full object-cover rounded-lg border border-gray-200">
                        </div>
                    @endif
                    <input type="file" name="image" class="block w-full text-xs text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-white focus:outline-none">
                    <p class="text-xs text-gray-500 mt-1">Leave empty to keep current image.</p>
                </div>
            </div>

            {{-- GAMBAR 2 (TAMBAHAN) - BARU --}}
            <div>
                <label class="block mb-2 text-sm font-semibold text-gray-700">Second Image (Optional)</label>
                <div class="border p-4 rounded-lg bg-gray-50">
                    @if($product->image2)
                        <div class="mb-3">
                            <span class="text-xs text-gray-500 block mb-1">Current Image 2:</span>
                            <img src="{{ asset('uploads/products/'.$product->image2) }}" class="h-32 w-full object-cover rounded-lg border border-gray-200">
                        </div>
                    @else
                        <div class="mb-3 h-32 w-full bg-gray-200 rounded-lg flex items-center justify-center text-gray-400 text-xs border border-gray-300 border-dashed">
                            No Second Image
                        </div>
                    @endif
                    <input type="file" name="image2" class="block w-full text-xs text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-white focus:outline-none">
                    <p class="text-xs text-gray-500 mt-1">Leave empty to keep current.</p>
                </div>
            </div>

        </div>
        
        {{-- ========================================== --}}
        {{-- 2. TRANSLATION DATA (Tab System)           --}}
        {{-- ========================================== --}}
        <h3 class="text-lg font-bold text-gray-800 border-b pb-2 mb-4 mt-8">Name & Description</h3>

        {{-- Navigasi Tab --}}
        <div class="flex space-x-2 mb-4 border-b">
            <button type="button" onclick="switchTab('id')" id="btn-id" class="tab-btn px-4 py-2 bg-green-600 text-white rounded-t-lg font-semibold text-sm">
                🇮🇩 Indonesia
            </button>
            <button type="button" onclick="switchTab('en')" id="btn-en" class="tab-btn px-4 py-2 bg-gray-200 text-gray-600 rounded-t-lg font-semibold text-sm hover:bg-gray-300">
                🇬🇧 English
            </button>
            <button type="button" onclick="switchTab('zh')" id="btn-zh" class="tab-btn px-4 py-2 bg-gray-200 text-gray-600 rounded-t-lg font-semibold text-sm hover:bg-gray-300">
                🇨🇳 Mandarin
            </button>
        </div>

        {{-- TAB: INDONESIA --}}
        <div id="tab-id" class="tab-content block">
            <div class="mb-5">
                <label class="block text-gray-700 font-semibold mb-2">Product Name (ID)</label>
                <input type="text" name="name" value="{{ old('name', $product->name) }}" class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500" required>
            </div>
            <div class="mb-5">
                <label class="block text-gray-700 font-semibold mb-2">Description (ID)</label>
                <textarea name="description" rows="4" class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500">{{ old('description', $product->description) }}</textarea>
            </div>
        </div>

        {{-- TAB: INGGRIS --}}
        <div id="tab-en" class="tab-content hidden">
            <div class="mb-5">
                <label class="block text-gray-700 font-semibold mb-2">Product Name (EN)</label>
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
                <label class="block text-gray-700 font-semibold mb-2">Product Name (ZH)</label>
                <input type="text" name="name_zh" value="{{ old('name_zh', $product->name_zh) }}" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-red-500 bg-red-50" placeholder="中文名称">
            </div>
            <div class="mb-5">
                <label class="block text-gray-700 font-semibold mb-2">Description (ZH)</label>
                <textarea name="description_zh" rows="4" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-red-500 bg-red-50" placeholder="中文描述">{{ old('description_zh', $product->description_zh) }}</textarea>
            </div>
        </div>

        {{-- TOMBOL SIMPAN --}}
        <div class="flex items-center gap-3 mt-8 pt-6 border-t">
            <button type="submit" class="text-white bg-green-600 hover:bg-green-700 font-medium rounded-lg text-sm w-full sm:w-auto px-8 py-3 text-center shadow-md transition">
                Update Product
            </button>
            <a href="{{ route('admin.products') }}" class="text-gray-700 bg-gray-200 hover:bg-gray-300 font-medium rounded-lg text-sm w-full sm:w-auto px-8 py-3 text-center transition">
                Cancel
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