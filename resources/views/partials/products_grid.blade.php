@forelse($products as $product)
<div class="bg-white rounded-xl shadow-md overflow-hidden hover:shadow-xl transition-shadow duration-300 group flex flex-col h-full">
    
    <div class="relative overflow-hidden h-64 bg-gray-50 flex items-center justify-center p-4">
        <img 
            src="{{ $product->image ? asset('uploads/products/' . $product->image) : 'https://via.placeholder.com/400x300?text=No+Image' }}" 
            alt="{{ $product->name }}" 
            class="w-full h-full object-contain group-hover:scale-105 transition-transform duration-500"
        >
        @if($product->is_ready_stock)
            <span class="absolute top-4 right-4 bg-green-500 text-white text-xs font-bold px-3 py-1 rounded-full shadow-lg">READY STOCK</span>
        @endif
    </div>

    <div class="p-6 flex-grow flex flex-col justify-between">
        <div>
            <h3 class="text-xl font-bold text-gray-800 mb-2 group-hover:text-green-600 transition-colors">{{ $product->name }}</h3>
            <p class="text-gray-500 text-sm mb-4 line-clamp-2">{{ $product->description ?? 'Deskripsi belum tersedia.' }}</p>
        </div>
        
        <div class="mt-4 pt-4 border-t border-gray-100 flex items-center justify-between">
            <div>
                <p class="text-xs text-gray-500">Mulai dari</p>
                <p class="text-lg font-bold text-green-600">Rp {{ number_format($product->price_min, 0, ',', '.') }}</p>
            </div>
        </div>

        <div class="mt-6 grid grid-cols-2 gap-3">
            <a href="{{ route('products.show', $product->id) }}" class="flex justify-center items-center px-4 py-2 border-2 border-green-500 text-green-600 font-semibold rounded-lg hover:bg-green-50 transition text-sm">Lihat Detail</a>
            <a href="{{ route('order.create', ['product_id' => $product->id]) }}" class="flex justify-center items-center px-4 py-2 bg-green-600 text-white font-semibold rounded-lg hover:bg-green-700 transition text-sm shadow-md">Pesan</a>
        </div>
    </div>
</div>
@empty
<div class="col-span-full text-center py-12">
    <h3 class="text-lg font-medium text-gray-900">Produk tidak ditemukan</h3>
</div>
@endforelse