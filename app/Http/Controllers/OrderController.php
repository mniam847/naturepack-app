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
        // 1. Validasi Input
        $request->validate([
            'customer_name'     => 'required|string|max:255',
            'customer_whatsapp' => 'required|string|max:20',
            'length'            => 'required|numeric',
            'width'             => 'required|numeric',
            'height'            => 'required|numeric',
            'material'          => 'required|string',
            'quantity'          => 'required|integer',
            // Validasi file: harus gambar/pdf, max 5MB
            'design_file'       => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:5120', 
            'notes'             => 'nullable|string',
        ]);

        // 2. Siapkan Data
        $data = $request->all();
        
        // Set status default
        $data['status'] = 'Menunggu Konfirmasi';

        // 3. LOGIKA UPLOAD FILE DESAIN
        if ($request->hasFile('design_file')) {
            $file = $request->file('design_file');
            
            // Buat nama file unik: time_namafileasli.jpg
            $filename = time() . '_' . str_replace(' ', '_', $file->getClientOriginalName());
            
            // Simpan ke folder public/uploads/designs
            $file->move(public_path('uploads/designs'), $filename);
            
            // Simpan nama file ke array data untuk masuk database
            $data['design_file'] = $filename;
        }

        // 4. Simpan ke Database
        Order::create($data);

        // 5. Redirect dengan pesan sukses
        return redirect()->back()->with('success', 'Pesanan berhasil dikirim! Admin akan segera menghubungi via WhatsApp.');
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