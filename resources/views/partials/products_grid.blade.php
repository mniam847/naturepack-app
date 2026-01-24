{{-- 1. AMBIL LOCALE --}}
@php
    $locale = session('locale', 'id');
@endphp

@forelse($products as $product)
    @php
        // 2. LOGIKA PILIH KOLOM BAHASA (NAMA & DESKRIPSI)
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
        
        <div class="relative overflow-hidden h-64 bg-gray-50 flex items-center justify-center p-4">
            <img 
                src="{{ $product->image ? asset('uploads/products/' . $product->image) : 'https://via.placeholder.com/400x300?text=No+Image' }}" 
                alt="{{ $displayName }}" 
                class="w-full h-full object-contain group-hover:scale-105 transition-transform duration-500"
            >
            @if($product->is_ready_stock)
                <span class="absolute top-4 right-4 bg-green-500 text-white text-xs font-bold px-3 py-1 rounded-full shadow-lg">
                    @if($locale == 'en') READY STOCK @elseif($locale == 'zh') 现货 @else READY STOCK @endif
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
                        @if($locale == 'en') Starting from @elseif($locale == 'zh') 起价 @else Mulai dari @endif
                    </p>
                    <p class="text-green-600 font-bold">
                        {{-- {{ formatCurrency($product->price_min) }} --}}
                        {{ Illuminate\Support\Number::currency($product->price_min, 'IDR', 'id') }}
                    </p>
                </div>
            </div>

            <div class="mt-6 grid grid-cols-2 gap-3">
                <a href="{{ route('products.show', $product->id) }}" class="flex justify-center items-center px-4 py-2 border-2 border-green-500 text-green-600 font-semibold rounded-lg hover:bg-green-50 transition text-sm">
                    @if($locale == 'en') View Detail @elseif($locale == 'zh') 查看详情 @else Lihat Detail @endif
                </a>
                <a href="{{ route('order.create', ['product_id' => $product->id]) }}" class="flex justify-center items-center px-4 py-2 bg-green-600 text-white font-semibold rounded-lg hover:bg-green-700 transition text-sm shadow-md">
                    @if($locale == 'en') Order @elseif($locale == 'zh') 订购 @else Pesan @endif
                </a>
            </div>
        </div>
    </div>
@empty
    <div class="col-span-full text-center py-12">
        <h3 class="text-lg font-medium text-gray-900">
            @if($locale == 'en') Product not found @elseif($locale == 'zh') 未找到产品 @else Produk tidak ditemukan @endif
        </h3>
    </div>
@endforelse