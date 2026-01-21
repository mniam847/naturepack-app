<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Session;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\FaqController; 
use App\Models\Faq;
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

// GRUP ROUTE ADMIN (Hanya bisa diakses jika login)
Route::prefix('admin')->middleware(['auth'])->group(function () {
    
    // 1. Dashboard
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
    
    // 2. Produk (Halaman List Produk Admin)
    Route::get('/products', [AdminController::class, 'products'])->name('admin.products');
    Route::get('/products/{id}/edit', [ProductController::class, 'edit'])->name('products.edit');
    Route::put('/products/{id}', [ProductController::class, 'update'])->name('products.update');
    Route::delete('/products/{id}', [ProductController::class, 'destroy'])->name('products.destroy');
    
    // 3. Pesanan (Halaman List Order Admin)
    Route::get('/orders', [AdminController::class, 'orders'])->name('admin.orders');
    // Route untuk update status order (tetap pakai OrderController atau pindah ke AdminController boleh)
    // Asumsi di OrderController sudah ada update:
    Route::patch('/orders/{id}', [App\Http\Controllers\OrderController::class, 'update'])->name('orders.update');
    Route::get('/admin/orders/export', [AdminController::class, 'exportOrders'])->name('orders.export');

    // 4. Kelola Admin
    Route::get('/users', [AdminController::class, 'users'])->name('admin.users');
    Route::post('/users', [AdminController::class, 'storeUser'])->name('admin.users.store');

    // 5. Ganti Password
    Route::get('/settings', [AdminController::class, 'settings'])->name('admin.settings');
    Route::put('/settings/password', [AdminController::class, 'updatePassword'])->name('admin.password.update');
});
    

    // Route FAQ
    Route::get('/admin/faqs', [FaqController::class, 'index'])->name('admin.faqs');
    Route::get('/admin/faqs/create', [FaqController::class, 'create'])->name('faqs.create');
    Route::post('/admin/faqs', [FaqController::class, 'store'])->name('faqs.store');
    Route::get('/admin/faqs/{id}/edit', [FaqController::class, 'edit'])->name('faqs.edit');
    Route::put('/admin/faqs/{id}', [FaqController::class, 'update'])->name('faqs.update');
    Route::delete('/admin/faqs/{id}', [FaqController::class, 'destroy'])->name('faqs.destroy');

    Route::get('/faq', function () {
    $faqs = Faq::all(); // Ambil data
    return view('faq', compact('faqs')); // Kirim data
    })->name('faq');

// Lang Switch
Route::get('/lang/{locale}', function ($locale) {
    if (in_array($locale, ['id', 'en', 'zh'])) {
        Session::put('locale', $locale);
    }
    return redirect()->back();
})->name('lang.switch');