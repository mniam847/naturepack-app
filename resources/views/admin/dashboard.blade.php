@extends('layouts.admin')

@section('title', 'Dashboard Overview')
@section('header_title', 'Dashboard Overview')

@section('content')
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
        
        <div class="bg-white rounded-xl p-6 shadow-sm border border-gray-100 relative overflow-hidden group hover:shadow-md transition">
            <div class="flex justify-between items-start">
                <div>
                    <p class="text-sm font-medium text-gray-500 mb-1">Total Pengunjung</p>
                    <h3 class="text-3xl font-bold text-gray-800">{{ number_format($totalVisitors ?? 0) }}</h3>
                    <p class="text-xs font-medium text-green-600 mt-2 flex items-center gap-1">
                        <i class="fas fa-arrow-up"></i> +{{ $todayVisitors ?? 0 }} Hari ini
                    </p>
                </div>
                <div class="p-3 bg-blue-50 text-blue-600 rounded-lg">
                    <i class="fas fa-eye text-xl"></i>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-xl p-6 shadow-sm border border-gray-100 relative overflow-hidden group hover:shadow-md transition">
            <div class="flex justify-between items-start">
                <div>
                    <p class="text-sm font-medium text-gray-500 mb-1">Pesanan Baru</p>
                    <h3 class="text-3xl font-bold text-gray-800">{{ $pendingOrders ?? 0 }}</h3>
                    <p class="text-xs text-gray-500 mt-2">Menunggu konfirmasi</p>
                </div>
                <div class="p-3 bg-yellow-50 text-yellow-600 rounded-lg relative">
                    <i class="fas fa-bell text-xl"></i>
                    @if(isset($pendingOrders) && $pendingOrders > 0)
                        <span class="absolute top-0 right-0 -mt-1 -mr-1 flex h-3 w-3">
                            <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-red-400 opacity-75"></span>
                            <span class="relative inline-flex rounded-full h-3 w-3 bg-red-500"></span>
                        </span>
                    @endif
                </div>
            </div>
        </div>

        <div class="bg-white rounded-xl p-6 shadow-sm border border-gray-100 relative overflow-hidden group hover:shadow-md transition">
            <div class="flex justify-between items-start">
                <div>
                    <p class="text-sm font-medium text-gray-500 mb-1">Total Pesanan</p>
                    <h3 class="text-3xl font-bold text-gray-800">{{ number_format($totalOrders ?? 0) }}</h3>
                    <p class="text-xs text-gray-500 mt-2">Sepanjang waktu</p>
                </div>
                <div class="p-3 bg-purple-50 text-purple-600 rounded-lg">
                    <i class="fas fa-shopping-bag text-xl"></i>
                </div>
            </div>
        </div>

        <a href="{{ route('product.create') }}" class="bg-green-600 rounded-xl p-6 shadow-sm text-white flex flex-col items-center justify-center hover:bg-green-700 transition cursor-pointer group">
            <div class="mb-2 p-3 bg-white/20 rounded-full group-hover:scale-110 transition-transform">
                <i class="fas fa-plus text-xl"></i>
            </div>
            <span class="font-semibold">Tambah Produk Baru</span>
        </a>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        <div class="lg:col-span-3 bg-white rounded-xl shadow-sm border border-gray-100 p-6">
            <div class="flex justify-between items-center mb-6">
                <h3 class="text-lg font-bold text-gray-800">Aktivitas Terbaru</h3>
                <a href="{{ route('admin.orders') }}" class="text-sm text-green-600 hover:underline">Lihat Semua Pesanan</a>
            </div>
            
            <div class="bg-blue-50 border border-blue-100 rounded-lg p-4 flex items-start gap-3">
                <i class="fas fa-info-circle text-blue-500 mt-1"></i>
                <div>
                    <h4 class="font-bold text-blue-800 text-sm">Tips Admin</h4>
                    <p class="text-sm text-blue-700 mt-1">
                        Pastikan untuk selalu memeriksa menu <strong>Pesanan</strong> setiap hari. 
                        Segera ubah status pesanan menjadi "Sedang Diproduksi" jika pembayaran sudah diterima.
                    </p>
                </div>
            </div>
        </div>
    </div>
@endsection