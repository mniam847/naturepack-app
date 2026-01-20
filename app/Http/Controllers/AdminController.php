<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Product;
use App\Models\User;
use App\Models\Visitor; // Pastikan Model Visitor sudah dibuat
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    // 1. MENU DASHBOARD (Statistik)
    public function dashboard()
    {
        // Hitung Order
        $totalOrders = Order::count();
        $pendingOrders = Order::where('status', 'pending')->count();
        
        // Hitung Pendapatan (Hanya dari order yang 'completed')
        // Asumsi kolom harga di tabel product adalah price_min, kita perlu logika join jika harga ada di tabel order
        // Untuk simpelnya kita hitung jumlah order completed dulu
        $completedOrders = Order::where('status', 'completed')->count();

        // Hitung Pengunjung (Dari Middleware TrackVisitors)
        // Jika tabel visitors belum ada, kode ini akan error. Pastikan migrasi visitors sudah jalan.
        $todayVisitors = 0;
        $totalVisitors = 0;
        
        try {
            $todayVisitors = Visitor::where('visit_date', now()->format('Y-m-d'))->count();
            $totalVisitors = Visitor::count();
        } catch (\Exception $e) {
            // Jika tabel belum ada, biarkan 0 dulu agar tidak crash
        }

        return view('admin.dashboard', compact(
            'totalOrders', 
            'pendingOrders', 
            'completedOrders',
            'todayVisitors', 
            'totalVisitors'
        ));
    }

    // 2. MENU PRODUK (List Produk di Admin)
    public function products()
    {
        $products = Product::all();
        return view('admin.products', compact('products'));
    }

    // 3. MENU PESANAN (List Order di Admin)
    public function orders()
    {
        // Ambil order terbaru beserta data produknya
        $orders = Order::with('product')->latest()->get();
        return view('admin.orders', compact('orders'));
    }

    // 4. MENU KELOLA ADMIN (List & Tambah User)
    public function users()
    {
        $users = User::all();
        return view('admin.users', compact('users'));
    }

    // Proses Tambah Admin Baru
    public function storeUser(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8',
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'admin', // Pastikan kolom role ada di tabel users
        ]);

        return redirect()->back()->with('success', 'Admin baru berhasil ditambahkan!');
    }

    // 5. MENU GANTI PASSWORD
    public function settings()
    {
        return view('admin.settings');
    }

    // Proses Ganti Password
    public function updatePassword(Request $request)
    {
        $request->validate([
            'current_password' => 'required',
            'new_password' => 'required|min:8|confirmed',
        ]);

        // Cek password lama
        if (!Hash::check($request->current_password, Auth::user()->password)) {
            return back()->withErrors(['current_password' => 'Password lama salah!']);
        }

        // Update password baru
        User::whereId(Auth::id())->update([
            'password' => Hash::make($request->new_password)
        ]);

        return back()->with('success', 'Password berhasil diperbarui!');
    }
}