<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'PackagingPro - Solusi Kemasan Custom')</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600;700&display=swap" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.2.1/flowbite.min.css" rel="stylesheet" />
    <style>
        body { font-family: 'Inter', sans-serif; }
    </style>
</head>
<body class="bg-gray-50 text-gray-800 flex flex-col min-h-screen">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.2.1/flowbite.min.js"></script>
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

                @php
                    $locales = [
                        'id' => ['flag' => '🇮🇩', 'label' => 'Indonesia'],
                        'en' => ['flag' => '🇺🇸', 'label' => 'English'],
                        'zh' => ['flag' => '🇨🇳', 'label' => 'Mandarin'],
                    ];
                    $currentLocale = app()->getLocale();
                    $currentFlag = $locales[$currentLocale]['flag'] ?? '🇮🇩'; // Default ke Indo jika null
                @endphp

                <div class="relative group ml-6">
                    
                    <button class="flex items-center space-x-2 text-gray-700 hover:text-gray-900 focus:outline-none">
                        <span class="text-2xl">{{ $currentFlag }}</span>
                        <svg class="w-4 h-4 fill-current text-gray-500 group-hover:rotate-180 transition duration-200" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                            <path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z"/>
                        </svg>
                    </button>

                    <div class="absolute right-0 mt-2 w-32 bg-white rounded-md shadow-xl z-50 invisible group-hover:visible opacity-0 group-hover:opacity-100 transition-all duration-200 transform origin-top-right">
                        <div class="py-1">
                            <a href="{{ route('lang.switch', 'id') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 flex items-center">
                                <span class="text-xl mr-2">🇮🇩</span> Indonesia
                            </a>
                            <a href="{{ route('lang.switch', 'en') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 flex items-center">
                                <span class="text-xl mr-2">🇺🇸</span> English
                            </a>
                            <a href="{{ route('lang.switch', 'zh') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 flex items-center">
                                <span class="text-xl mr-2">🇨🇳</span> 中国
                            </a>
                        </div>
                    </div>
                </div>

                {{-- <div class="flex items-center space-x-3 ml-6">
                    <a href="{{ route('lang.switch', 'id') }}" class="text-2xl hover:scale-125 transition duration-200 cursor-pointer" title="Indonesia">🇮🇩</a>
                    <a href="{{ route('lang.switch', 'en') }}" class="text-2xl hover:scale-125 transition duration-200 cursor-pointer" title="English">🇺🇸</a>
                    <a href="{{ route('lang.switch', 'zh') }}" class="text-2xl hover:scale-125 transition duration-200 cursor-pointer" title="Mandarin">🇨🇳</a>
                </div> --}}
            </div>
        </div>
    </div>
</nav>

    <main class="flex-grow pt-16">
        @yield('content')
    </main>

    <footer class="bg-[#013220] text-white mt-12">
        <div class="max-w-7xl mx-auto px-4 py-8 sm:px-6 lg:px-8 grid grid-cols-1 md:grid-cols-3 gap-8">
            <div>
                <h3 class="text-lg font-bold mb-4">Nature Pack</h3>
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
                <p class="text-gray-400 text-sm">Email: sales@naturepack.com</p>
            </div>
        </div>
        <div class="bg-emerald-950 py-4 text-center text-gray-300 text-xs">
            &copy; 2026 Nature Pack. All rights reserved.
        </div>

    </footer>

    <script>
        document.addEventListener('alpine:init', () => {
            Alpine.data('countUp', (target, duration = 2000) => ({
                current: 0,
                target: target,
                duration: duration,
                start() {
                    let startTimestamp = null;
                    const step = (timestamp) => {
                        if (!startTimestamp) startTimestamp = timestamp;
                        const progress = Math.min((timestamp - startTimestamp) / this.duration, 1);
                        // Rumus matematika sederhana untuk hitung naik
                        this.current = Math.floor(progress * (this.target - 0) + 0);
                        
                        if (progress < 1) {
                            window.requestAnimationFrame(step);
                        }
                    };
                    window.requestAnimationFrame(step);
                }
            }))
        })
    </script>

    <script defer src="https://cdn.jsdelivr.net/npm/@alpinejs/intersect@3.x.x/dist/cdn.min.js"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

</body>
</html>