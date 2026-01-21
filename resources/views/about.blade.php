@extends('layouts.app')
@section('title', 'Tentang Kami')

@section('content')
<div class="max-w-7xl mx-auto px-4 py-10">
    <div class="bg-white p-8 rounded-lg shadow-md">
        {{-- <h1 class="text-3xl font-bold text-blue-900 mb-4">{{ __('messages.about_title') }}</h1>
        <p class="text-gray-700 mb-4 leading-relaxed">
            {{ __('messages.about_desc') }}
        </p>
        <h2 class="text-xl font-bold text-gray-800 mt-6 mb-2">{{ __('messages.vision_title') }}</h2>
        <p class="text-gray-700">{{ __('messages.vision_desc') }}.</p> --}}

        <section class="py-16 lg:py-24 bg-white">
            <div class="container mx-auto px-4 sm:px-6 lg:px-8">
                <span class="block mb-4 text-sm font-bold tracking-widest uppercase text-[#228B22]">
                    Tentang Perusahaan Kami
                </span>
                
                <h2 class="text-3xl lg:text-4xl font-extrabold text-gray-900 leading-tight mb-6">
                    PT. NATUREPACK ESSENTIALS INDONESIA
                </h2>
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 lg:gap-16 items-center">
                    
                    <div class="relative h-full">
                        <img src="{{ asset('images/Picture1.png') }}" 
                             alt="Tim Kami" 
                             class="w-full h-auto object-cover rounded-2xl shadow-xl z-10 relative">
                             
                        <div class="absolute -bottom-6 -left-6 w-64 h-64 bg-indigo-100 rounded-2xl -z-0 hidden lg:block"></div>
                    </div>
        
                    <div>                     
                        <p class="text-lg text-gray-600 leading-relaxed mb-6">
                            PT. NATUREPACK ESSENTIALS INDONESIA merupakan perusahaan yang bergerak di bidang packaging manufacture, yaitu industri kemasan (packaging) yang berbahan dasar kertas seperti carton box, colour box, paper plates, paper bag, dan lain sebagainya. Selain packaging manufacture, PT. NATUREPACK ESSENTIALS INDONESIA juga akan melakukan pengembangan usaha dibidang elektronik seperti sikat gigi elektrik (electric toothbrush) dan pencukur elektrik (electric shaver).
                        </p>
                    </div>
                    
                </div> 
                <div class="mt-16 lg:mt-20">
                    <p class="text-lg text-gray-600 leading-relaxed">
                        Pada saat ini, PT. NATUREPACK ESSENTIALS INDONESIA akan fokus terhadap industri kemasan terlebih dahulu sebagai langkah besar kami di Indonesia, selanjutnya  akan melakukan pengembangan bisnis yang berkelanjutan dan dengan berbagai macam bidang untuk kedepannya. Dengan pasar utama untuk packaging ini adalah pasar luar negeri, maka PT. NATUREPACK berdedikasi untuk menghasilkan produk kemasan (packaging) yang memenuhi standard negara tujuan. 
                    </p>
                    <p class="text-lg text-gray-600 leading-relaxed mt-4">
                        Selain itu, PT. NATUREPACK ESSENTIALS INDONESIA akan terus melakukan inovasi yang berkelanjutan terhadap produk-produk yang akan dihasilkan  nantinya. Inovasi tersebut bukan hanya pada produk, namun juga terhadap sekitar (sumber daya manusia maupun sumber daya alam). 
                    </p>
                    <p class="text-lg text-gray-600 leading-relaxed mt-4">
                        PT. NATUREPACK ESSENTIALS INDONESIA telah mengawali investasinya dengan nilai investasi sebesar Rp. 110.000.000.000 (seratus sepuluh miliar rupiah) yang mana ditunjukan pada surat Keputusan Menteri Hukum dan Hak Asasi Manusia Republik Indonesia dengan Nomor AHU-0038696.AH.01.01. Tahun 2024, dan dinyatakan sesuai dengan Salinan Akta Nomor 130 tanggal 30 Mei 2024 yang dimohonkan dan dibuat dihadapan Notaris TUNDJUNG WIDHI WASESA SUWADJI S.H., M.KN dengan pemegang saham yaitu WANG LIN, dengan nilai saham yang dimiliki sebesar Rp. 53.900.000.000 (lima puluh tiga miliar sembilan ratus juta rupiah), dan pemegang saham lainnya yaitu SHI JIGUANG, dengan nilai saham yang dimiliki sebesar Rp. 56.100.000.000 (lima puluh enam miliar seratus juta rupiah) dengan jabatan direktur oleh WANG LIN, dan komisaris oleh SHI JIGUANG. 
                    </p>
                    <p class="text-lg text-gray-600 leading-relaxed mt-4">
                        PT. NATUREPACK ESSENTIALS INDONESIA telah mengawali investasinya dengan nilai investasi sebesar Rp. 110.000.000.000 (seratus sepuluh miliar rupiah) yang mana ditunjukan pada surat Keputusan Menteri Hukum dan Hak Asasi Manusia Republik Indonesia dengan Nomor AHU-0038696.AH.01.01. Tahun 2024, dan dinyatakan sesuai dengan Salinan Akta Nomor 130 tanggal 30 Mei 2024 yang dimohonkan dan dibuat dihadapan Notaris TUNDJUNG WIDHI WASESA SUWADJI S.H., M.KN dengan pemegang saham yaitu WANG LIN, dengan nilai saham yang dimiliki sebesar Rp. 53.900.000.000 (lima puluh tiga miliar sembilan ratus juta rupiah), dan pemegang saham lainnya yaitu SHI JIGUANG, dengan nilai saham yang dimiliki sebesar Rp. 56.100.000.000 (lima puluh enam miliar seratus juta rupiah) dengan jabatan direktur oleh WANG LIN, dan komisaris oleh SHI JIGUANG. 
                    </p>
                    
                    {{-- <div class="max-w-4xl mx-auto text-center mb-12">
                        <h3 class="text-2xl lg:text-3xl font-bold text-gray-900">Visi & Nilai Kami</h3>
                        <div class="w-24 h-1 bg-indigo-600 mx-auto mt-4 rounded-full"></div>
                    </div>
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-8 lg:gap-12 text-gray-600 leading-relaxed">
                        
                        <div>
                            <h4 class="text-xl font-semibold text-gray-900 mb-4">Dedikasi pada Kualitas</h4>
                            <p class="mb-6">
                                Kami percaya bahwa kualitas bukanlah suatu kebetulan, melainkan hasil dari niat yang kuat, usaha yang tulus, arahan yang cerdas, dan pelaksanaan yang terampil. Kami tidak pernah berkompromi dalam hal standar hasil kerja kami.
                            </p>
                            <p>
                                Setiap baris kode yang kami tulis dan setiap desain yang kami buat melalui proses quality control yang ketat untuk memastikan ketahanan dan performa jangka panjang.
                            </p>
                        </div>
                        
                        <div>
                            <h4 class="text-xl font-semibold text-gray-900 mb-4">Inovasi Berpusat pada Manusia</h4>
                            <p class="mb-6">
                                Teknologi seharusnya melayani manusia, bukan sebaliknya. Pendekatan kami selalu dimulai dengan empati—memahami masalah sebenarnya yang dihadapi pengguna sebelum merancang solusinya.
                            </p>
                            <p>
                                 Kami terus belajar dan beradaptasi dengan tren terbaru, namun kami hanya menerapkan teknologi yang benar-benar memberikan nilai tambah bagi kehidupan dan bisnis klien kami.
                            </p>
                        </div>
                        
                    </div> --}}
                </div> 
            </div>
        </section>
        
    </div>
</div>
@endsection