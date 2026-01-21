@extends('layouts.app')

@section('title', 'FAQ - Pertanyaan Umum')

@section('content')
<div class="max-w-7xl mx-auto px-4 py-12 mt-10">
    <div class="bg-white p-8 rounded-lg shadow-md border border-gray-100">
        
        <div class="mb-8 border-b pb-4">
            <h1 class="text-3xl font-bold text-blue-900 mb-2">
                {{ __('messages.faq_title') ?? 'Frequently Asked Questions' }}
            </h1>
            <p class="text-gray-600">
                Berikut adalah daftar pertanyaan yang sering diajukan oleh pelanggan kami.
            </p>
        </div>

        <div class="space-y-4">
            @forelse($faqs as $faq)
                <div class="border border-gray-200 rounded-lg hover:shadow-sm transition duration-200">
                    {{-- Tag <details> untuk efek buka-tutup otomatis tanpa JS --}}
                    <details class="group">
                        
                        {{-- PERTANYAAN (Judul yang diklik) --}}
                        <summary class="flex justify-between items-center font-semibold cursor-pointer list-none p-4 text-gray-800 bg-gray-50 hover:bg-gray-100 rounded-t-lg group-open:rounded-b-none transition">
                            <span class="text-lg">
                                {{ $faq->question }}
                            </span>
                            {{-- Ikon Panah --}}
                            <span class="transition group-open:rotate-180 text-blue-600">
                                <svg fill="none" height="24" shape-rendering="geometricPrecision" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" viewBox="0 0 24 24" width="24"><path d="M6 9l6 6 6-6"></path></svg>
                            </span>
                        </summary>
                        
                        {{-- JAWABAN (Isi yang muncul) --}}
                        <div class="text-gray-600 px-4 py-4 leading-relaxed border-t border-gray-200 bg-white">
                            {{-- nl2br agar enter/paragraf terbaca --}}
                            {!! nl2br(e($faq->answer)) !!}
                        </div>

                    </details>
                </div>
            @empty
                {{-- Tampilan jika Admin belum input data FAQ --}}
                <div class="text-center py-10 bg-gray-50 rounded-lg border border-dashed border-gray-300">
                    <p class="text-gray-500 text-lg">Belum ada data FAQ yang ditambahkan.</p>
                </div>
            @endforelse
        </div>
        
    </div>
</div>
@endsection