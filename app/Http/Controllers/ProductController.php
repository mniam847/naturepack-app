<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product; // Panggil Model Product
use Illuminate\Support\Str; 
use Illuminate\Support\Facades\File;

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

    // 4. Tampilkan semua product
    public function index(Request $request)
    {
        $query = Product::query();

        // Logika Search
        if ($request->has('search') && $request->search != '') {
            $query->where('name', 'LIKE', '%' . $request->search . '%');
        }

        // Logika Sort
        if ($request->has('sort')) {
            if ($request->sort == 'price_low') {
                $query->orderBy('price_min', 'asc');
            } elseif ($request->sort == 'price_high') {
                $query->orderBy('price_min', 'desc');
            } else {
                $query->orderBy('created_at', 'desc');
            }
        } else {
            $query->orderBy('created_at', 'desc');
        }

        $products = $query->get();

        // [BARU] Cek apakah ini request AJAX (Live Search)
        if ($request->ajax()) {
            // Hanya render bagian grid produk saja
            return view('partials.products_grid', compact('products'))->render();
        }

        return view('products', compact('products'));
    }

    // 5. FORM EDIT (INI YANG BELUM ADA DI SCREENSHOT)
    public function edit($id)
    {
        $product = Product::findOrFail($id);
        // Kita akan buat file ini di langkah ke-2
        return view('admin.product_edit', compact('product'));
    }

    // 6. PROSES UPDATE
    public function update(Request $request, $id)
    {
        $product = Product::findOrFail($id);

        // 1. VALIDASI KITA LONGGARKAN
        $request->validate([
            'name' => 'required',
            'price_min' => 'required|numeric',
            'description' => 'nullable',
            // Kita ubah jadi 'nullable' saja dulu agar file APAPUN bisa masuk.
            // Nanti kalau sudah sukses, baru kita pikirkan validasi ketatnya.
            'image' => 'nullable' 
        ]);

        $input = $request->all();

        // 2. PROSES UPLOAD
        if ($request->hasFile('image')) {
            // Hapus gambar lama jika ada
            if ($product->image && File::exists(public_path('uploads/products/' . $product->image))) {
                File::delete(public_path('uploads/products/' . $product->image));
            }
            
            $file = $request->file('image');
            
            // Kita bersihkan nama file agar tidak ada spasi aneh
            $cleanName = str_replace(' ', '_', $file->getClientOriginalName());
            $fileName = time() . '_' . $cleanName;
            
            // Pindahkan file
            $file->move(public_path('uploads/products'), $fileName);
            $input['image'] = $fileName;
        } else {
            // PENTING: Jika user tidak upload gambar baru, jangan update kolom image
            // Agar gambar lama tidak hilang/jadi null
            unset($input['image']);
        }

        // 3. UPDATE DATABASE
        $product->update($input);

        return redirect()->route('admin.products')->with('success', 'Produk berhasil diperbarui.');
    }

    // 7. HAPUS
    public function destroy($id)
    {
        $product = Product::findOrFail($id);
        if ($product->image && File::exists(public_path('uploads/products/' . $product->image))) {
            File::delete(public_path('uploads/products/' . $product->image));
        }
        $product->delete();
        return redirect()->route('admin.products')->with('success', 'Produk dihapus.');
    }
}
