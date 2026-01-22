{{-- 1. LOGIKA PHP DI ATAS LAYOUT --}}
@php
    $locale = session('locale', 'id');

    // Tentukan Nama & Deskripsi berdasarkan bahasa
    $displayName = $product->name;
    $displayDesc = $product->description;

    if ($locale == 'en') {
        if (!empty($product->name_en)) $displayName = $product->name_en;
        if (!empty($product->description_en)) $displayDesc = $product->description_en;
    } elseif ($locale == 'zh') {
        if (!empty($product->name_zh)) $displayName = $product->name_zh;
        if (!empty($product->description_zh)) $displayDesc = $product->description_zh;
    }
@endphp

@extends('layouts.app')

{{-- Gunakan variabel $displayName agar judul tab browser ikut berubah --}}
@section('title', $displayName)

@section('content')
<div class="py-12 bg-gray-50 min-h-screen mt-16">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        
        <a href="{{ route('products.index') }}" class="text-gray-500 hover:text-blue-900 mb-6 inline-block font-medium">
            &larr; 
            @if($locale == 'en') Back to Catalog @elseif($locale == 'zh') 返回目录 @else Kembali ke Katalog @endif
        </a>

        <div class="bg-white rounded-xl shadow-lg overflow-hidden flex flex-col md:flex-row">
            
            <div class="w-full md:w-1/2 bg-gray-100">
                <img src="{{ asset('uploads/products/' . $product->image) }}" alt="{{ $displayName }}" class="w-full h-96 md:h-full object-cover object-center">
            </div>

            <div class="w-full md:w-1/2 p-8 md:p-12 flex flex-col justify-center">
                <span class="text-blue-600 font-bold tracking-wide uppercase text-sm mb-2">
                    {{-- Kategori biasanya nama umum, bisa dibiarkan atau diterjemahkan manual jika perlu --}}
                    {{ $product->category }}
                </span>
                
                <h1 class="text-3xl md:text-4xl font-extrabold text-gray-900 mb-4">
                    {{ $displayName }}
                </h1>
                
                <div class="text-2xl font-bold text-gray-900 mb-6">
                    Rp {{ number_format($product->price_min, 0, ',', '.') }} 
                    <span class="text-sm text-gray-500 font-normal">/ pcs</span>
                </div>

                <p class="text-gray-600 leading-relaxed mb-8 text-justify">
                    {{-- Gunakan nl2br agar paragraf tetap rapi --}}
                    {!! nl2br(e($displayDesc ?? ($locale == 'en' ? 'Description not available.' : ($locale == 'zh' ? '暂无描述。' : 'Deskripsi produk belum tersedia.')))) !!}
                </p>

                <div class="flex flex-col gap-4">
                    {{-- Tombol WhatsApp --}}
                    <a href="https://wa.me/6281234567890?text=Halo,%20saya%20tertarik%20dengan%20produk%20{{ $product->name }}" target="_blank" class="bg-green-600 text-white text-center py-3 rounded-lg font-bold hover:bg-green-700 transition flex items-center justify-center gap-2">
                        @if($locale == 'en') Message via WhatsApp @elseif($locale == 'zh') 通过 WhatsApp 联系 @else Pesan via WhatsApp @endif
                    </a>
                    
                    {{-- Tombol Website Order --}}
                    <a href="{{ route('order.create', ['product_id' => $product->id]) }}" class="border-2 border-blue-900 text-blue-900 text-center py-3 rounded-lg font-bold hover:bg-blue-900 hover:text-white transition">
                        @if($locale == 'en') Order via Website @elseif($locale == 'zh') 通过网站订购 @else Order Lewat Website @endif
                    </a>
                </div>
            </div>

        </div>
    </div>
</div>
@endsection