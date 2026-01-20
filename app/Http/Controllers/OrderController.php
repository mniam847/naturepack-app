<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Order; // Pastikan Model Order sudah di-import
use Illuminate\Http\Request;

class OrderController extends Controller
{
    /**
     * 1. HALAMAN FORM ORDER (PUBLIC)
     * Menampilkan formulir pemesanan kepada pembeli.
     */
    public function create(Request $request) 
    {
        // Ambil semua data produk untuk dropdown
        $products = Product::all(); 
    
        // Ambil ID produk dari URL jika user mengklik "Pesan" dari katalog
        $selectedProduct = $request->query('product_id');

        return view('order.create', compact('products', 'selectedProduct'));
    }

    /**
     * 2. PROSES SIMPAN ORDER (PUBLIC)
     * Menerima data dari form dan menyimpannya ke database.
     */
    public function store(Request $request)
    {
        // A. VALIDASI
        // Nama di sini harus sesuai dengan name="..." di file create.blade.php
        $request->validate([
            'product_id'  => 'required|exists:products,id',
            'name'        => 'required|string|max:255', // Di form namanya 'name'
            'email'       => 'required|email|max:255',
            'whatsapp'    => 'required|string|max:20',  // Di form namanya 'whatsapp'
            'quantity'    => 'required|integer|min:100',
            
            // Opsional (Boleh kosong)
            'length'      => 'nullable|numeric',
            'width'       => 'nullable|numeric',
            'height'      => 'nullable|numeric',
            'material'    => 'nullable|string',
            'notes'       => 'nullable|string',
            'design_file' => 'nullable|image|mimes:jpeg,png,jpg,pdf|max:2048', 
        ]);

        // B. UPLOAD FILE (Jika ada)
        $fileName = null;
        if ($request->hasFile('design_file')) {
            $file = $request->file('design_file');
            $fileName = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('uploads/designs'), $fileName);
        }

        // C. SIMPAN KE DATABASE (MAPPING KOLOM)
        // Kita petakan input form ke nama kolom database yang berbeda
        Order::create([
            'product_id'        => $request->product_id,
            
            // [PENTING] Mapping: Input 'name' -> Kolom DB 'customer_name'
            'customer_name'     => $request->name, 
            
            // [PENTING] Mapping: Input 'whatsapp' -> Kolom DB 'customer_whatsapp'
            'customer_whatsapp' => $request->whatsapp, 
            
            'email'             => $request->email,
            'quantity'          => $request->quantity,
            'length'            => $request->length,
            'width'             => $request->width,
            'height'            => $request->height,
            'material'          => $request->material,
            'notes'             => $request->notes,
            'design_file'       => $fileName,
            'status'            => 'pending', // Default status
        ]);

        // D. REDIRECT
        return redirect()->route('products.index')->with('success', 'Pesanan berhasil dikirim! Silakan cek WhatsApp/Email Anda.');
    }

    /**
     * 3. UPDATE STATUS ORDER (ADMIN)
     * Digunakan oleh Admin untuk mengubah status pesanan.
     */
    public function update(Request $request, $id)
    {
        $order = Order::findOrFail($id);
        
        $order->update([
            'status' => $request->status
        ]);

        return redirect()->back()->with('success', 'Status pesanan berhasil diperbarui!');
    }

    // CATATAN:
    // Fungsi index() (List Order), users(), settings(), dll SUDAH DIPINDAHKAN
    // ke AdminController.php agar struktur kode lebih rapi.
}