<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product; // Panggil Model Product
use Illuminate\Support\Str; // <--- 1. TAMBAHKAN BARIS INI (PENTING!)

class ProductController extends Controller
{
    // 1. Tampilkan Form Tambah Produk
    public function create()
    {
        return view('admin.product_create');
    }

    // 2. Proses Simpan ke Database
    public function store(Request $request)
    {
        // Validasi data (wajib diisi)
        $request->validate([
            'name' => 'required',
            'category' => 'required',
            'price_min' => 'required|numeric',
            'image' => 'required|image|mimes:jpeg,png,jpg|max:2048', // Maks 2MB
        ]);

        // A. Proses Upload Gambar Otomatis
        $imageName = time() . '.' . $request->image->extension(); // Bikin nama unik
        $request->image->move(public_path('images'), $imageName); // Pindahkan ke folder public/images

        // B. Simpan ke Database
        Product::create([
            'name' => $request->name,
            'slug' => Str::slug($request->name), // <--- 2. TAMBAHKAN BARIS INI
            'category' => $request->category,
            'price_min' => $request->price_min,
            'description' => $request->description ?? 'Deskripsi standar',
            'image' => 'images/' . $imageName, // Simpan alamatnya saja
        ]);

        // C. Balik ke halaman admin
        return redirect()->route('admin.orders')->with('success', 'Produk Berhasil Ditambahkan!');
    }

    // 3. Tampilkan Detail Produk
    public function show($id)
    {
        // Cari produk berdasarkan ID, kalau tidak ada tampilkan error 404
        $product = Product::findOrFail($id);
        
        // Kirim data produk ke view 'product_show'
        return view('product_show', compact('product'));
    }
}