<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'PackagingPro - Solusi Kemasan Custom')</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600;700&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Inter', sans-serif; }
    </style>
</head>
<body class="bg-gray-50 text-gray-800 flex flex-col min-h-screen">

    <div style="background: red; color: white; padding: 10px; text-align: center; font-weight: bold;">
        BAHASA SAAT INI: {{ app()->getLocale() }}
    </div>
    <nav class="bg-white shadow-sm fixed w-full z-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex items-center">
                <a href="{{ route('home') }}" class="flex items-center gap-2 text-2xl font-bold text-[#77C377]">
                    <img src="{{ asset('images/Logo Nature Pack.jpeg') }}" alt="Logo Nature Pack" class="h-10 w-auto"> 
                    Nature<span class="text">Pack</span>
                </a>
            </div>

            <div class="hidden md:flex space-x-8 items-center">
                
                <a href="{{ route('home') }}" class="{{ request()->routeIs('home') ? 'text-[#90EE90] font-bold' : 'text-gray-600 hover:text-[#90EE90] font-medium' }}">
                    {{ __('messages.home') }} 
                </a>

                <a href="{{ route('about') }}" class="{{ request()->routeIs('about') ? 'text-[#90EE90] font-bold' : 'text-gray-600 hover:text-[#90EE90] font-medium' }}">
                    {{ __('messages.about') }}
                </a>

                <a href="{{ route('products.index') }}" class="{{ request()->routeIs('products.*') ? 'text-[#90EE90] font-bold' : 'text-gray-600 hover:text-[#90EE90] font-medium' }}">
                    {{ __('messages.product') }}
                </a>

                <a href="{{ route('contact') }}" class="{{ request()->routeIs('contact') ? 'text-[#90EE90] font-bold' : 'text-gray-600 hover:text-[#90EE90] font-medium' }}">
                    {{ __('messages.contact') }}
                </a>

                <a href="{{ route('faq') }}" class="{{ request()->routeIs('faq') ? 'text-[#90EE90] font-bold' : 'text-gray-600 hover:text-[#90EE90] font-medium' }}">
                    {{ __('messages.faq') }}
                </a>

                @auth
                    <a href="{{ route('admin.dashboard') }}" class="text-red-600 font-bold hover:text-red-800">
                        Dashboard
                    </a>
                @endauth

                {{-- <a href="{{ route('order.create') }}" class="bg-blue-900 text-white px-5 py-2 rounded-full hover:bg-orange-500 transition duration-300 shadow-md">
                    {{ __('messages.order') }}
                </a> --}}

                <div class="flex items-center space-x-3 ml-6">
                    <a href="{{ route('lang.switch', 'id') }}" class="text-2xl hover:scale-125 transition duration-200 cursor-pointer" title="Indonesia">🇮🇩</a>
                    <a href="{{ route('lang.switch', 'en') }}" class="text-2xl hover:scale-125 transition duration-200 cursor-pointer" title="English">🇺🇸</a>
                    <a href="{{ route('lang.switch', 'zh') }}" class="text-2xl hover:scale-125 transition duration-200 cursor-pointer" title="Mandarin">🇨🇳</a>
                </div>
            </div>
        </div>
    </div>
</nav>

    <main class="flex-grow pt-16">
        @yield('content')
    </main>

    <footer class="bg-gray-900 text-white mt-12">
        <div class="max-w-7xl mx-auto px-4 py-8 sm:px-6 lg:px-8 grid grid-cols-1 md:grid-cols-3 gap-8">
            <div>
                <h3 class="text-lg font-bold mb-4">BoxCustom</h3>
                <p class="text-gray-400 text-sm">{{ __('messages.footer_desc') }}.</p>
            </div>
            <div>
                <h3 class="text-lg font-bold mb-4">{{ __('messages.nav_header') }}</h3>
                <ul class="text-gray-400 text-sm space-y-2">
                    <li><a href="#" class="hover:text-white">{{ __('messages.catalog_product') }}</a></li>
                    <li><a href="#" class="hover:text-white">{{ __('messages.nav_check_status') }}</a></li>
                    <li><a href="#" class="hover:text-white">Shipping Info</a></li>
                </ul>
            </div>
            <div>
                <h3 class="text-lg font-bold mb-4">{{ __('messages.contact_header') }}</h3>
                <p class="text-gray-400 text-sm">WhatsApp: +62 812-3456-7890</p>
                <p class="text-gray-400 text-sm">Email: sales@boxcustom.com</p>
            </div>
        </div>
        <div class="bg-gray-800 py-4 text-center text-gray-500 text-xs">
            &copy; 2026 BoxCustom Packaging. All rights reserved.
        </div>
    </footer>

</body>
</html>