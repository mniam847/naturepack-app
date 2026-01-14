<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB; // Kita pakai Query Builder biar simpel dulu

class OrderController extends Controller
{
    // 1. Tampilkan Halaman Form
    public function create()
    {
        return view('order.create');
    }

    // 2. Proses Simpan Data saat Tombol ditekan
    public function store(Request $request)
    {
        // Validasi input (Wajib diisi)
        $request->validate([
            'customer_name' => 'required',
            'customer_whatsapp' => 'required',
            'length' => 'required|numeric',
            'width' => 'required|numeric',
            'height' => 'required|numeric',
            'quantity' => 'required|numeric',
            'design_file' => 'required|image|mimes:jpeg,png,jpg,pdf|max:2048', // Max 2MB
        ]);

        // Proses Upload File
        $fileName = null;
        if ($request->hasFile('design_file')) {
            $file = $request->file('design_file');
            $fileName = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('uploads/designs'), $fileName);
        }

        // Simpan ke Database
        DB::table('orders')->insert([
            'customer_name' => $request->customer_name,
            'customer_whatsapp' => $request->customer_whatsapp,
            'length' => $request->length,
            'width' => $request->width,
            'height' => $request->height,
            'material' => $request->material,
            'quantity' => $request->quantity,
            'design_file' => $fileName,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // Redirect balik ke home dengan pesan sukses
        return redirect()->route('home')->with('success', 'Pesanan berhasil dikirim! Tim kami akan menghubungi via WhatsApp.');
    }

    // FUNGSI BARU: Untuk Halaman Admin
    public function index()
    {
        // Ambil semua data order, urutkan dari yang terbaru
        $orders = DB::table('orders')->orderBy('created_at', 'desc')->get();
        
        return view('admin.orders', compact('orders'));
    }

    // FUNGSI UPDATE: Mengubah status pesanan
    public function update(Request $request, $id)
    {
        // Update data di database berdasarkan ID
        DB::table('orders')->where('id', $id)->update([
            'status' => $request->status,
            'updated_at' => now()
        ]);

        // Kembali ke halaman admin
        return redirect()->back()->with('success', 'Status pesanan berhasil diperbarui!');
    }

    // 1. HALAMAN KELOLA ADMIN (List & Form Tambah)
    public function users()
    {
        $users = User::all(); // Ambil semua data admin
        return view('admin.users', compact('users'));
    }

    // 2. PROSES TAMBAH ADMIN BARU
    public function storeUser(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8', // Password minimal 8 huruf
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password), // Password wajib di-HASH (enkripsi)
            'role' => 'admin', // Asumsi semua yg dibuat disini adalah admin
        ]);

        return redirect()->back()->with('success', 'Akun Admin baru berhasil ditambahkan!');
    }

    // 3. HALAMAN GANTI PASSWORD
    public function settings()
    {
        return view('admin.settings');
    }

    // 4. PROSES GANTI PASSWORD
    public function updatePassword(Request $request)
    {
        $request->validate([
            'current_password' => 'required',
            'new_password' => 'required|min:8|confirmed', // 'confirmed' artinya harus sama dengan field konfirmasi
        ]);

        // Cek apakah password lama benar
        if (!Hash::check($request->current_password, auth()->user()->password)) {
            return back()->withErrors(['current_password' => 'Password lama Anda salah!']);
        }

        // Update password baru
        User::whereId(auth()->user()->id)->update([
            'password' => Hash::make($request->new_password)
        ]);

        return back()->with('success', 'Password berhasil diperbarui!');
    }
}
