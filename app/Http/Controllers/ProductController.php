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
        // 1. Validasi
       $data = $request->validate([
            'name'           => 'required|string|max:255',
            'category'       => 'required',
            'price_min'      => 'required|numeric', // Harga
            
            // HAPUS 'stock' => 'required|integer',
            // GANTI DENGAN INI:
            'is_ready_stock' => 'required|in:0,1', // Hanya terima 0 atau 1
            
            'description'    => 'nullable',
            'image'          => 'nullable|image|max:2048',
            
            // Bahasa Tambahan
            'name_en' => 'nullable', 'name_zh' => 'nullable',
            'description_en' => 'nullable', 'description_zh' => 'nullable',
        ]);

        // 2. Siapkan Data
        $data = $request->all();
        
        // Generate Slug otomatis dari Nama (Contoh: "Box Besar" -> "box-besar")
        $data['slug'] = Str::slug($request->name);

        // Set status default berdasarkan stok
        $data['is_ready_stock'] = ($request->stock > 0) ? 1 : 0;
        $data['status'] = ($request->stock > 0) ? 'ready' : 'empty';

        // 3. Upload Gambar (Jika ada)
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('uploads/products'), $filename);
            $data['image'] = $filename;
        }

        // 4. Simpan ke Database
        Product::create($data);

        // Ganti 'product.index' menjadi 'admin.products'
        return redirect()->route('admin.products')->with('success', 'Produk berhasil ditambahkan!');
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
        $data = $request->validate([
            'name'           => 'required|string|max:255',
            'category'       => 'required',
            'price_min'      => 'required|numeric', // Harga
            
            // HAPUS 'stock' => 'required|integer',
            // GANTI DENGAN INI:
            'is_ready_stock' => 'required|in:0,1', // Hanya terima 0 atau 1
            
            'description'    => 'nullable',
            'image'          => 'nullable|image|max:2048',
            
            // Bahasa Tambahan
            'name_en' => 'nullable', 'name_zh' => 'nullable',
            'description_en' => 'nullable', 'description_zh' => 'nullable',
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
