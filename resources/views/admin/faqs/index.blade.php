@extends('layouts.admin')

@section('title', 'Kelola FAQ')
@section('header_title', 'Kelola FAQ')

@section('content')
<div class="bg-white rounded-xl shadow-lg p-6">
    <div class="flex justify-between mb-6">
        <h3 class="text-lg font-bold text-gray-800">Daftar Pertanyaan & Jawaban</h3>
        <a href="{{ route('faqs.create') }}" class="bg-emerald-500 hover:bg-emerald-950 text-white px-4 py-2 rounded-lg text-sm font-medium transition">
            <i class="fas fa-plus mr-1"></i> Tambah FAQ
        </a>
    </div>

    @if(session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
            {{ session('success') }}
        </div>
    @endif

    <div class="space-y-4">
        @forelse($faqs as $faq)
        <div class="border border-gray-200 rounded-lg p-4 hover:bg-gray-50 transition">
            <div class="flex justify-between items-start">
                <div>
                    <h4 class="font-bold text-gray-800 text-lg mb-1">{{ $faq->question }}</h4>
                    <p class="text-gray-600">{{ $faq->answer }}</p>
                </div>
                <div class="flex gap-2 ml-4">
                    <a href="{{ route('faqs.edit', $faq->id) }}" class="text-yellow-500 hover:text-yellow-600">
                        <i class="fas fa-edit"></i>
                    </a>
                    <form action="{{ route('faqs.destroy', $faq->id) }}" method="POST" onsubmit="return confirm('Yakin hapus FAQ ini?');">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="text-red-500 hover:text-red-600">
                            <i class="fas fa-trash"></i>
                        </button>
                    </form>
                </div>
            </div>
        </div>
        @empty
        <div class="text-center py-8 text-gray-500">Belum ada data FAQ.</div>
        @endforelse
    </div>
</div>
@endsection