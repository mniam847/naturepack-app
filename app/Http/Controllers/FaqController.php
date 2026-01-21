<?php

namespace App\Http\Controllers;

use App\Models\Faq;
use Illuminate\Http\Request;

class FaqController extends Controller
{
    // Tampilkan Daftar FAQ
    public function index()
    {
        $faqs = Faq::all();
        return view('admin.faqs.index', compact('faqs'));
    }

    // Tampilkan Form Tambah
    public function create()
    {
        return view('admin.faqs.create');
    }

    // Simpan FAQ Baru
    public function store(Request $request)
    {
        $request->validate([
            'question' => 'required',
            'answer' => 'required',
        ]);

        Faq::create($request->all());

        return redirect()->route('admin.faqs')->with('success', 'FAQ berhasil ditambahkan!');
    }

    // Tampilkan Form Edit
    public function edit($id)
    {
        $faq = Faq::findOrFail($id);
        return view('admin.faqs.edit', compact('faq'));
    }

    // Update FAQ
    public function update(Request $request, $id)
    {
        $request->validate([
            'question' => 'required',
            'answer' => 'required',
        ]);

        $faq = Faq::findOrFail($id);
        $faq->update($request->all());

        return redirect()->route('admin.faqs')->with('success', 'FAQ berhasil diperbarui!');
    }

    // Hapus FAQ
    public function destroy($id)
    {
        $faq = Faq::findOrFail($id);
        $faq->delete();

        return redirect()->route('admin.faqs')->with('success', 'FAQ berhasil dihapus!');
    }
}