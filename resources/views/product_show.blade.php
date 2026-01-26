@extends('layouts.app')

@section('content')

{{-- LOGIKA PHP: BAHASA & MATA UANG --}}
@php
    $locale = app()->getLocale();

    // 1. Tentukan Nama & Deskripsi
    $displayName = $product->name;
    $displayDesc = $product->description;

    if ($locale == 'en') {
        if (!empty($product->name_en)) $displayName = $product->name_en;
        if (!empty($product->description_en)) $displayDesc = $product->description_en;
    } elseif ($locale == 'zh') {
        if (!empty($product->name_zh)) $displayName = $product->name_zh;
        if (!empty($product->description_zh)) $displayDesc = $product->description_zh;
    }

    // 2. LOGIKA MATA UANG (Sama seperti di Grid)
    $finalPrice = $product->price_min ?? 0;
    $currencySymbol = 'Rp';
    $decimal = 0; // Jumlah angka di belakang koma

    if ($locale == 'en') {
        // Estimasi: 1 USD = Rp 16.000 (Sesuaikan kurs jika perlu)
        $finalPrice = $finalPrice / 16000;
        $currencySymbol = '$';
        $decimal = 2; // Dollar biasanya pakai 2 desimal (misal: $ 10.50)
    } elseif ($locale == 'zh') {
        // Estimasi: 1 CNY = Rp 2.200
        $finalPrice = $finalPrice / 2200;
        $currencySymbol = '¥';
        $decimal = 1; 
    }

    // 3. Persiapkan URL Gambar untuk AlpineJS
    $img1 = $product->image ? asset('uploads/products/' . $product->image) : 'https://via.placeholder.com/600x600?text=No+Image';
    $img2 = $product->image2 ? asset('uploads/products/' . $product->image2) : null;
@endphp

<div class="py-12 bg-gray-50 min-h-screen mt-16">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        
        {{-- TOMBOL KEMBALI --}}
        <a href="{{ route('products.index') }}" class="inline-flex items-center text-gray-500 hover:text-green-600 mb-6 font-medium transition-colors">
            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
            @if($locale == 'en') Back to Catalog @elseif($locale == 'zh') 返回目录 @else Kembali ke Katalog @endif
        </a>

        <div class="bg-white rounded-2xl shadow-xl overflow-hidden">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-0">
                
                {{-- BAGIAN KIRI: GALERI GAMBAR --}}
                <div class="bg-gray-100 p-6 md:p-10 flex flex-col justify-center items-center" 
                     x-data="{ activeImage: '{{ $img1 }}' }">
                    
                    {{-- Gambar Utama --}}
                    <div class="relative w-full h-96 md:h-[500px] bg-white rounded-xl shadow-sm overflow-hidden mb-4 flex items-center justify-center">
                        <img 
                            :src="activeImage" 
                            alt="{{ $displayName }}" 
                            class="w-full h-full object-contain p-2 transition-opacity duration-300"
                        >
                        {{-- Badge Ready Stock --}}
                        @if($product->is_ready_stock)
                            <span class="absolute top-4 right-4 bg-green-500 text-white text-sm font-bold px-4 py-1 rounded-full shadow-md">
                                @if($locale == 'en') READY STOCK @elseif($locale == 'zh') 现货 @else READY STOCK @endif
                            </span>
                        @endif
                    </div>

                    {{-- Thumbnail (Hanya muncul jika ada image2) --}}
                    @if($img2)
                        <div class="flex space-x-4 overflow-x-auto py-2">
                            <button @click="activeImage = '{{ $img1 }}'" class="w-20 h-20 rounded-lg border-2 overflow-hidden transition-all" :class="activeImage === '{{ $img1 }}' ? 'border-green-500 ring-2 ring-green-200' : 'border-gray-300 hover:border-gray-400'">
                                <img src="{{ $img1 }}" class="w-full h-full object-cover">
                            </button>
                            <button @click="activeImage = '{{ $img2 }}'" class="w-20 h-20 rounded-lg border-2 overflow-hidden transition-all" :class="activeImage === '{{ $img2 }}' ? 'border-green-500 ring-2 ring-green-200' : 'border-gray-300 hover:border-gray-400'">
                                <img src="{{ $img2 }}" class="w-full h-full object-cover">
                            </button>
                        </div>
                    @endif
                </div>

                {{-- BAGIAN KANAN: DETAIL PRODUK --}}
                <div class="p-8 md:p-12 flex flex-col h-full">
                    
                    <span class="text-green-600 font-bold tracking-wide uppercase text-xs mb-2 bg-green-50 px-3 py-1 rounded-full w-fit">
                        {{ $product->category ?? 'Product' }}
                    </span>
                    
                    <h1 class="text-3xl md:text-4xl font-extrabold text-gray-900 mb-4 leading-tight">
                        {{ $displayName }}
                    </h1>
                    
                    {{-- HARGA YANG SUDAH DIKONVERSI --}}
                    <div class="flex items-baseline mb-8">
                        <span class="text-3xl font-bold text-gray-900 mr-2">
                            {{ $currencySymbol }} {{ number_format($finalPrice, $decimal, ',', '.') }}
                        </span>
                        <span class="text-gray-500 font-medium">/ pcs</span>
                    </div>

                    <div class="border-t border-gray-100 my-6"></div>

                    <div class="prose prose-sm text-gray-600 leading-relaxed mb-8 text-justify flex-grow">
                        <h3 class="text-gray-900 font-semibold mb-2">
                            @if($locale == 'en') Description @elseif($locale == 'zh') 描述 @else Deskripsi @endif
                        </h3>
                        <p>
                            {!! nl2br(e($displayDesc ?? ($locale == 'en' ? 'Description not available.' : ($locale == 'zh' ? '暂无描述。' : 'Deskripsi produk belum tersedia.')))) !!}
                        </p>
                    </div>

                    <div class="flex flex-col sm:flex-row gap-4 mt-auto pt-6">
                        <a href="https://wa.me/6281234567890?text=Halo,%20saya%20tertarik%20dengan%20produk%20{{ urlencode($displayName) }}" target="_blank" class="flex-1 bg-green-600 text-white text-center py-4 rounded-xl font-bold hover:bg-green-700 hover:shadow-lg transition-all flex items-center justify-center gap-2 group">
                            <svg class="w-5 h-5 text-white group-hover:scale-110 transition-transform" fill="currentColor" viewBox="0 0 24 24"><path d="M.057 24l1.687-6.163c-1.041-1.804-1.588-3.849-1.587-5.946.003-6.556 5.338-11.891 11.893-11.891 3.181.001 6.167 1.24 8.413 3.488 2.245 2.248 3.481 5.236 3.48 8.414-.003 6.557-5.338 11.892-11.893 11.892-1.99-.001-3.951-.5-5.688-1.448l-6.305 1.654zm6.597-3.807c1.676.995 3.276 1.591 5.392 1.592 5.448 0 9.886-4.434 9.889-9.885.002-5.462-4.415-9.89-9.881-9.892-5.452 0-9.887 4.434-9.889 9.884-.001 2.225.651 3.891 1.746 5.634l-.999 3.648 3.742-.981zm11.387-5.464c-.074-.124-.272-.198-.57-.347-.297-.149-1.758-8.683-2.031-.967-.272-.297-.471-.446-1.634-.446-.372 0-.644.024-.99.149-.347.124-1.337 1.312-1.337 3.198 0 1.886 1.362 3.711 1.562 3.984.198.272 2.656 4.147 6.485 5.766.904.382 1.61.61 2.155.782 1.543.489 2.508.435 3.033.355.597-.091 1.884-.769 2.156-1.512.272-.743.272-1.387.198-1.512-.075-.124-.273-.198-.571-.347z"/></svg>
                            @if($locale == 'en') WhatsApp Us @elseif($locale == 'zh') WhatsApp 联系 @else Hubungi WhatsApp @endif
                        </a>
                        <a href="{{ route('order.create', ['product_id' => $product->id]) }}" class="flex-1 bg-white border-2 border-gray-800 text-gray-800 text-center py-4 rounded-xl font-bold hover:bg-gray-800 hover:text-white hover:shadow-lg transition-all flex items-center justify-center">
                            @if($locale == 'en') Order Now @elseif($locale == 'zh') 立即订购 @else Pesan Sekarang @endif
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection