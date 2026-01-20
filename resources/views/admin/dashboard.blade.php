<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Admin - BoxCustom</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Inter', sans-serif; }
    </style>
</head>
<body class="bg-gray-100">

<div class="flex h-screen overflow-hidden">

    <aside class="w-64 bg-slate-900 text-white flex flex-col fixed h-full transition-all duration-300 z-20" id="sidebar">
        <div class="h-16 flex items-center justify-center border-b border-slate-800">
            <h1 class="text-2xl font-bold text-green-500">Box<span class="text-white">Custom</span></h1>
        </div>

        <nav class="flex-1 overflow-y-auto py-4">
            <ul class="space-y-1 px-2">
                
                <li>
                    <a href="{{ route('admin.dashboard') }}" class="flex items-center gap-3 px-4 py-3 bg-green-600 text-white rounded-lg transition-colors">
                        <i class="fas fa-home w-5 text-center"></i>
                        <span class="font-medium">Dashboard</span>
                    </a>
                </li>

                <li>
                    <a href="{{ route('admin.products') }}" class="flex items-center gap-3 px-4 py-3 text-slate-300 hover:bg-slate-800 hover:text-white rounded-lg transition-colors group">
                        <i class="fas fa-box w-5 text-center group-hover:text-green-400"></i>
                        <span class="font-medium">Produk</span>
                    </a>
                </li>

                <li>
                    <a href="{{ route('admin.orders') }}" class="flex items-center justify-between px-4 py-3 text-slate-300 hover:bg-slate-800 hover:text-white rounded-lg transition-colors group">
                        <div class="flex items-center gap-3">
                            <i class="fas fa-shopping-cart w-5 text-center group-hover:text-green-400"></i>
                            <span class="font-medium">Pesanan</span>
                        </div>
                        @if(isset($pendingOrders) && $pendingOrders > 0)
                            <span class="bg-red-500 text-white text-xs font-bold px-2 py-0.5 rounded-full">{{ $pendingOrders }}</span>
                        @endif
                    </a>
                </li>

                <div class="my-4 border-t border-slate-800 mx-4"></div>
                <p class="px-6 text-xs font-semibold text-slate-500 uppercase tracking-wider mb-2">Admin Tools</p>

                <li>
                    <a href="{{ route('admin.users') }}" class="flex items-center gap-3 px-4 py-3 text-slate-300 hover:bg-slate-800 hover:text-white rounded-lg transition-colors group">
                        <i class="fas fa-users-cog w-5 text-center group-hover:text-green-400"></i>
                        <span class="font-medium">Kelola Admin</span>
                    </a>
                </li>

                <li>
                    <a href="{{ route('admin.settings') }}" class="flex items-center gap-3 px-4 py-3 text-slate-300 hover:bg-slate-800 hover:text-white rounded-lg transition-colors group">
                        <i class="fas fa-lock w-5 text-center group-hover:text-green-400"></i>
                        <span class="font-medium">Ganti Password</span>
                    </a>
                </li>
            </ul>
        </nav>

        <div class="p-4 border-t border-slate-800">
            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit" class="w-full flex items-center justify-center gap-2 bg-slate-800 hover:bg-red-600 text-slate-300 hover:text-white py-2.5 rounded-lg transition-all duration-300">
                    <i class="fas fa-sign-out-alt"></i>
                    <span class="font-medium">Logout</span>
                </button>
            </form>
        </div>
    </aside>

    <main class="flex-1 ml-64 h-full overflow-y-auto bg-gray-50">
        
        <header class="bg-white shadow-sm sticky top-0 z-10 px-8 py-4 flex justify-between items-center">
            <div>
                <h2 class="text-xl font-bold text-gray-800">Dashboard Overview</h2>
                <p class="text-sm text-gray-500">Selamat datang kembali, Admin!</p>
            </div>
            
            <div class="flex items-center gap-4">
                <div class="text-right hidden md:block">
                    <p class="text-sm font-semibold text-gray-800">{{ Auth::user()->name ?? 'Admin User' }}</p>
                    <p class="text-xs text-green-600">Administrator</p>
                </div>
                <div class="w-10 h-10 bg-green-100 rounded-full flex items-center justify-center text-green-600 font-bold border border-green-200">
                    {{ substr(Auth::user()->name ?? 'A', 0, 1) }}
                </div>
            </div>
        </header>

        <div class="p-8">
            
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

                <a href="{{ route('admin.products') }}" class="bg-green-600 rounded-xl p-6 shadow-sm text-white flex flex-col items-center justify-center hover:bg-green-700 transition cursor-pointer group">
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
                                Segera ubah status pesanan menjadi "Diproses" jika pembayaran sudah diterima agar pelanggan mendapat notifikasi.
                            </p>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </main>
</div>

</body>
</html>