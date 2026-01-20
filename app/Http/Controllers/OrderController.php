<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Product;
use App\Models\Order; // [PENTING] Kita pakai Model Order
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB; 

class OrderController extends Controller
{
    // 1. Tampilkan Halaman Form
    public function create(Request $request) 
    {
        // Ambil produk (pastikan kolom status ada di tabel products, jika tidak error hapus where-nya)
        $products = Product::all(); 
    
        // Ambil ID produk dari URL (jika user klik order dari katalog)
        $selectedProduct = $request->query('product_id');

        // Pastikan view ini sesuai folder Anda (resources/views/order/create.blade.php)
        return view('order.create', compact('products', 'selectedProduct'));
    }

    // 2. Proses Simpan Data (PERBAIKAN UTAMA DISINI)
    public function store(Request $request)
    {
        // Validasi input
        // Nama field harus sama persis dengan 'name="..."' di file create.blade.php
        $validated = $request->validate([
            'product_id' => 'required|exists:products,id', // Wajib pilih produk
            'name'       => 'required|string|max:255',     // Sesuaikan dengan DB (name)
            'email'      => 'required|email|max:255',      // Wajib ada email
            'whatsapp'   => 'required|string|max:20',      // Sesuaikan dengan DB (whatsapp)
            'quantity'   => 'required|integer|min:100',
            
            // Opsional
            'length'      => 'nullable|numeric',
            'width'       => 'nullable|numeric',
            'height'      => 'nullable|numeric',
            'material'    => 'nullable|string',
            'notes'       => 'nullable|string',
            'design_file' => 'nullable|image|mimes:jpeg,png,jpg,pdf|max:2048', 
        ]);

        // Proses Upload File (Hanya jika ada file)
        if ($request->hasFile('design_file')) {
            $file = $request->file('design_file');
            $fileName = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('uploads/designs'), $fileName);
            
            // Masukkan nama file ke array data yang akan disimpan
            $validated['design_file'] = $fileName;
        }

        // Set status default
        $validated['status'] = 'pending';

        // SIMPAN MENGGUNAKAN MODEL (Lebih Aman & Otomatis)
        // Ini otomatis mengisi created_at & updated_at
        Order::create($validated);

        // Redirect balik ke katalog dengan pesan sukses
        return redirect()->route('products.index')->with('success', 'Pesanan berhasil dikirim! Cek Email/WhatsApp Anda untuk info selanjutnya.');
    }

    // FUNGSI ADMIN: Daftar Pesanan
    public function index()
    {
        // Menggunakan Eloquent 'with' untuk mengambil data produk terkait (Join otomatis)
        $orders = Order::with('product')->latest()->get();
        
        return view('admin.orders', compact('orders'));
    }

    // FUNGSI ADMIN: Update Status
    public function update(Request $request, $id)
    {
        $order = Order::findOrFail($id);
        
        $order->update([
            'status' => $request->status
        ]);

        return redirect()->back()->with('success', 'Status pesanan berhasil diperbarui!');
    }

    // --- MANAJEMEN USER (ADMIN) ---

    public function users()
    {
        $users = User::all(); 
        return view('admin.users', compact('users'));
    }

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
            'role' => 'admin', 
        ]);

        return redirect()->back()->with('success', 'Akun Admin baru berhasil ditambahkan!');
    }

    public function settings()
    {
        return view('admin.settings');
    }

    public function updatePassword(Request $request)
    {
        $request->validate([
            'current_password' => 'required',
            'new_password' => 'required|min:8|confirmed', 
        ]);

        if (!Hash::check($request->current_password, auth()->user()->password)) {
            return back()->withErrors(['current_password' => 'Password lama Anda salah!']);
        }

        User::whereId(auth()->user()->id)->update([
            'password' => Hash::make($request->new_password)
        ]);

        return back()->with('success', 'Password berhasil diperbarui!');
    }
}