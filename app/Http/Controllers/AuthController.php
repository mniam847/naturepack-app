<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    // 1. Tampilkan Form Login
    public function showLoginForm()
    {
        return view('auth.login');
    }

    // 2. Proses Login
    public function login(Request $request)
    {
        // Validasi input
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        // Cek apakah email & password cocok dengan database
        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            // Jika sukses, lempar ke halaman Admin Order
            return redirect()->route('admin.orders');
        }

        // Jika gagal, kembalikan ke form login dengan pesan error
        return back()->withErrors([
            'email' => 'Email atau password salah!',
        ]);
    }

    // 3. Proses Logout
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/login'); // Kembali ke login
    }
}