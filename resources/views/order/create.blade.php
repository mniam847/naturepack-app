@extends('layouts.app')

@section('title', 'Form Custom Order')

@section('content')
<div class="max-w-3xl mx-auto px-4 py-12">
    <div class="bg-white p-8 rounded-xl shadow-lg border border-gray-200">
        <h1 class="text-2xl font-bold text-blue-900 mb-6 text-center">Form Pemesanan</h1>

        <form action="{{ route('order.store') }}" method="POST" enctype="multipart/form-data">
            @csrf 
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Nama Lengkap (Full Name)</label>
                    <input type="text" name="name" required class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-green-500 focus:outline-none" placeholder="Ex: John Doe">
                </div>
                
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Email Address</label>
                    <input type="email" name="email" required class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-green-500 focus:outline-none" placeholder="name@company.com">
                </div>

                <div class="md:col-span-2">
                    <label class="block text-sm font-medium text-gray-700 mb-2">WhatsApp / Phone Number (with Country Code)</label>
                    <input type="text" name="whatsapp" required class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-green-500 focus:outline-none" placeholder="Ex: +61 412 345 678 (Australia) / +86 138 0013 (China)">
                    <p class="text-xs text-gray-500 mt-1">Please include country code (e.g., +61 for Australia, +86 for China).</p>
                </div>
            </div>

            <div class="mb-6">
                <h3 class="font-bold text-gray-700 mb-3 border-b pb-2">2. Spesifikasi Kemasan</h3>
                
                <div class="mb-4 bg-green-50 p-3 rounded-lg border border-green-200">
                    <label class="block text-sm font-bold text-gray-800 mb-1">Pilih Produk dari Katalog (Opsional)</label>
                    <select name="product_id" class="block w-full rounded-md border-gray-300 shadow-sm border p-2 focus:ring-green-500 focus:border-green-500">
                        <option value="">-- Saya ingin Custom Ukuran Sendiri --</option>
                        
                        @foreach($products as $product)
                            <option value="{{ $product->id }}" 
                                {{ (isset($selectedProduct) && $selectedProduct == $product->id) ? 'selected' : '' }}>
                                
                                {{ $product->name }} (Mulai Rp {{ number_format($product->price_min, 0, ',', '.') }})
                            
                            </option>
                        @endforeach
                    </select>
                    <p class="text-xs text-gray-500 mt-1">*Jika memilih produk di atas, detail ukuran di bawah boleh dikosongkan/disesuaikan.</p>
                </div>

                <div class="grid grid-cols-3 gap-4 mb-4">
                    <div>
                        <label class="block text-sm text-gray-600">Panjang (cm)</label>
                        <input type="number" name="length" class="w-full border p-2 rounded" placeholder="P">
                    </div>
                    <div>
                        <label class="block text-sm text-gray-600">Lebar (cm)</label>
                        <input type="number" name="width" class="w-full border p-2 rounded" placeholder="L">
                    </div>
                    <div>
                        <label class="block text-sm text-gray-600">Tinggi (cm)</label>
                        <input type="number" name="height" class="w-full border p-2 rounded" placeholder="T">
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Jenis Bahan</label>
                        <select name="material" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm border p-2">
                            <option>Corrugated Box (Kardus)</option>
                            <option>Ivory (Food Grade)</option>
                            <option>Duplex</option>
                            <option>Kraft Paper</option>
                        </select>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Jumlah Order (Pcs)</label>
                        <input type="number" name="quantity" required min="1" value="100" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm border p-2">
                    </div>
                </div>
            </div>

            <div class="mb-8">
                <h3 class="font-bold text-gray-700 mb-3 border-b pb-2">3. Upload Desain</h3>
                <label class="block text-sm text-gray-600 mb-2">Upload file logo/desain (JPG/PNG/PDF)</label>
                <input type="file" name="design_file" class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100">
            </div>

            <button type="submit" class="w-full bg-green-600 text-white font-bold py-3 px-4 rounded-lg hover:bg-green-700 transition duration-300 shadow-md">
                Kirim Pesanan Sekarang
            </button>
        </form>
    </div>
</div>
@endsection