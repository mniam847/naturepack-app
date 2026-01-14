<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel - BoxCustom</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body class="bg-gray-100 font-sans">

    <div class="flex h-screen overflow-hidden">
        
        <div class="w-64 bg-slate-900 text-white flex flex-col">
            <div class="h-16 flex items-center justify-center border-b border-slate-700">
                <h1 class="text-xl font-bold text-orange-500">BoxCustom<span class="text-white text-sm">Admin</span></h1>
            </div>
            
            <nav class="flex-1 overflow-y-auto py-4">
                <ul class="space-y-1">
                    <li>
                        <a href="{{ route('admin.dashboard') }}" class="flex items-center px-6 py-3 hover:bg-slate-800 {{ request()->routeIs('admin.dashboard') ? 'bg-slate-800 border-l-4 border-orange-500' : '' }}">
                            <i class="fas fa-home w-6"></i>
                            <span>Dashboard Pesanan</span>
                        </a>
                    </li>

                    <li>
                        <a href="{{ route('admin.users') }}" class="flex items-center px-6 py-3 hover:bg-slate-800 {{ request()->routeIs('admin.users') ? 'bg-slate-800 border-l-4 border-orange-500' : '' }}">
                            <i class="fas fa-users w-6"></i>
                            <span>Kelola Admin</span>
                        </a>
                    </li>

                    <li>
                        <a href="{{ route('admin.settings') }}" class="flex items-center px-6 py-3 hover:bg-slate-800 {{ request()->routeIs('admin.settings') ? 'bg-slate-800 border-l-4 border-orange-500' : '' }}">
                            <i class="fas fa-key w-6"></i>
                            <span>Ganti Password</span>
                        </a>
                    </li>
                </ul>
            </nav>

            <div class="p-4 border-t border-slate-700 bg-slate-900">
                <div class="text-sm text-gray-400 mb-2">Halo, {{ Auth::user()->name }}</div>
                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button type="submit" class="w-full bg-red-600 hover:bg-red-700 text-white py-2 rounded text-sm transition">
                        <i class="fas fa-sign-out-alt mr-2"></i> Logout
                    </button>
                </form>
            </div>
        </div>

        <div class="flex-1 flex flex-col overflow-hidden">
            <header class="bg-white shadow-sm h-16 flex items-center justify-between px-6">
                <h2 class="text-gray-700 font-semibold text-lg">@yield('header')</h2>
                <a href="{{ route('home') }}" target="_blank" class="text-blue-600 text-sm hover:underline">Lihat Website &rarr;</a>
            </header>

            <main class="flex-1 overflow-x-hidden overflow-y-auto bg-gray-100 p-6">
                @if(session('success'))
                    <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-4" role="alert">
                        <p>{{ session('success') }}</p>
                    </div>
                @endif
                
                @if($errors->any())
                    <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 mb-4">
                        <ul>@foreach($errors->all() as $error) <li>• {{ $error }}</li> @endforeach</ul>
                    </div>
                @endif

                @yield('content')
            </main>
        </div>
    </div>
</body>
</html>