<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Session; // Jangan lupa ini

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// 1. HALAMAN UTAMA (HOME)
// Ini yang tadi hilang sehingga menyebabkan error
Route::get('/', [HomeController::class, 'index'])->name('home');

// 2. FORM ORDER (PELANGGAN)
Route::get('/custom-order', [OrderController::class, 'create'])->name('order.create');
Route::post('/custom-order', [OrderController::class, 'store'])->name('order.store');

// 3. SISTEM LOGIN (KEAMANAN)
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.post');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// 4. HALAMAN ADMIN (KHUSUS PEMILIK TOKO)
// Semua di dalam grup ini dikunci, harus login dulu
Route::middleware(['auth'])->group(function () {
    Route::get('/admin/orders', [OrderController::class, 'index'])->name('admin.orders');
    Route::put('/admin/orders/{id}', [OrderController::class, 'update'])->name('order.update');
});

// Halaman Statis (Tentang Kami & Shipping)
// Route::view artinya kita langsung panggil file tampilan tanpa lewat Controller
Route::view('/tentang-kami', 'about')->name('about');
Route::view('/informasi-shipping', 'shipping')->name('shipping');

// Route untuk Halaman Tambah Produk
Route::get('/admin/product/create', [App\Http\Controllers\ProductController::class, 'create'])->name('product.create')->middleware('auth');

// Route untuk Proses Simpan (POST)
Route::post('/admin/product', [App\Http\Controllers\ProductController::class, 'store'])->name('product.store')->middleware('auth');

// Route untuk Halaman Detail Produk (Bisa diakses publik)
Route::get('/product/{id}', [App\Http\Controllers\ProductController::class, 'show'])->name('product.show');

// Route ganti bahasa
Route::get('/lang/{locale}', function ($locale) {
    if (in_array($locale, ['id', 'en', 'zh'])) {
        Session::put('locale', $locale);
    }
    return redirect()->back(); // Kembali ke halaman sebelumnya
})->name('lang.switch');

// GROUP ADMIN (Harus Login)
Route::middleware(['auth'])->prefix('admin')->group(function () {

    // Dashboard Utama (Pesanan)
    Route::get('/dashboard', [App\Http\Controllers\OrderController::class, 'index'])->name('admin.dashboard');

    // Kelola Admin (Tambah Akun)
    Route::get('/users', [App\Http\Controllers\OrderController::class, 'users'])->name('admin.users');
    Route::post('/users', [App\Http\Controllers\OrderController::class, 'storeUser'])->name('admin.users.store');

    // Ganti Password
    Route::get('/settings', [App\Http\Controllers\OrderController::class, 'settings'])->name('admin.settings');
    Route::put('/settings', [App\Http\Controllers\OrderController::class, 'updatePassword'])->name('admin.settings.update');

    // ... route update status pesanan yang lama tetap disini ...
});
