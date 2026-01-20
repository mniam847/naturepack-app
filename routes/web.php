<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Session;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// 1. HOME (Nama route: 'home')
Route::get('/', [HomeController::class, 'index'])->name('home');

// 2. HALAMAN STATIS
Route::view('/tentang-kami', 'about')->name('about');
Route::view('/hubungi-kami', 'contact')->name('contact');
Route::view('/faq', 'faq')->name('faq');

// 3. PRODUK (Katalog & Detail)
// Perhatikan namanya pakai 's' (products.index & products.show)
Route::get('/products', [ProductController::class, 'index'])->name('products.index');
Route::get('/product/{id}', [ProductController::class, 'show'])->name('products.show');

// 4. ORDER
Route::get('/custom-order', [OrderController::class, 'create'])->name('order.create');
Route::post('/custom-order', [OrderController::class, 'store'])->name('order.store');

// 5. AUTH
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.post');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// 6. ADMIN
Route::middleware(['auth'])->prefix('admin')->group(function () {
    Route::get('/dashboard', [OrderController::class, 'index'])->name('admin.dashboard');
    
    // Route ini sering dicari, kita arahkan ke dashboard juga
    Route::get('/orders', [OrderController::class, 'index'])->name('admin.orders');

    Route::put('/orders/{id}', [OrderController::class, 'update'])->name('order.update');
    Route::get('/product/create', [ProductController::class, 'create'])->name('product.create');
    Route::post('/product', [ProductController::class, 'store'])->name('product.store');
    
    // User & Settings
    Route::get('/users', [OrderController::class, 'users'])->name('admin.users');
    Route::post('/users', [OrderController::class, 'storeUser'])->name('admin.users.store');
    Route::get('/settings', [OrderController::class, 'settings'])->name('admin.settings');
    Route::put('/settings', [OrderController::class, 'updatePassword'])->name('admin.settings.update');
});

// Lang Switch
Route::get('/lang/{locale}', function ($locale) {
    if (in_array($locale, ['id', 'en', 'zh'])) {
        Session::put('locale', $locale);
    }
    return redirect()->back();
})->name('lang.switch');