@extends('layouts.admin')

@section('header', 'Dashboard Pesanan Masuk')

@section('content')
<div class="max-w-7xl mx-auto px-4 py-12 mt-20">
    <div class="flex justify-between items-center mb-6">
        <div>
            <h1 class="text-3xl font-bold text-gray-800">Dashboard Admin</h1>
            <p class="text-gray-600">Halo, {{ Auth::user()->name }}!</p>
        </div>
        
        <div class="flex space-x-3">
            <a href="{{ route('home') }}" target="_blank" class="bg-gray-500 text-white px-4 py-2 rounded shadow hover:bg-gray-600 transition">
                Lihat Website
            </a>
            
            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <a href="{{ route('product.create') }}" class="bg-green-600 text-white px-4 py-2 rounded shadow hover:bg-green-700 transition ml-3">
                    + Tambah Produk
                </a>
                <button type="submit" class="bg-red-600 text-white px-4 py-2 rounded shadow hover:bg-red-700 transition">
                    Logout
                </button>
            </form>
        </div>
    </div>

    <div class="bg-white shadow-md rounded-lg overflow-hidden">
        <table class="min-w-full leading-normal">
            <thead>
                <tr>
                    <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                        Tanggal
                    </th>
                    <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                        Pemesan
                    </th>
                    <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                        Spesifikasi (PxLxT)
                    </th>
                    <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                        Jumlah
                    </th>
                    <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                        Desain
                    </th>
                    <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                        Status
                    </th>
                </tr>
            </thead>
            <tbody>
                @foreach($orders as $order)
                <tr>
                    <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                        <p class="text-gray-900 whitespace-no-wrap">{{ \Carbon\Carbon::parse($order->created_at)->format('d M Y') }}</p>
                        <p class="text-gray-500 text-xs">{{ \Carbon\Carbon::parse($order->created_at)->format('H:i') }} WIB</p>
                    </td>
                    <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                        <p class="text-gray-900 whitespace-no-wrap font-bold">{{ $order->customer_name }}</p>
                        <p class="text-gray-500">{{ $order->customer_whatsapp }}</p>
                    </td>
                    <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                        <p class="text-gray-900 whitespace-no-wrap">
                            {{ $order->length }}x{{ $order->width }}x{{ $order->height }} cm
                        </p>
                        <p class="text-gray-500 text-xs">Bahan: {{ $order->material }}</p>
                    </td>
                    <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                        <span class="relative inline-block px-3 py-1 font-semibold text-green-900 leading-tight">
                            <span aria-hidden class="absolute inset-0 bg-green-200 opacity-50 rounded-full"></span>
                            <span class="relative">{{ $order->quantity }} pcs</span>
                        </span>
                    </td>
                    <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                        @if($order->design_file)
                            <a href="{{ asset('uploads/designs/' . $order->design_file) }}" target="_blank" class="text-blue-600 hover:text-blue-900 underline">
                                Lihat File
                            </a>
                        @else
                            <span class="text-gray-400">Tidak ada file</span>
                        @endif
                    </td>
                    <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                        <form action="{{ route('order.update', $order->id) }}" method="POST">
                            @csrf
                            @method('PUT') <select name="status" onchange="this.form.submit()" class="block w-full bg-white border border-gray-300 hover:border-gray-500 px-2 py-1 rounded shadow leading-tight focus:outline-none focus:shadow-outline text-xs">
                                <option value="Menunggu Konfirmasi" {{ $order->status == 'Menunggu Konfirmasi' ? 'selected' : '' }}>Menunggu</option>
                                <option value="Sedang Diproduksi" {{ $order->status == 'Sedang Diproduksi' ? 'selected' : '' }}>Diproduksi</option>
                                <option value="Dalam Pengiriman" {{ $order->status == 'Dalam Pengiriman' ? 'selected' : '' }}>Dikirim</option>
                                <option value="Selesai" {{ $order->status == 'Selesai' ? 'selected' : '' }}>Selesai</option>
                            </select>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection