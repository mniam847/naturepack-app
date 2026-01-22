@extends('layouts.app')
@section('title', 'Tentang Kami')

@section('content')

{{-- 1. AMBIL BAHASA DARI SESSION --}}
@php
    $locale = session('locale', 'id');
@endphp

<div class="max-w-7xl mx-auto px-4 py-10">
    <div class="bg-white p-8 rounded-lg shadow-md">

        <section class="py-16 lg:py-24 bg-white">
            <div class="container mx-auto px-4 sm:px-6 lg:px-8">
                
                {{-- SUB-JUDUL --}}
                <span class="block mb-4 text-sm font-bold tracking-widest uppercase text-[#228B22]">
                    @if($locale == 'en')
                        About Our Company
                    @elseif($locale == 'zh')
                        关于我们公司
                    @else
                        Tentang Perusahaan Kami
                    @endif
                </span>
                
                {{-- JUDUL UTAMA --}}
                <h2 class="text-3xl lg:text-4xl font-extrabold text-gray-900 leading-tight mb-6">
                    PT. NATUREPACK ESSENTIALS INDONESIA
                </h2>

                <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 lg:gap-16 items-center">
                    
                    {{-- GAMBAR --}}
                    <div class="relative h-full">
                        <img src="{{ asset('images/Picture1.png') }}" 
                             alt="Tim Kami" 
                             class="w-full h-auto object-cover rounded-2xl shadow-xl z-10 relative">
                        <div class="absolute -bottom-6 -left-6 w-64 h-64 bg-indigo-100 rounded-2xl -z-0 hidden lg:block"></div>
                    </div>
        
                    {{-- PARAGRAF 1 (Introduction) --}}
                    <div>                     
                        <p class="text-lg text-gray-600 leading-relaxed mb-6 text-justify">
                            @if($locale == 'en')
                                PT. NATUREPACK ESSENTIALS INDONESIA is a company engaged in packaging manufacturing, specifically paper-based packaging industries such as carton boxes, color boxes, paper plates, paper bags, and more. In addition to packaging manufacturing, PT. NATUREPACK ESSENTIALS INDONESIA will also develop businesses in the electronics sector, such as electric toothbrushes and electric shavers.
                            @elseif($locale == 'zh')
                                PT. NATUREPACK ESSENTIALS INDONESIA 是一家从事包装制造的公司，即以纸张为基础的包装行业，如纸箱、彩盒、纸盘、纸袋等。除了包装制造外，PT. NATUREPACK ESSENTIALS INDONESIA 还将在电子领域开展业务拓展，例如电动牙刷和电动剃须刀。
                            @else
                                PT. NATUREPACK ESSENTIALS INDONESIA merupakan perusahaan yang bergerak di bidang packaging manufacture, yaitu industri kemasan (packaging) yang berbahan dasar kertas seperti carton box, colour box, paper plates, paper bag, dan lain sebagainya. Selain packaging manufacture, PT. NATUREPACK ESSENTIALS INDONESIA juga akan melakukan pengembangan usaha dibidang elektronik seperti sikat gigi elektrik (electric toothbrush) dan pencukur elektrik (electric shaver).
                            @endif
                        </p>
                    </div>
                    
                </div> 

                {{-- TEKS BAGIAN BAWAH --}}
                <div class="mt-16 lg:mt-20">
                    
                    {{-- PARAGRAF 2 (Focus & Goal) --}}
                    <p class="text-lg text-gray-600 leading-relaxed text-justify mb-4">
                        @if($locale == 'en')
                            Currently, PT. NATUREPACK ESSENTIALS INDONESIA will focus on the packaging industry first as our major step in Indonesia. Subsequently, we will carry out sustainable business development in various fields in the future. With the overseas market being the main target for this packaging, PT. NATUREPACK is dedicated to producing packaging products that meet the standards of the destination countries.
                        @elseif($locale == 'zh')
                            目前，PT. NATUREPACK ESSENTIALS INDONESIA 将首先专注于包装行业，这是我们在迈向印尼的一大步。随后，我们将面向未来在各个领域进行可持续的业务拓展。由于该包装的主要市场是海外市场，PT. NATUREPACK 致力于生产符合目的地国家标准的包装产品。
                        @else
                            Pada saat ini, PT. NATUREPACK ESSENTIALS INDONESIA akan fokus terhadap industri kemasan terlebih dahulu sebagai langkah besar kami di Indonesia, selanjutnya akan melakukan pengembangan bisnis yang berkelanjutan dan dengan berbagai macam bidang untuk kedepannya. Dengan pasar utama untuk packaging ini adalah pasar luar negeri, maka PT. NATUREPACK berdedikasi untuk menghasilkan produk kemasan (packaging) yang memenuhi standard negara tujuan.
                        @endif
                    </p>

                    {{-- PARAGRAF 3 (Innovation) --}}
                    <p class="text-lg text-gray-600 leading-relaxed mb-4 text-justify">
                        @if($locale == 'en')
                            Furthermore, PT. NATUREPACK ESSENTIALS INDONESIA will continue to carry out sustainable innovation on the products to be produced later. This innovation applies not only to the products but also to the surroundings (both human resources and natural resources).
                        @elseif($locale == 'zh')
                            此外，PT. NATUREPACK ESSENTIALS INDONESIA 将继续对未来生产的产品进行持续创新。这种创新不仅针对产品，也针对周围环境（包括人力资源和自然资源）。
                        @else
                            Selain itu, PT. NATUREPACK ESSENTIALS INDONESIA akan terus melakukan inovasi yang berkelanjutan terhadap produk-produk yang akan dihasilkan nantinya. Inovasi tersebut bukan hanya pada produk, namun juga terhadap sekitar (sumber daya manusia maupun sumber daya alam).
                        @endif
                    </p>

                    {{-- PARAGRAF 4 (Investment & Legal) --}}
                    <p class="text-lg text-gray-600 leading-relaxed mb-4 text-justify">
                        @if($locale == 'en')
                            PT. NATUREPACK ESSENTIALS INDONESIA has initiated its investment with a total value of IDR 110,000,000,000 (one hundred ten billion rupiah), as indicated in the Decree of the Minister of Law and Human Rights of the Republic of Indonesia Number AHU-0038696.AH.01.01. Year 2024, and declared in accordance with the Copy of Deed Number 130 dated May 30, 2024, requested and made before Notary TUNDJUNG WIDHI WASESA SUWADJI S.H., M.KN with shareholder WANG LIN holding shares worth IDR 53,900,000,000, and other shareholder SHI JIGUANG holding shares worth IDR 56,100,000,000, with WANG LIN serving as Director and SHI JIGUANG as Commissioner.
                        @elseif($locale == 'zh')
                            PT. NATUREPACK ESSENTIALS INDONESIA 已开始其投资，投资额为 1,100,000,000,000 印尼盾（一千一百亿卢比），如印度尼西亚共和国法律和人权部长第 AHU-0038696.AH.01.01 号决定书所示。2024 年，并根据 2024 年 5 月 30 日第 130 号公证契据副本声明，该契据是在公证人 TUNDJUNG WIDHI WASESA SUWADJI S.H., M.KN 面前申请并制作的，股东 WANG LIN 持有价值 53,900,000,000 印尼盾的股份，另一股东 SHI JIGUANG 持有价值 56,100,000,000 印尼盾的股份，其中 WANG LIN 担任董事，SHI JIGUANG 担任专员。
                        @else
                            PT. NATUREPACK ESSENTIALS INDONESIA telah mengawali investasinya dengan nilai investasi sebesar Rp. 110.000.000.000 (seratus sepuluh miliar rupiah) yang mana ditunjukan pada surat Keputusan Menteri Hukum dan Hak Asasi Manusia Republik Indonesia dengan Nomor AHU-0038696.AH.01.01. Tahun 2024, dan dinyatakan sesuai dengan Salinan Akta Nomor 130 tanggal 30 Mei 2024 yang dimohonkan dan dibuat dihadapan Notaris TUNDJUNG WIDHI WASESA SUWADJI S.H., M.KN dengan pemegang saham yaitu WANG LIN, dengan nilai saham yang dimiliki sebesar Rp. 53.900.000.000 (lima puluh tiga miliar sembilan ratus juta rupiah), dan pemegang saham lainnya yaitu SHI JIGUANG, dengan nilai saham yang dimiliki sebesar Rp. 56.100.000.000 (lima puluh enam miliar seratus juta rupiah) dengan jabatan direktur oleh WANG LIN, dan komisaris oleh SHI JIGUANG.
                        @endif
                    </p>
                    
                </div> 
            </div>
        </section>
        
    </div>
</div>
@endsection