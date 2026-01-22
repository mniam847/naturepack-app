@extends('layouts.admin')

@section('title', 'Kelola Produk')
@section('header_title', 'Manajemen Produk')

@section('content')
<div class="bg-white rounded-xl shadow-lg border border-gray-100 p-6">
    
    <div class="flex justify-between items-center mb-6">
        <div>
            <h3 class="text-lg font-bold text-gray-800">Daftar Produk</h3>
            <p class="text-sm text-gray-500">Total Produk: {{ $products->count() }}</p>
        </div>
        <a href="{{ route('product.create') }}" class="bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded-lg text-sm font-medium transition flex items-center gap-2">
            <i class="fas fa-plus"></i> Tambah Produk
        </a>
    </div>

    <div class="overflow-x-auto">
        <table class="w-full text-left border-collapse">
            <thead>
                <tr class="bg-gray-50 text-gray-600 text-xs uppercase tracking-wider">
                    <th class="px-4 py-3 border-b">Gambar</th>
                    <th class="px-4 py-3 border-b">Info Produk</th>
                    <th class="px-4 py-3 border-b">Harga</th>
                    {{-- HEADER STATUS --}}
                    <th class="px-4 py-3 border-b text-center">Status</th> 
                    <th class="px-4 py-3 border-b text-center">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-100">
                {{-- PERHATIKAN BARIS INI: $products as $product --}}
                @forelse($products as $product)
                <tr class="hover:bg-gray-50 transition">
                    
                    {{-- 1. GAMBAR --}}
                    <td class="px-4 py-3 w-20">
                        @if($product->image)
                            <img src="{{ asset('uploads/products/' . $product->image) }}" class="w-16 h-16 object-cover rounded-lg border border-gray-200 shadow-sm">
                        @else
                            <div class="w-16 h-16 bg-gray-100 rounded-lg flex items-center justify-center text-gray-400 text-xs text-center border">No IMG</div>
                        @endif
                    </td>

                    {{-- 2. NAMA --}}
                    <td class="px-4 py-3">
                        <div class="font-bold text-gray-800">{{ $product->name }}</div>
                        <span class="text-xs text-blue-600 bg-blue-50 px-2 py-0.5 rounded mt-1 inline-block">
                            {{ $product->category }}
                        </span>
                    </td>

                    {{-- 3. HARGA --}}
                    <td class="px-4 py-3 font-semibold text-gray-700 text-sm">
                        Rp {{ number_format($product->price_min, 0, ',', '.') }}
                    </td>

                    {{-- 4. STATUS (PERBAIKAN UTAMA DISINI) --}}
                    <td class="px-4 py-3 text-center">
                        {{-- Gunakan $product (tanpa s), BUKAN $products --}}
                        @if($product->is_ready_stock == 1)
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800 border border-green-200">
                                <span class="w-1.5 h-1.5 mr-1.5 bg-green-600 rounded-full"></span>
                                Ready
                            </span>
                        @else
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-red-100 text-red-800 border border-red-200">
                                <span class="w-1.5 h-1.5 mr-1.5 bg-red-600 rounded-full"></span>
                                Habis
                            </span>
                        @endif
                    </td>

                    {{-- 5. AKSI --}}
                    <td class="px-4 py-3 text-center">
                        <div class="flex justify-center gap-2">
                            <a href="{{ route('products.edit', $product->id) }}" class="text-blue-500 hover:bg-blue-50 p-2 rounded transition">
                                <i class="fas fa-edit"></i>
                            </a>
                            <form action="{{ route('products.destroy', $product->id) }}" method="POST" onsubmit="return confirm('Hapus produk ini?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-500 hover:bg-red-50 p-2 rounded transition">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="p-8 text-center text-gray-500">
                        Belum ada data produk.
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection