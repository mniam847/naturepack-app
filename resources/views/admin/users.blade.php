@extends('layouts.admin')

@section('header', 'Kelola Akun Admin')

@section('content')
<div class="grid grid-cols-1 md:grid-cols-2 gap-8">
    
    <div class="bg-white rounded-lg shadow p-6">
        <h3 class="text-lg font-bold mb-4">Daftar Admin</h3>
        <ul class="divide-y divide-gray-200">
            @foreach($users as $user)
            <li class="py-3 flex justify-between items-center">
                <div>
                    <p class="font-medium text-gray-800">{{ $user->name }}</p>
                    <p class="text-sm text-gray-500">{{ $user->email }}</p>
                </div>
                <span class="text-xs bg-blue-100 text-blue-800 px-2 py-1 rounded">Admin</span>
            </li>
            @endforeach
        </ul>
    </div>

    <div class="bg-white rounded-lg shadow p-6 h-fit">
        <h3 class="text-lg font-bold mb-4 text-blue-900">+ Tambah Admin Baru</h3>
        <form action="{{ route('admin.users.store') }}" method="POST">
            @csrf
            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2">Nama Lengkap</label>
                <input type="text" name="name" class="w-full border rounded p-2" required>
            </div>
            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2">Email</label>
                <input type="email" name="email" class="w-full border rounded p-2" required>
            </div>
            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2">Password</label>
                <input type="password" name="password" class="w-full border rounded p-2" placeholder="Minimal 8 karakter" required>
            </div>
            <button type="submit" class="w-full bg-emerald-900 text-white font-bold py-2 rounded hover:bg-emerald-700">
                Simpan Admin Baru
            </button>
        </form>
    </div>
</div>
@endsection