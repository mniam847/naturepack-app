@extends('layouts.admin')

@section('title', 'Manage Products')
@section('header_title', 'Product Management')

@section('content')
<div class="bg-white rounded-xl shadow-lg border border-gray-100 p-6">
    
    <div class="flex justify-between items-center mb-6">
        <div>
            <h3 class="text-lg font-bold text-gray-800">Product List</h3>
            <p class="text-sm text-gray-500">Total Products: {{ $products->count() }}</p>
        </div>
        <a href="{{ route('product.create') }}" class="bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded-lg text-sm font-medium transition flex items-center gap-2">
            <i class="fas fa-plus"></i> Add Product
        </a>
    </div>

    <div class="overflow-x-auto">
        <table class="w-full text-left border-collapse">
            <thead>
                <tr class="bg-gray-50 text-gray-600 text-xs uppercase tracking-wider">
                    <th class="px-4 py-3 border-b">Images</th>
                    <th class="px-4 py-3 border-b">Product Info</th>
                    <th class="px-4 py-3 border-b">Price</th>
                    <th class="px-4 py-3 border-b text-center">Status</th> 
                    <th class="px-4 py-3 border-b text-center">Action</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-100">
                @forelse($products as $product)
                <tr class="hover:bg-gray-50 transition">
                    
                    {{-- 1. GAMBAR (HOVER EFFECT) --}}
                    <td class="px-4 py-3 w-24">
                        @if($product->image)
                            <div class="relative w-20 h-20 rounded-lg border border-gray-200 shadow-sm overflow-hidden group">
                                
                                {{-- GAMBAR 1 (Default Muncul) --}}
                                {{-- Jika ada image2, maka saat di-hover opacity jadi 0 (hilang) --}}
                                <img src="{{ asset('uploads/products/' . $product->image) }}" 
                                    class="absolute inset-0 w-full h-full object-cover transition-opacity duration-300 ease-in-out
                                            {{ $product->image2 ? 'group-hover:opacity-0' : '' }}" 
                                    alt="Img 1">
                                
                                {{-- GAMBAR 2 (Muncul saat Hover) --}}
                                @if($product->image2)
                                    <img src="{{ asset('uploads/products/' . $product->image2) }}" 
                                        class="absolute inset-0 w-full h-full object-cover transition-opacity duration-300 ease-in-out opacity-0 group-hover:opacity-100" 
                                        alt="Img 2">
                                    
                                    {{-- Badge kecil penanda ada 2 gambar --}}
                                    <div class="absolute bottom-0 right-0 bg-black/50 text-white text-[9px] px-1 rounded-tl">
                                        2 Pics
                                    </div>
                                @endif

                            </div>
                        @else
                            <div class="w-20 h-20 bg-gray-100 rounded-lg flex items-center justify-center text-gray-400 text-xs text-center border">
                                No Image
                            </div>
                        @endif
                    </td>

                    {{-- 2. INFO PRODUK --}}
                    <td class="px-4 py-3">
                        <div class="font-bold text-gray-800">{{ $product->name }}</div>
                        <span class="text-xs text-blue-600 bg-blue-50 px-2 py-0.5 rounded mt-1 inline-block border border-blue-100">
                            {{ $product->category }}
                        </span>
                        {{-- Tampilkan nama Inggris/China jika ada (Opsional) --}}
                        @if($product->name_en)
                            <div class="text-xs text-gray-400 mt-1 italic">EN: {{ $product->name_en }}</div>
                        @endif
                    </td>

                    {{-- 3. HARGA --}}
                    <td class="px-4 py-3 font-semibold text-gray-700 text-sm">
                        Rp {{ number_format($product->price_min, 0, ',', '.') }}
                    </td>

                    {{-- 4. STATUS --}}
                    <td class="px-4 py-3 text-center">
                        @if($product->is_ready_stock == 1)
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800 border border-green-200">
                                <span class="w-1.5 h-1.5 mr-1.5 bg-green-600 rounded-full"></span>
                                Ready Stock
                            </span>
                        @else
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-red-100 text-red-800 border border-red-200">
                                <span class="w-1.5 h-1.5 mr-1.5 bg-red-600 rounded-full"></span>
                                Out of Stock
                            </span>
                        @endif
                    </td>

                    {{-- 5. ACTION --}}
                    <td class="px-4 py-3 text-center">
                        <div class="flex justify-center gap-2">
                            <a href="{{ route('products.edit', $product->id) }}" class="text-blue-500 hover:bg-blue-50 p-2 rounded transition" title="Edit">
                                <i class="fas fa-edit"></i>
                            </a>
                            <form action="{{ route('products.destroy', $product->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this product?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-500 hover:bg-red-50 p-2 rounded transition" title="Delete">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="p-8 text-center text-gray-500">
                        No product data available.
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

{{-- CSS Tambahan untuk menyembunyikan scrollbar tapi tetap bisa di-scroll --}}
<style>
    .scrollbar-hide::-webkit-scrollbar {
        display: none;
    }
    .scrollbar-hide {
        -ms-overflow-style: none;
        scrollbar-width: none;
    }
</style>
@endsection