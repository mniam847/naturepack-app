@extends('layouts.admin')

@section('header', 'Pengaturan Akun')

@section('content')
<div class="max-w-md mx-auto bg-white rounded-lg shadow p-6 mt-10">
    <h3 class="text-lg font-bold mb-6 text-gray-800 border-b pb-2">Ganti Password Saya</h3>
    
    <form action="{{ route('admin.settings.update') }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-4">
            <label class="block text-gray-700 text-sm font-bold mb-2">Password Lama</label>
            <input type="password" name="current_password" class="w-full border rounded p-2" required>
        </div>

        <div class="mb-4">
            <label class="block text-gray-700 text-sm font-bold mb-2">Password Baru</label>
            <input type="password" name="new_password" class="w-full border rounded p-2" required>
        </div>

        <div class="mb-6">
            <label class="block text-gray-700 text-sm font-bold mb-2">Ulangi Password Baru</label>
            <input type="password" name="new_password_confirmation" class="w-full border rounded p-2" required>
        </div>

        <button type="submit" class="w-full bg-emerald-600 text-white font-bold py-2 rounded hover:bg-emerald-700">
            Update Password
        </button>
    </form>
</div>
@endsection