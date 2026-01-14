@extends('layouts.app')

@section('title', 'Form Custom Order')

@section('content')
<div class="max-w-3xl mx-auto px-4 py-12">
    <div class="bg-white p-8 rounded-xl shadow-lg border border-gray-200">
        <h1 class="text-2xl font-bold text-blue-900 mb-6 text-center">Form Pemesanan Custom Box</h1>

        <form action="{{ route('order.store') }}" method="POST" enctype="multipart/form-data">
            @csrf <div class="mb-6">
                <h3 class="font-bold text-gray-700 mb-3 border-b pb-2">1. Data Pemesan</h3>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Nama Lengkap</label>
                        <input type="text" name="customer_name" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm border p-2">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700">No. WhatsApp</label>
                        <input type="text" name="customer_whatsapp" required placeholder="0812..." class="mt-1 block w-full rounded-md border-gray-300 shadow-sm border p-2">
                    </div>
                </div>
            </div>

            <div class="mb-6">
                <h3 class="font-bold text-gray-700 mb-3 border-b pb-2">2. Spesifikasi Kemasan</h3>
                <div class="grid grid-cols-3 gap-4 mb-4">
                    <div>
                        <label class="block text-sm text-gray-600">Panjang (cm)</label>
                        <input type="number" name="length" required class="w-full border p-2 rounded">
                    </div>
                    <div>
                        <label class="block text-sm text-gray-600">Lebar (cm)</label>
                        <input type="number" name="width" required class="w-full border p-2 rounded">
                    </div>
                    <div>
                        <label class="block text-sm text-gray-600">Tinggi (cm)</label>
                        <input type="number" name="height" required class="w-full border p-2 rounded">
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
                        <input type="number" name="quantity" required min="100" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm border p-2">
                    </div>
                </div>
            </div>

            <div class="mb-8">
                <h3 class="font-bold text-gray-700 mb-3 border-b pb-2">3. Upload Desain</h3>
                <label class="block text-sm text-gray-600 mb-2">Upload file logo/desain (JPG/PNG/PDF)</label>
                <input type="file" name="design_file" required class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100">
            </div>

            <button type="submit" class="w-full bg-orange-500 text-white font-bold py-3 px-4 rounded-lg hover:bg-orange-600 transition duration-300">
                Kirim Pesanan Sekarang
            </button>
        </form>
    </div>
</div>
@endsection