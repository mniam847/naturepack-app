@extends('layouts.admin')

@section('title', 'Edit FAQ')
@section('header_title', 'Edit FAQ')

@section('content')
<div class="bg-white max-w-2xl mx-auto rounded-xl shadow-lg p-8">
    <form action="{{ route('faqs.update', $faq->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="mb-4">
            <label>Pertanyaan (ID)</label>
            <input type="text" name="question" class="border p-2 w-full" required>
        </div>

        <div class="mb-4 bg-blue-50 p-2 rounded">
            <label class="text-blue-800">Question (EN) - Opsional</label>
            <input type="text" name="question_en" class="border p-2 w-full" placeholder="Question in English">
        </div>

        <div class="mb-4">
            <label>Jawaban (ID)</label>
            <textarea name="answer" class="border p-2 w-full" required></textarea>
        </div>

        <div class="mb-4 bg-blue-50 p-2 rounded">
            <label class="text-blue-800">Answer (EN) - Opsional</label>
            <textarea name="answer_en" class="border p-2 w-full" placeholder="Answer in English"></textarea>
        </div>
        
        <div class="flex gap-3">
            <button type="submit" class="bg-green-600 text-white px-5 py-2.5 rounded-lg hover:bg-green-700 transition">Update</button>
            <a href="{{ route('admin.faqs') }}" class="bg-gray-200 text-gray-700 px-5 py-2.5 rounded-lg hover:bg-gray-300 transition">Batal</a>
        </div>
    </form>
</div>
@endsection