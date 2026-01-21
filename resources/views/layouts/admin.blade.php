<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Admin Panel') - BoxCustom</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Inter', sans-serif; }
    </style>
</head>
<body class="bg-gray-100">

<div class="flex h-screen overflow-hidden">

    <aside class="w-64 bg-slate-900 text-white flex flex-col fixed h-full transition-all duration-300 z-20">
        <div class="h-16 flex items-center justify-center border-b border-slate-800">
            <img src="{{ asset('images/Logo Nature Pack.jpeg') }}" alt="Logo Nature Pack" class="h-10 w-auto"> 
        </div>

        <nav class="flex-1 overflow-y-auto py-4">
            <ul class="space-y-1 px-2">
                <li>
                    <a href="{{ route('admin.dashboard') }}" class="flex items-center gap-3 px-4 py-3 {{ request()->routeIs('admin.dashboard') ? 'bg-green-600 text-white' : 'text-slate-300 hover:bg-slate-800' }} rounded-lg transition-colors">
                        <i class="fas fa-home w-5 text-center"></i>
                        <span class="font-medium">Dashboard</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('admin.products') }}" class="flex items-center gap-3 px-4 py-3 {{ request()->routeIs('admin.products*') ? 'bg-green-600 text-white' : 'text-slate-300 hover:bg-slate-800' }} rounded-lg transition-colors">
                        <i class="fas fa-box w-5 text-center"></i>
                        <span class="font-medium">Produk</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('admin.orders') }}" class="flex items-center gap-3 px-4 py-3 {{ request()->routeIs('admin.orders*') ? 'bg-green-600 text-white' : 'text-slate-300 hover:bg-slate-800' }} rounded-lg transition-colors">
                        <i class="fas fa-shopping-cart w-5 text-center"></i>
                        <span class="font-medium">Pesanan</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('admin.faqs') }}" class="flex items-center px-4 py-3 {{ request()->routeIs('admin.faqs*') ? 'bg-slate-800 border-l-4 border-blue-500' : 'hover:bg-slate-800' }} transition-colors">
                        <i class="fas fa-question-circle w-6 text-center"></i>
                        <span class="ml-2 font-medium">FAQ / Bantuan</span>
                    </a>
                </li>
                <div class="my-4 border-t border-slate-800 mx-4"></div>
                
                <li>
                    <a href="{{ route('admin.users') }}" class="flex items-center gap-3 px-4 py-3 {{ request()->routeIs('admin.users') ? 'bg-green-600 text-white' : 'text-slate-300 hover:bg-slate-800' }} rounded-lg transition-colors">
                        <i class="fas fa-users-cog w-5 text-center"></i>
                        <span class="font-medium">Kelola Admin</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('admin.settings') }}" class="flex items-center gap-3 px-4 py-3 {{ request()->routeIs('admin.settings') ? 'bg-green-600 text-white' : 'text-slate-300 hover:bg-slate-800' }} rounded-lg transition-colors">
                        <i class="fas fa-lock w-5 text-center"></i>
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
                <h2 class="text-xl font-bold text-gray-800">@yield('header_title', 'Dashboard')</h2>
                <p class="text-sm text-gray-500">Halo, {{ Auth::user()->name ?? 'Admin' }}!</p>
            </div>
            
            <div class="flex items-center gap-4">
                <div class="w-10 h-10 bg-green-100 rounded-full flex items-center justify-center text-green-600 font-bold border border-green-200">
                    {{ substr(Auth::user()->name ?? 'A', 0, 1) }}
                </div>
            </div>
        </header>

        <div class="p-8">
            @yield('content')
        </div>

    </main>
</div>

</body>
</html>