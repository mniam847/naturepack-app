<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product; 
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
        $request->validate([
            'name'           => 'required|string|max:255',
            'category'       => 'required',
            'price_min'      => 'required|numeric',
            'is_ready_stock' => 'required|in:0,1',
            'description'    => 'nullable',
            
            // Validasi Gambar
            'image'          => 'nullable|image|max:2048', // Gambar 1
            'image2'         => 'nullable|image|max:2048', // Gambar 2
            
            // Bahasa Tambahan
            'name_en' => 'nullable', 'name_zh' => 'nullable',
            'description_en' => 'nullable', 'description_zh' => 'nullable',
        ]);

        // 2. Siapkan Data Dasar
        $data = $request->all();
        
        // Generate Slug
        $data['slug'] = Str::slug($request->name);

        // Set status
        $data['status'] = ($request->is_ready_stock == 1) ? 'ready' : 'empty';

        // 3. Upload Gambar 1 (UTAMA)
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $filename = time() . '_1_' . $file->getClientOriginalName(); // Kasih tanda _1_
            $file->move(public_path('uploads/products'), $filename);
            $data['image'] = $filename;
        }

        // 4. Upload Gambar 2 (TAMBAHAN - INI YANG TADI KURANG)
        if ($request->hasFile('image2')) {
            $file2 = $request->file('image2');
            $filename2 = time() . '_2_' . $file2->getClientOriginalName(); // Kasih tanda _2_
            $file2->move(public_path('uploads/products'), $filename2);
            $data['image2'] = $filename2;
        }

        // 5. Simpan ke Database
        Product::create($data);

        return redirect()->route('admin.products')->with('success', 'Produk berhasil ditambahkan!');
    }

    // 3. Tampilkan Detail Produk
    public function show($id)
    {
        $product = Product::findOrFail($id);
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

        if ($request->ajax()) {
            return view('partials.products_grid', compact('products'))->render();
        }

        return view('products', compact('products'));
    }

    // 5. FORM EDIT
    public function edit($id)
    {
        $product = Product::findOrFail($id);
        return view('admin.product_edit', compact('product'));
    }

    // 6. PROSES UPDATE (PERBAIKAN LOGIKA DISINI)
    public function update(Request $request, $id)
    {
        $product = Product::findOrFail($id);

        // 1. Validasi
        $request->validate([
            'name'           => 'required|string|max:255',
            'category'       => 'required',
            'price_min'      => 'required|numeric',
            'is_ready_stock' => 'required|in:0,1',
            'description'    => 'nullable',
            'image'          => 'nullable|image|max:2048',
            'image2'         => 'nullable|image|max:2048', // Tambahkan validasi image2
        ]);

        $input = $request->all();
        $input['status'] = ($request->is_ready_stock == 1) ? 'ready' : 'empty';

        // 2. LOGIKA UPDATE GAMBAR 1
        if ($request->hasFile('image')) {
            // Hapus gambar lama 1
            if ($product->image && File::exists(public_path('uploads/products/' . $product->image))) {
                File::delete(public_path('uploads/products/' . $product->image));
            }
            // Upload baru
            $file = $request->file('image');
            $fileName = time() . '_1_' . str_replace(' ', '_', $file->getClientOriginalName());
            $file->move(public_path('uploads/products'), $fileName);
            $input['image'] = $fileName;
        } else {
            // Jika tidak upload, biarkan data lama (jangan di-null-kan)
            unset($input['image']); 
        }

        // 3. LOGIKA UPDATE GAMBAR 2 (GUNAKAN IF BARU, JANGAN ELSE IF)
        if ($request->hasFile('image2')) {
            // Hapus gambar lama 2
            if ($product->image2 && File::exists(public_path('uploads/products/' . $product->image2))) {
                File::delete(public_path('uploads/products/' . $product->image2));
            }
            // Upload baru
            $file2 = $request->file('image2');
            $fileName2 = time() . '_2_' . str_replace(' ', '_', $file2->getClientOriginalName());
            $file2->move(public_path('uploads/products'), $fileName2);
            $input['image2'] = $fileName2;
        } else {
            // Jika tidak upload, biarkan data lama
            unset($input['image2']);
        }

        // 4. Update Database
        $product->update($input);

        return redirect()->route('admin.products')->with('success', 'Produk berhasil diperbarui.');
    }

    // 7. HAPUS (Tambahkan hapus image2)
    public function destroy($id)
    {
        $product = Product::findOrFail($id);
        
        // Hapus File Gambar 1
        if ($product->image && File::exists(public_path('uploads/products/' . $product->image))) {
            File::delete(public_path('uploads/products/' . $product->image));
        }

        // Hapus File Gambar 2 (TAMBAHAN)
        if ($product->image2 && File::exists(public_path('uploads/products/' . $product->image2))) {
            File::delete(public_path('uploads/products/' . $product->image2));
        }

        $product->delete();
        return redirect()->route('admin.products')->with('success', 'Produk dihapus.');
    }
}