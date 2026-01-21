@extends('layouts.admin')

@section('title', 'Daftar Pesanan')
@section('header_title', 'Daftar Pesanan Masuk')

@section('content')
<div class="bg-white rounded-xl shadow-lg border border-gray-100 p-6">
    
    <div class="flex justify-between items-end mb-6">
        <div>
            <h3 class="text-lg font-bold text-gray-800">Riwayat Pesanan</h3>
            <p class="text-sm text-gray-500">Geser tabel ke samping untuk melihat detail lengkap.</p>
        </div>
        
        {{-- TOMBOL EXPORT EXCEL --}}
        <a href="{{ route('orders.export') }}" target="_blank" class="bg-green-600 hover:bg-green-700 text-white text-sm font-medium px-4 py-2 rounded-lg shadow flex items-center gap-2 transition">
            <i class="fas fa-file-excel"></i> Export Excel
        </a>
    </div>

    <div class="overflow-x-auto pb-4">
        <table class="w-full text-left border-collapse whitespace-nowrap">
            <thead>
                <tr class="bg-gray-50 text-gray-600 text-sm uppercase tracking-wider border-b-2 border-gray-200">
                    <th class="px-4 py-3 border-r w-16 text-center">No</th>
                    <th class="px-4 py-3 border-r">Tanggal</th>
                    <th class="px-4 py-3 border-r">Pelanggan</th>
                    <th class="px-4 py-3 border-r">Produk & Qty</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Spesifikasi</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">File Desain</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Catatan</th>
                    <th class="px-4 py-3 border-r">Status</th>
                    <th class="px-4 py-3">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-100 text-sm">
                @forelse($orders as $order)
                <tr class="hover:bg-gray-50 transition">
                    
                    {{-- 1. NOMOR URUT --}}
                    <td class="px-4 py-3 border-r text-center font-bold text-gray-700 align-top">
                        {{ $loop->iteration }}
                    </td>

                    {{-- 2. TANGGAL --}}
                    <td class="px-4 py-3 border-r text-gray-600 align-top">
                        {{ $order->created_at->format('d M Y') }}<br>
                        <span class="text-xs text-gray-400">{{ $order->created_at->format('H:i') }} WIB</span>
                    </td>

                    {{-- 3. DATA PELANGGAN --}}
                    <td class="px-4 py-3 border-r align-top">
                        <div class="font-bold text-gray-800">{{ $order->customer_name }}</div>
                        <div class="text-green-600 my-1 text-xs">
                            <i class="fab fa-whatsapp"></i> 
                            <a href="https://wa.me/{{ $order->customer_whatsapp }}" target="_blank" class="hover:underline">
                                {{ $order->customer_whatsapp }}
                            </a>
                        </div>
                        <div class="text-gray-500 text-xs">
                            {{ $order->email ?? '-' }}
                        </div>
                    </td>

                    {{-- 4. PRODUK --}}
                    <td class="px-4 py-3 border-r align-top">
                        <div class="font-semibold text-blue-600">
                            {{ $order->product ? $order->product->name : 'Produk Terhapus' }}
                        </div>
                        <div class="mt-1">
                            <span class="bg-blue-100 text-blue-800 text-xs font-semibold px-2.5 py-0.5 rounded">
                                Qty: {{ $order->quantity }}
                            </span>
                        </div>
                    </td>

                    {{-- 5. SPESIFIKASI --}}
                    <td class="px-4 py-3 border-r align-top">
                        <div class="text-xs">
                            <span class="text-gray-500">Bahan:</span> <b>{{ $order->material }}</b>
                        </div>
                        <div class="text-xs mt-1">
                            <span class="text-gray-500">Dimensi:</span><br>
                            <span class="font-mono text-gray-700 font-bold">
                                {{ $order->length }}x{{ $order->width }}x{{ $order->height }} cm
                            </span>
                        </div>
                    </td>

                    {{-- 6. FILE DESAIN --}}
                    <td class="px-4 py-3 whitespace-nowrap align-top border-r">
                        @if($order->design_file)
                            <a href="{{ asset('uploads/designs/' . $order->design_file) }}" target="_blank" class="inline-flex items-center px-3 py-1.5 bg-indigo-100 text-indigo-700 rounded-lg text-xs font-bold hover:bg-indigo-200 transition">
                                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"></path></svg>
                                Lihat File
                            </a>
                            <div class="text-[10px] text-gray-400 mt-1 truncate max-w-[100px]" title="{{ $order->design_file }}">
                                {{ $order->design_file }}
                            </div>
                        @else
                            <span class="text-gray-400 text-sm italic">Tidak ada file</span>
                        @endif
                    </td>

                    {{-- 7. CATATAN --}}
                    <td class="px-4 py-3 border-r align-top whitespace-normal min-w-[200px]">
                        @if($order->notes)
                            <div class="bg-yellow-50 p-2 rounded border border-yellow-200 text-gray-600 text-xs italic">
                                "{{ $order->notes }}"
                            </div>
                        @else
                            <span class="text-gray-300">-</span>
                        @endif
                    </td>

                    {{-- 8. STATUS (BADGE) --}}
                    <td class="px-4 py-3 border-r align-top">
                        @php
                            $color = match($order->status) {
                                'pending', 'Menunggu Konfirmasi' => 'bg-yellow-100 text-yellow-800',
                                'Diproses' => 'bg-blue-100 text-blue-800',
                                'Selesai' => 'bg-green-100 text-green-800',
                                'Dibatalkan' => 'bg-red-100 text-red-800',
                                default => 'bg-gray-100 text-gray-800',
                            };
                        @endphp
                        <span class="{{ $color }} px-2 py-1 rounded-md text-xs font-bold">
                            {{ $order->status }}
                        </span>
                    </td>

                    {{-- 9. UPDATE STATUS (DROPDOWN) --}}
                    <td class="px-4 py-3 align-top">
                        <form action="{{ route('order.update', $order->id) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <select name="status" onchange="this.form.submit()" class="bg-white border border-gray-300 text-gray-700 text-xs rounded focus:ring-blue-500 focus:border-blue-500 block w-full p-1 cursor-pointer">
                                <option value="Menunggu Konfirmasi" {{ $order->status == 'Menunggu Konfirmasi' ? 'selected' : '' }}>Menunggu</option>
                                <option value="Diproses" {{ $order->status == 'Diproses' ? 'selected' : '' }}>Diproses</option>
                                <option value="Selesai" {{ $order->status == 'Selesai' ? 'selected' : '' }}>Selesai</option>
                                <option value="Dibatalkan" {{ $order->status == 'Dibatalkan' ? 'selected' : '' }}>Batal</option>
                            </select>
                        </form>
                    </td>

                </tr>
                @empty
                <tr>
                    <td colspan="9" class="px-4 py-8 text-center text-gray-500">
                        Belum ada pesanan masuk.
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    @if(isset($orders) && method_exists($orders, 'links'))
        <div class="mt-4">
            {{ $orders->links() }}
        </div>
    @endif

</div>
@endsection