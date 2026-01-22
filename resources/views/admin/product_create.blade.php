@extends('layouts.admin')

@section('title', 'Tambah Produk')
@section('header_title', 'Tambah Produk Baru')

@section('content')
<div class="max-w-4xl bg-white rounded-xl shadow-lg border border-gray-100 p-8">
    
    {{-- ALERT SUKSES --}}
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
        
        {{-- ========================================== --}}
        {{-- 1. DATA UMUM (Berlaku untuk semua bahasa) --}}
        {{-- ========================================== --}}
        <h3 class="text-lg font-bold text-gray-800 border-b pb-2 mb-4">Data Umum Produk</h3>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
            {{-- KATEGORI --}}
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

            {{-- HARGA --}}
            <div>
                <label class="block text-gray-700 font-semibold mb-2">Harga (Rp)</label>
                {{-- Pastikan name="price" sesuai dengan kolom database --}}
                <input type="number" name="price_min" class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500" placeholder="15000" required>
            </div>

            {{-- STOK --}}
            <div>
                <label class="block mb-2 text-sm font-semibold text-gray-700">Status Ketersediaan</label>
                <select name="is_ready_stock" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full p-2.5">
                    <option value="1" selected>✅ Ready Stock (Tersedia)</option>
                    <option value="0">❌ Out of Stock (Habis)</option>
                </select>
            </div>

            {{-- GAMBAR --}}
            <div>
                <label class="block text-gray-700 font-semibold mb-2">Gambar Produk</label>
                <input type="file" name="image" class="w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-green-50 file:text-green-700 hover:file:bg-green-100 transition"/>
            </div>
        </div>

        {{-- ========================================== --}}
        {{-- 2. DATA TERJEMAHAN (Tab System)           --}}
        {{-- ========================================== --}}
        <h3 class="text-lg font-bold text-gray-800 border-b pb-2 mb-4 mt-8">Nama & Deskripsi</h3>

        {{-- Navigasi Tab --}}
        <div class="flex space-x-2 mb-4 border-b">
            <button type="button" onclick="switchTab('id')" id="btn-id" class="tab-btn px-4 py-2 bg-green-600 text-white rounded-t-lg font-semibold">
                🇮🇩 Indonesia (Utama)
            </button>
            <button type="button" onclick="switchTab('en')" id="btn-en" class="tab-btn px-4 py-2 bg-gray-200 text-gray-600 rounded-t-lg font-semibold hover:bg-gray-300">
                🇬🇧 English
            </button>
            <button type="button" onclick="switchTab('zh')" id="btn-zh" class="tab-btn px-4 py-2 bg-gray-200 text-gray-600 rounded-t-lg font-semibold hover:bg-gray-300">
                🇨🇳 Mandarin
            </button>
        </div>

        {{-- KONTEN TAB: INDONESIA --}}
        <div id="tab-id" class="tab-content block">
            <div class="mb-5">
                <label class="block text-gray-700 font-semibold mb-2">Nama Produk (ID)</label>
                <input type="text" name="name" class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500" placeholder="Contoh: Box Makanan Large" required>
            </div>
            <div class="mb-5">
                <label class="block text-gray-700 font-semibold mb-2">Deskripsi (ID)</label>
                <textarea name="description" rows="4" class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500" placeholder="Deskripsi bahasa Indonesia..."></textarea>
            </div>
        </div>

        {{-- KONTEN TAB: INGGRIS --}}
        <div id="tab-en" class="tab-content hidden">
            <div class="mb-5">
                <label class="block text-gray-700 font-semibold mb-2">Product Name (EN)</label>
                <input type="text" name="name_en" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 bg-blue-50" placeholder="Example: Large Food Box">
            </div>
            <div class="mb-5">
                <label class="block text-gray-700 font-semibold mb-2">Description (EN)</label>
                <textarea name="description_en" rows="4" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 bg-blue-50" placeholder="English description..."></textarea>
            </div>
        </div>

        {{-- KONTEN TAB: MANDARIN --}}
        <div id="tab-zh" class="tab-content hidden">
            <div class="mb-5">
                <label class="block text-gray-700 font-semibold mb-2">产品名称 (ZH)</label>
                <input type="text" name="name_zh" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-red-500 bg-red-50" placeholder="例子：大号食品盒">
            </div>
            <div class="mb-5">
                <label class="block text-gray-700 font-semibold mb-2">描述 (ZH)</label>
                <textarea name="description_zh" rows="4" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-red-500 bg-red-50" placeholder="中文描述..."></textarea>
            </div>
        </div>

        {{-- TOMBOL ACTION --}}
        <div class="flex gap-3 mt-8 pt-6 border-t">
            <button type="submit" class="bg-green-600 hover:bg-green-700 text-white font-bold py-3 px-8 rounded-lg shadow transition">
                Simpan Produk
            </button>
            <a href="{{ route('products.index') }}" class="bg-gray-200 hover:bg-gray-300 text-gray-800 font-semibold py-3 px-8 rounded-lg transition flex items-center">
                Batal
            </a>
        </div>
    </form>
</div>

{{-- SCRIPT SEDERHANA UNTUK GANTI TAB --}}
<script>
    function switchTab(lang) {
        // 1. Sembunyikan semua konten tab
        document.querySelectorAll('.tab-content').forEach(el => el.classList.add('hidden'));
        
        // 2. Reset warna semua tombol tab (jadi abu-abu)
        document.querySelectorAll('.tab-btn').forEach(btn => {
            btn.classList.remove('bg-green-600', 'text-white');
            btn.classList.add('bg-gray-200', 'text-gray-600');
        });

        // 3. Tampilkan konten tab yang dipilih
        document.getElementById('tab-' + lang).classList.remove('hidden');

        // 4. Highlight tombol yang dipilih (jadi hijau)
        let activeBtn = document.getElementById('btn-' + lang);
        activeBtn.classList.remove('bg-gray-200', 'text-gray-600');
        activeBtn.classList.add('bg-green-600', 'text-white');
    }
</script>

@endsection