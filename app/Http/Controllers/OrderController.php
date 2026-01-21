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
    // Di dalam Controller (misal OrderController.php atau FrontController.php)
    public function store(Request $request)
    {
        // Validasi
        $request->validate([
            'product_id' => 'required',
            'name'       => 'required', // Input form: name
            'whatsapp'   => 'required', // Input form: whatsapp
            'quantity'   => 'required|integer',
            // ... validasi lain
        ]);

        // Simpan ke Database sesuai struktur gambar
        Order::create([
            'product_id'        => $request->product_id,
            
            // MAPPING PENTING:
            'customer_name'     => $request->name,      // Input 'name' masuk ke 'customer_name'
            'customer_whatsapp' => $request->whatsapp,  // Input 'whatsapp' masuk ke 'customer_whatsapp'
            
            'email'             => $request->email,
            'quantity'          => $request->quantity,
            'length'            => $request->length ?? 0, // Kasih default 0 jika kosong
            'width'             => $request->width ?? 0,
            'height'            => $request->height ?? 0,
            
            // MENCEGAH ERROR MATERIAL:
            // Jika di form ada input material, pakai itu. Jika tidak, isi strip '-'
            'material'          => $request->material ?? 'Standard', 
            
            'notes'             => $request->notes,
            'status'            => 'Menunggu Konfirmasi', // Sesuai default value di gambar
        ]);

        return redirect()->back()->with('success', 'Pesanan berhasil dibuat!');
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