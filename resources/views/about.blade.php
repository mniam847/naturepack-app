@extends('layouts.app')
@section('title', 'Tentang Kami')

@section('content')
<div class="max-w-7xl mx-auto px-4 py-12 mt-10">
    <div class="bg-white p-8 rounded-lg shadow-md">
        <h1 class="text-3xl font-bold text-blue-900 mb-4">{{ __('messages.about_title') }}</h1>
        <p class="text-gray-700 mb-4 leading-relaxed">
            {{ __('messages.about_desc') }}
        </p>
        <h2 class="text-xl font-bold text-gray-800 mt-6 mb-2">{{ __('messages.vision_title') }}</h2>
        <p class="text-gray-700">{{ __('messages.vision_desc') }}.</p>
    </div>
</div>
@endsection