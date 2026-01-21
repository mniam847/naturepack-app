@extends('layouts.admin')

@section('title', 'Edit FAQ')
@section('header_title', 'Edit FAQ')

@section('content')
<div class="bg-white max-w-2xl mx-auto rounded-xl shadow-lg p-8">
    <form action="{{ route('faqs.update', $faq->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="mb-6">
            <label class="block mb-2 text-sm font-bold text-gray-700">Pertanyaan</label>
            <input type="text" name="question" value="{{ $faq->question }}" class="w-full border border-gray-300 rounded-lg p-2.5 focus:ring-blue-500 focus:border-blue-500" required>
        </div>
        <div class="mb-6">
            <label class="block mb-2 text-sm font-bold text-gray-700">Jawaban</label>
            <textarea name="answer" rows="4" class="w-full border border-gray-300 rounded-lg p-2.5 focus:ring-blue-500 focus:border-blue-500" required>{{ $faq->answer }}</textarea>
        </div>
        <div class="flex gap-3">
            <button type="submit" class="bg-green-600 text-white px-5 py-2.5 rounded-lg hover:bg-green-700 transition">Update</button>
            <a href="{{ route('admin.faqs') }}" class="bg-gray-200 text-gray-700 px-5 py-2.5 rounded-lg hover:bg-gray-300 transition">Batal</a>
        </div>
    </form>
</div>
@endsection