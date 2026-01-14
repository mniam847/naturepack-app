@extends('layouts.app')

@section('content')

<section class="bg-blue-900 text-white py-20 lg:py-32 relative overflow-hidden">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10 text-center">
        <h1 class="text-4xl md:text-6xl font-bold text-white mb-4 tracking-tight">
            {{ __('messages.welcome') }}
        </h1>

        <p class="text-lg md:text-xl text-blue-100 mb-8 max-w-2xl mx-auto">
            {{ __('messages.hero_desc') }}
        </p>

        <div class="flex flex-col sm:flex-row gap-4 justify-center">
            <a href="#" class="bg-orange-500 hover:bg-orange-600 text-white font-bold py-4 px-8 rounded-full transition duration-300 shadow-lg transform hover:-translate-y-1">
                {{ __('messages.btn_custom') }}
            </a>
            <a href="#" class="bg-transparent border-2 border-white text-white hover:bg-white hover:text-blue-900 font-bold py-4 px-8 rounded-full transition duration-300">
                {{ __('messages.btn_catalog') }}
            </a>
        </div>
    </div>
    <div class="absolute top-0 right-0 -mt-20 -mr-20 w-80 h-80 bg-blue-800 rounded-full opacity-50 blur-3xl"></div>
    <div class="absolute bottom-0 left-0 -mb-20 -ml-20 w-80 h-80 bg-orange-600 rounded-full opacity-20 blur-3xl"></div>
</section>

<section class="py-16 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-12">
            <h2 class="text-3xl font-bold text-gray-900">{{ __('messages.why_choose') }}</h2>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            <div class="p-6 border border-gray-100 rounded-xl shadow-sm hover:shadow-md transition text-center">
                <div class="w-14 h-14 bg-blue-100 text-blue-600 rounded-full flex items-center justify-center mx-auto mb-4">
                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path></svg>
                </div>
                <h3 class="text-xl font-bold mb-2">{{ __('messages.feat_1_title') }}</h3>
                <p class="text-gray-600">{{ __('messages.feat_1_desc') }}.</p>
            </div>
            <div class="p-6 border border-gray-100 rounded-xl shadow-sm hover:shadow-md transition text-center">
                <div class="w-14 h-14 bg-green-100 text-green-600 rounded-full flex items-center justify-center mx-auto mb-4">
                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                </div>
                <h3 class="text-xl font-bold mb-2">{{ __('messages.feat_2_title') }}</h3>
                <p class="text-gray-600">{{ __('messages.feat_2_desc') }}.</p>
            </div>
            <div class="p-6 border border-gray-100 rounded-xl shadow-sm hover:shadow-md transition text-center">
                <div class="w-14 h-14 bg-orange-100 text-orange-600 rounded-full flex items-center justify-center mx-auto mb-4">
                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                </div>
                <h3 class="text-xl font-bold mb-2">{{ __('messages.feat_3_title') }}</h3>
                <p class="text-gray-600">{{ __('messages.feat_3_desc') }}.</p>
            </div>
        </div>
    </div>
</section>

<section class="py-16 bg-gray-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-12">
            <h2 class="text-3xl font-bold text-gray-900">{{ __('messages.how_to_order') }}</h2>
            <p class="text-gray-500 mt-2">{{ __('messages.how_to_desc') }}</p>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-4 gap-4 text-center">
            <div class="relative">
                <div class="text-4xl font-bold text-blue-200 mb-2">01</div>
                <h4 class="font-bold text-lg">{{ __('messages.step_1') }}</h4>
                <p class="text-sm text-gray-600">{{ __('messages.step_1_desc') }}.</p>
            </div>
            <div class="relative">
                <div class="text-4xl font-bold text-blue-200 mb-2">02</div>
                <h4 class="font-bold text-lg">{{ __('messages.step_2') }}</h4>
                <p class="text-sm text-gray-600">{{ __('messages.step_2_desc') }}.</p>
            </div>
            <div class="relative">
                <div class="text-4xl font-bold text-blue-200 mb-2">03</div>
                <h4 class="font-bold text-lg">{{ __('messages.step_3') }}</h4>
                <p class="text-sm text-gray-600">{{ __('messages.step_3_desc') }}.</p>
            </div>
            <div class="relative">
                <div class="text-4xl font-bold text-blue-200 mb-2">04</div>
                <h4 class="font-bold text-lg">{{ __('messages.step_4') }}</h4>
                <p class="text-sm text-gray-600">{{ __('messages.step_4_desc') }}.</p>
            </div>
        </div>
    </div>
</section>

<section class="py-16 bg-white" id="katalog">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            
            <div class="flex justify-between items-end mb-8">
                <div>
                    <h2 class="text-3xl font-bold text-gray-900">{{ __('messages.popular_catalog') }}</h2>
                    <p class="text-gray-500">{{ __('messages.catalog_desc') }}</p>
                </div>
                <a href="#" class="text-blue-600 font-semibold hover:underline">{{ __('messages.view_all') }} -></a>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8">
                @foreach($featured_products as $product)
                <div class="group border rounded-lg overflow-hidden hover:shadow-lg transition bg-white flex flex-col h-full">
                    
                    <div class="w-full bg-gray-100 relative">
                        <img 
                            src="{{ asset($product->image) }}" 
                            alt="{{ $product->name }}" 
                            class="w-full transition duration-300 group-hover:scale-105"
                            style="height: 250px; width: 100%; object-fit: cover; object-position: center;"
                        >
                        <span class="absolute top-2 right-2 bg-white text-xs font-bold px-2 py-1 rounded shadow text-gray-800">
                            {{ $product->category }}
                        </span>
                    </div>
                    
                    <div class="p-5 flex flex-col flex-grow">
                        <h3 class="text-lg font-bold text-gray-800 mb-1">{{ $product->name }}</h3>
                        <p class="text-blue-900 font-medium mb-4">{{ __('messages.start_from') }} {{ number_format($product->price_min, 0, ',', '.') }} / pcs</p>
                        
                        <div class="mt-auto">
                            <a href="{{ route('order.create') }}" class="block w-full text-center border-2 border-blue-900 text-blue-900 py-2 rounded-lg font-semibold hover:bg-blue-900 hover:text-white transition">
                                Pesan Sekarang
                            </a>
                            <a href="{{ route('product.show', $product->id) }}" class="block w-full text-center border-2 border-blue-900 text-blue-900 py-2 rounded-lg font-semibold hover:bg-blue-900 hover:text-white transition">
                                Detail Produk
                            </a>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>

        </div>
    </section>

<section class="bg-orange-500 py-12">
    <div class="max-w-7xl mx-auto px-4 text-center">
        <h2 class="text-white text-2xl md:text-3xl font-bold mb-4">{{ __('messages.cta_title') }}</h2>
        <p class="text-white opacity-90 mb-8">{{ __('messages.cta_desc') }}.</p>
        <a href="https://wa.me/628123456789" class="bg-white text-orange-600 px-8 py-3 rounded-full font-bold shadow-lg hover:bg-gray-100 transition inline-flex items-center gap-2">
            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M.057 24l1.687-6.163c-1.041-1.804-1.588-3.849-1.587-5.946.003-6.556 5.338-11.891 11.893-11.891 3.181.001 6.167 1.24 8.413 3.488 2.245 2.248 3.481 5.236 3.48 8.414-.003 6.557-5.338 11.892-11.893 11.892-1.99-.001-3.951-.5-5.688-1.448l-6.305 1.654zm6.597-3.807c1.676.995 3.276 1.591 5.392 1.592 5.448 0 9.886-4.434 9.889-9.885.002-5.462-4.415-9.89-9.881-9.892-5.452 0-9.887 4.434-9.889 9.884-.001 2.225.651 3.891 1.746 5.634l-.999 3.648 3.742-.981zm11.387-5.464c-.074-.124-.272-.198-.57-.347-.297-.149-1.758-.868-2.031-.967-.272-.099-.47-.149-.669.149-.198.297-.768.967-.941 1.165-.173.198-.347.223-.644.074-.297-.149-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.297-.347.446-.521.151-.172.2-.296.3-.495.099-.198.05-.372-.025-.521-.075-.148-.669-1.611-.916-2.206-.242-.579-.487-.501-.669-.51l-.57-.01c-.198 0-.52.074-.792.372s-1.04 1.016-1.04 2.479 1.065 2.876 1.213 3.074c.149.198 2.095 3.2 5.076 4.487.709.306 1.263.489 1.694.626.712.226 1.36.194 1.872.118.571-.085 1.758-.719 2.006-1.413.248-.695.248-1.29.173-1.414z"/></svg>
            {{ __('messages.btn_wa') }}
        </a>
    </div>
</section>

@endsection