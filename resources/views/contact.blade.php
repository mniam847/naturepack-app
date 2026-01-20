@extends('layouts.app')
@section('title', 'Hubungi Kami')

@section('content')
<div class="max-w-7xl mx-auto px-4 py-12 ">
    <div class="bg-white p-8 rounded-lg shadow-md">
        {{-- <h1 class="text-3xl font-bold text-orange-600 mb-6">{{ __('messages.contact_title') }}</h1> --}}
        
        <div class="grid md:grid-cols-2 gap-8">
            {{-- <div>
                <h3 class="font-bold text-lg mb-2">🚚 Ekspedisi Partner</h3>
                <ul class="list-disc pl-5 text-gray-700 space-y-2">
                    <li>JNE (Reguler/Cargo)</li>
                    <li>J&T Express</li>
                    <li>Dakota Cargo (Untuk pesanan besar)</li>
                    <li>Indah Cargo</li>
                </ul>
            </div>
            <div>
                <h3 class="font-bold text-lg mb-2">⏱️ Waktu Pengerjaan</h3>
                <p class="text-gray-700 mb-2"><strong>Ready Stock:</strong> Dikirim H+1 setelah pembayaran.</p>
                <p class="text-gray-700"><strong>Custom Order:</strong> Estimasi produksi 7-14 hari kerja tergantung jumlah dan antrian.</p>
            </div> --}}
            <div class="space-y-8">
                <div>
                    <h2 class="text-4xl font-bold text-orange-600 mb-4">{{ __('messages.contact_title') }}</h2>
                    <p class="text-gray-600 leading-relaxed">
                        Ingin menanyakan tentang produk, pemesanan, atau hal lainnya? 
                        Anda dapat datang langsung saat jam operasional, menghubungi kami melalui telepon, atau cukup mengisi formulir di sini.
                    </p>
                </div>

                <div class="space-y-6">
                    
                    <div class="flex items-start space-x-4 border-b border-gray-200 pb-6">
                        <div class="flex-shrink-0 mt-1">
                            <svg class="w-6 h-6 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                            </svg>
                        </div>
                        <div>
                            <h4 class="text-lg font-semibold text-gray-900">Address</h4>
                            <p class="text-gray-600 mt-1">
                                Jl. Parang Garuda No. 8, Desa/Kelurahan Wonorejo, Kecamatan Kaliwungu, Kabupaten Kendal, Jawa Tengah, Indonesia
                            </p>
                        </div>
                    </div>

                    <div class="flex items-start space-x-4 border-b border-gray-200 pb-6">
                        <div class="flex-shrink-0 mt-1">
                            <svg class="w-6 h-6 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/>
                            </svg>
                        </div>
                        <div>
                            <h4 class="text-lg font-semibold text-gray-900">Phone</h4>
                            <p class="text-gray-600 mt-1">+62 812-3456-7895</p>
                            <p class="text-gray-600">+62 812-3456-7895</p>
                        </div>
                    </div>

                    <div class="flex items-start space-x-4">
                        <div class="flex-shrink-0 mt-1">
                            <svg class="w-6 h-6 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                            </svg>
                        </div>
                        <div>
                            <h4 class="text-lg font-semibold text-gray-900">Email</h4>
                            <p class="text-gray-600 mt-1">naturepack@gmail.com</p>
                            <p class="text-gray-600">tes@gmail.com</p>
                        </div>
                    </div>

                </div>
            </div>

            <div class="bg-white p-8 lg:p-10 rounded-2xl shadow-lg border border-gray-100">
                <h3 class="text-2xl font-bold text-gray-900 mb-6">Send Us a Message</h3>
                
                <form action="#" method="POST" class="space-y-5">
                    @csrf <div>
                        <label for="name" class="block text-sm font-medium text-gray-700 mb-1">Full name</label>
                        <input type="text" name="name" id="name" placeholder="John Doe" 
                            class="w-full px-4 py-3 rounded-lg bg-gray-50 border border-gray-300 focus:border-indigo-500 focus:ring-2 focus:ring-indigo-200 transition duration-200 outline-none">
                    </div>

                    <div>
                        <label for="email" class="block text-sm font-medium text-gray-700 mb-1">Email address</label>
                        <input type="email" name="email" id="email" placeholder="john@example.com" 
                            class="w-full px-4 py-3 rounded-lg bg-gray-50 border border-gray-300 focus:border-indigo-500 focus:ring-2 focus:ring-indigo-200 transition duration-200 outline-none">
                    </div>

                    <div>
                        <label for="subject" class="block text-sm font-medium text-gray-700 mb-1">Subject</label>
                        <input type="text" name="subject" id="subject" placeholder="Registration Info" 
                            class="w-full px-4 py-3 rounded-lg bg-gray-50 border border-gray-300 focus:border-indigo-500 focus:ring-2 focus:ring-indigo-200 transition duration-200 outline-none">
                    </div>

                    <div>
                        <label for="message" class="block text-sm font-medium text-gray-700 mb-1">Your message</label>
                        <textarea name="message" id="message" rows="4" placeholder="Write your message here..." 
                            class="w-full px-4 py-3 rounded-lg bg-gray-50 border border-gray-300 focus:border-indigo-500 focus:ring-2 focus:ring-indigo-200 transition duration-200 outline-none resize-none"></textarea>
                    </div>

                    <button type="submit" class="w-full bg-indigo-600 hover:bg-indigo-700 text-white font-bold py-3 rounded-lg transition duration-300 shadow-md transform hover:-translate-y-1">
                        Submit Message
                    </button>
                </form>
            </div>
        </div>

        <section class="py-10 bg-gray-50" id="contact">
            <div class="container mx-auto px-6 lg:px-12">
                
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-16 mb-16">
                    <div class="space-y-8">
                        </div>
                     <div class="bg-white ...">
                        </div>
                </div>
        
                <div class="w-full">
                    <div class="bg-white p-2 rounded-2xl shadow-lg border border-gray-100">
                        <iframe 
                            class="w-full h-96 rounded-xl"
                            src="https://www.google.com/maps/embed?pb=!1m17!1m12!1m3!1d3960.0895454866636!2d110.40349499999999!3d-6.998735999999999!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m2!1m1!2zNsKwNTknNTUuNSJTIDExMMKwMjQnMTIuNiJF!5e0!3m2!1sid!2sid!4v1768912256990!5m2!1sid!2sid" 
                            allowfullscreen="" 
                            loading="lazy" 
                            referrerpolicy="no-referrer-when-downgrade">
                        </iframe>
                    </div>
                    
                    <div class="mt-4 text-center">
                        <a href="https://maps.app.goo.gl/u9gMF861e6p3rwSc6" 
                           target="_blank" 
                           class="inline-flex items-center text-indigo-600 hover:text-indigo-800 font-medium transition duration-200">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"></path></svg>
                            Buka di Google Maps
                        </a>
                    </div>
                </div>
        
            </div>
        </section>
    </div>
</div>
@endsection