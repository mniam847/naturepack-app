@extends('layouts.admin')

@section('title', 'Kelola Produk')
@section('header_title', 'Manajemen Produk')

@section('content')
<div class="bg-white rounded-xl shadow-lg border border-gray-100 p-6">
    
    <div class="flex justify-between items-center mb-6">
        <h3 class="text-lg font-bold text-gray-800">Daftar Produk</h3>
        <a href="{{ route('product.create') }}" class="bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded-lg text-sm font-medium transition flex items-center gap-2">
            <i class="fas fa-plus"></i> Tambah Produk
        </a>
    </div>

    <div class="overflow-x-auto">
        <table class="w-full text-left border-collapse">
            <thead>
                <tr class="bg-gray-50 text-gray-600 text-sm uppercase tracking-wider">
                    <th class="px-4 py-3 border-b">Gambar</th>
                    <th class="px-4 py-3 border-b">Nama Produk</th>
                    <th class="px-4 py-3 border-b">Harga</th>
                    <th class="px-4 py-3 border-b">Stok</th>
                    <th class="px-4 py-3 border-b text-center">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-100">
                @forelse($products as $product)
                <tr class="hover:bg-gray-50 transition">
                    <td class="px-4 py-3">
                        @if($product->image)
                            <img src="{{ asset('uploads/products/' . $product->image) }}" class="w-12 h-12 object-cover rounded-lg border border-gray-200">
                        @else
                            <div class="w-12 h-12 bg-gray-100 rounded-lg flex items-center justify-center text-gray-400">
                                <i class="fas fa-box"></i>
                            </div>
                        @endif
                    </td>
                    <td class="px-4 py-3 font-medium text-gray-800">{{ $product->name }}</td>
                    <td class="px-4 py-3 text-green-600 font-semibold">Rp {{ number_format($product->price_min, 0, ',', '.') }}</td>
                    <td class="px-4 py-3 text-sm text-gray-600">{{ $product->stock }}</td>
                    <td class="px-4 py-3 text-center">
                        <div class="flex items-center justify-center gap-2">
                            <a href="{{ route('products.edit', $product->id) }}" class="text-blue-500 hover:text-blue-700 bg-blue-50 hover:bg-blue-100 p-2 rounded transition">
                                <i class="fas fa-edit"></i>
                            </a>
                            <form action="{{ route('products.destroy', $product->id) }}" method="POST" onsubmit="return confirm('Yakin hapus produk ini?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-500 hover:text-red-700 bg-red-50 hover:bg-red-100 p-2 rounded transition">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="px-4 py-8 text-center text-gray-500">
                        Belum ada produk. Silakan tambah produk baru.
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection