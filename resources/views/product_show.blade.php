@extends('layouts.app')

@section('title', $product->name)

@section('content')
<div class="py-12 bg-gray-50 min-h-screen mt-16">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        
        <a href="{{ route('home') }}" class="text-gray-500 hover:text-blue-900 mb-6 inline-block font-medium">
            &larr; Kembali ke Katalog
        </a>

        <div class="bg-white rounded-xl shadow-lg overflow-hidden flex flex-col md:flex-row">
            
            <div class="w-full md:w-1/2 bg-gray-100">
                <img src="{{ asset($product->image) }}" alt="{{ $product->name }}" class="w-full h-96 md:h-full object-cover object-center">
            </div>

            <div class="w-full md:w-1/2 p-8 md:p-12 flex flex-col justify-center">
                <span class="text-blue-600 font-bold tracking-wide uppercase text-sm mb-2">{{ $product->category }}</span>
                <h1 class="text-3xl md:text-4xl font-extrabold text-gray-900 mb-4">{{ $product->name }}</h1>
                
                <div class="text-2xl font-bold text-gray-900 mb-6">
                    Rp {{ number_format($product->price_min, 0, ',', '.') }} <span class="text-sm text-gray-500 font-normal">/ pcs</span>
                </div>

                <p class="text-gray-600 leading-relaxed mb-8">
                    {{ $product->description ?? 'Deskripsi produk belum tersedia.' }}
                </p>

                <div class="flex flex-col gap-4">
                    <a href="https://wa.me/6281234567890?text=Halo,%20saya%20mau%20pesan%20{{ $product->name }}" target="_blank" class="bg-green-600 text-white text-center py-3 rounded-lg font-bold hover:bg-green-700 transition flex items-center justify-center gap-2">
                        Pesan via WhatsApp
                    </a>
                    
                    <a href="{{ route('order.create') }}" class="border-2 border-blue-900 text-blue-900 text-center py-3 rounded-lg font-bold hover:bg-blue-900 hover:text-white transition">
                        Order Lewat Website
                    </a>
                </div>
            </div>

        </div>
    </div>
</div>
@endsection