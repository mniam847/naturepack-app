@extends('layouts.admin')

@section('title', 'Pengaturan Kurs')
@section('header_title', 'Pengaturan Nilai Tukar Mata Uang')

@section('content')
<div class="max-w-xl bg-white rounded-xl shadow-lg border border-gray-100 p-8">
    
    @if(session('success'))
        <div class="bg-green-100 text-green-700 p-3 rounded mb-4 text-sm font-bold">
            {{ session('success') }}
        </div>
    @endif

    <div class="mb-6 bg-blue-50 text-blue-800 p-4 rounded-lg text-sm">
        <p class="font-bold mb-1"><i class="fas fa-info-circle"></i> Info Konversi:</p>
        <p>Harga produk di website (IDR) akan dibagi dengan nilai kurs di bawah ini untuk pengunjung luar negeri.</p>
    </div>

    <form action="{{ route('admin.rates.update') }}" method="POST">
        @csrf
        @method('PUT')

        @foreach($rates as $rate)
            <div class="mb-5">
                <label class="block text-gray-700 font-bold mb-2">
                    1 {{ $rate->currency_code }} = Berapa Rupiah?
                </label>
                <div class="relative">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                        <span class="text-gray-500 font-bold">Rp</span>
                    </div>
                    <input type="number" step="0.01" name="rates[{{ $rate->currency_code }}]" 
                           value="{{ $rate->rate_in_idr }}" 
                           class="w-full pl-10 pr-4 py-3 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 text-lg font-semibold text-gray-800">
                </div>
                <p class="text-xs text-gray-500 mt-1">
                    Digunakan untuk pengunjung berbahasa 
                    @if($rate->currency_code == 'USD') Inggris 🇺🇸 @else Mandarin 🇨🇳 @endif
                </p>
            </div>
        @endforeach

        <div class="flex justify-end mt-8">
            <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-3 px-6 rounded-lg shadow transition flex items-center gap-2">
                <i class="fas fa-save"></i> Simpan Kurs Baru
            </button>
        </div>
    </form>
</div>
@endsection