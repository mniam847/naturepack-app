@extends('layouts.app')
@section('title', 'Informasi Pengiriman')

@section('content')
<div class="max-w-7xl mx-auto px-4 py-12 mt-10">
    <div class="bg-white p-8 rounded-lg shadow-md">
        <h1 class="text-3xl font-bold text-orange-600 mb-6">{{ __('messages.ship_title') }}</h1>
        
        <div class="grid md:grid-cols-2 gap-8">
            <div>
                <h3 class="font-bold text-lg mb-2">🚚 Ekspedisi Partner</h3>
                <ul class="list-disc pl-5 text-gray-700 space-y-2">
                    <li>JNE (Reguler/Cargo)</li>
                    <li>J&T Express</li>
                    <li>Dakota Cargo (Untuk pesanan besar)</li>
                    <li>Indah Cargo</li>
                </ul>
            </div>
            <div>
                <h3 class="font-bold text-lg mb-2">⏱️ Waktu Pengerjaan</h3>
                <p class="text-gray-700 mb-2"><strong>Ready Stock:</strong> Dikirim H+1 setelah pembayaran.</p>
                <p class="text-gray-700"><strong>Custom Order:</strong> Estimasi produksi 7-14 hari kerja tergantung jumlah dan antrian.</p>
            </div>
        </div>
    </div>
</div>
@endsection