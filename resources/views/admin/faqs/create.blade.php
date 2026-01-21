@extends('layouts.admin')

@section('title', 'Tambah FAQ')
@section('header_title', 'Tambah FAQ Baru')

@section('content')
<div class="bg-white max-w-2xl mx-auto rounded-xl shadow-lg p-8">
    <form action="{{ route('faqs.store') }}" method="POST">
        @csrf
        <div class="mb-6">
            <label class="block mb-2 text-sm font-bold text-gray-700">Pertanyaan</label>
            <input type="text" name="question" class="w-full border border-gray-300 rounded-lg p-2.5 focus:ring-blue-500 focus:border-blue-500" placeholder="Contoh: Berapa lama pengiriman?" required>
        </div>
        <div class="mb-6">
            <label class="block mb-2 text-sm font-bold text-gray-700">Jawaban</label>
            <textarea name="answer" rows="4" class="w-full border border-gray-300 rounded-lg p-2.5 focus:ring-blue-500 focus:border-blue-500" placeholder="Tulis jawaban disini..." required></textarea>
        </div>
        <div class="flex gap-3">
            <button type="submit" class="bg-blue-600 text-white px-5 py-2.5 rounded-lg hover:bg-blue-700 transition">Simpan</button>
            <a href="{{ route('admin.faqs') }}" class="bg-gray-200 text-gray-700 px-5 py-2.5 rounded-lg hover:bg-gray-300 transition">Batal</a>
        </div>
    </form>
</div>
@endsection