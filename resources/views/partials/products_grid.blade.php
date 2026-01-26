@php
    $locale = app()->getLocale();
@endphp

@forelse($products as $product)
    @php
        // LOGIKA BAHASA
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

    <div class="bg-white rounded-xl shadow-md overflow-hidden hover:shadow-xl transition-shadow duration-300 group flex flex-col h-full">
        
        {{-- AREA GAMBAR SLIDER (CAROUSEL) --}}
        {{-- x-data mendefinisikan state lokal untuk slider ini --}}
        <div class="relative h-64 bg-gray-50 group-slider" x-data="{ activeSlide: 0 }">
            
            {{-- CONTAINER GAMBAR (BERGERAK) --}}
            <div class="flex h-full transition-transform duration-500 ease-in-out"
                 :style="'transform: translateX(-' + (activeSlide * 100) + '%)'">
                
                {{-- GAMBAR 1 --}}
                <div class="w-full h-full flex-shrink-0 flex items-center justify-center p-4">
                    <img 
                        src="{{ $product->image ? asset('uploads/products/' . $product->image) : 'https://via.placeholder.com/400x300?text=No+Image' }}" 
                        alt="{{ $displayName }}" 
                        class="w-full h-full object-contain"
                    >
                </div>

                {{-- GAMBAR 2 (Hanya dirender jika ada) --}}
                @if($product->image2)
                <div class="w-full h-full flex-shrink-0 flex items-center justify-center p-4">
                    <img 
                        src="{{ asset('uploads/products/' . $product->image2) }}" 
                        alt="{{ $displayName }} 2" 
                        class="w-full h-full object-contain"
                    >
                </div>
                @endif
            </div>

            {{-- TOMBOL NAVIGASI (HANYA JIKA ADA IMAGE 2) --}}
            @if($product->image2)
                {{-- Tombol Kiri --}}
                <button 
                    @click.prevent="activeSlide = 0" 
                    x-show="activeSlide === 1"
                    class="absolute left-2 top-1/2 -translate-y-1/2 bg-white/80 hover:bg-white text-gray-800 p-2 rounded-full shadow-md z-20 transition-opacity"
                    aria-label="Previous Image"
                >
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path></svg>
                </button>

                {{-- Tombol Kanan --}}
                <button 
                    @click.prevent="activeSlide = 1" 
                    x-show="activeSlide === 0"
                    class="absolute right-2 top-1/2 -translate-y-1/2 bg-white/80 hover:bg-white text-gray-800 p-2 rounded-full shadow-md z-20 transition-opacity"
                    aria-label="Next Image"
                >
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
                </button>
            
                {{-- Indikator Titik (Opsional, biar manis) --}}
                <div class="absolute bottom-2 left-0 right-0 flex justify-center space-x-2">
                    <div class="w-2 h-2 rounded-full transition-colors duration-300" :class="activeSlide === 0 ? 'bg-green-600' : 'bg-gray-300'"></div>
                    <div class="w-2 h-2 rounded-full transition-colors duration-300" :class="activeSlide === 1 ? 'bg-green-600' : 'bg-gray-300'"></div>
                </div>
            @endif

            {{-- BADGE READY STOCK --}}
            @if($product->is_ready_stock)
                <span class="absolute top-4 right-4 bg-green-500 text-white text-xs font-bold px-3 py-1 rounded-full shadow-lg z-10">
                    @if($locale == 'en') READY STOCK 
                    @elseif($locale == 'zh') 现货 
                    @else READY STOCK 
                    @endif
                </span>
            @endif
        </div>

        <div class="p-6 flex-grow flex flex-col justify-between">
            <div>
                <h3 class="text-xl font-bold text-gray-800 mb-2 group-hover:text-green-600 transition-colors">
                    {{ $displayName }}
                </h3>
                <p class="text-gray-500 text-sm mb-4 line-clamp-2">
                    {{ $displayDesc ?? ($locale == 'en' ? 'No description available.' : ($locale == 'zh' ? '暂无描述。' : 'Deskripsi belum tersedia.')) }}
                </p>
            </div>
            
            <div class="mt-4 pt-4 border-t border-gray-100 flex items-center justify-between">
                <div>
                    <p class="text-xs text-gray-500">
                        @if($locale == 'en') Starting from 
                        @elseif($locale == 'zh') 起价 
                        @else Mulai dari 
                        @endif
                    </p>
                    
                    {{-- Harga menggunakan number_format agar aman --}}
                    <p class="text-green-600 font-bold">
                        Rp {{ number_format($product->price_min ?? 0, 0, ',', '.') }}
                    </p>
                </div>
            </div>

            <div class="mt-6 grid grid-cols-2 gap-3">
                <a href="{{ route('products.show', $product->id) }}" class="flex justify-center items-center px-4 py-2 border-2 border-green-500 text-green-600 font-semibold rounded-lg hover:bg-green-50 transition text-sm">
                    @if($locale == 'en') View Detail 
                    @elseif($locale == 'zh') 查看详情 
                    @else Lihat Detail 
                    @endif
                </a>
                <a href="{{ route('order.create', ['product_id' => $product->id]) }}" class="flex justify-center items-center px-4 py-2 bg-green-600 text-white font-semibold rounded-lg hover:bg-green-700 transition text-sm shadow-md">
                    @if($locale == 'en') Order 
                    @elseif($locale == 'zh') 订购 
                    @else Pesan 
                    @endif
                </a>
            </div>
        </div>
    </div>
@empty
    <div class="col-span-full text-center py-12">
        <svg class="w-16 h-16 text-gray-300 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
        </svg>
        <h3 class="text-lg font-medium text-gray-900">
            @if($locale == 'en') Product not found 
            @elseif($locale == 'zh') 未找到产品 
            @else Produk tidak ditemukan 
            @endif
        </h3>
    </div>
@endforelse