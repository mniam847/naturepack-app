<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Faq;

class HomeController extends Controller
{
    public function index()
    {
        // AMBIL DATA DARI DATABASE (bukan manual lagi)
        $featured_products = Product::all(); 


        return view('home', compact('featured_products'));
    }

    public function faq() 
    {
        // 2. AMBIL DATA DARI DATABASE
        $faqs = Faq::all(); 

        // 3. KIRIM DATA KE VIEW (Tambahkan compact)
        return view('faq', compact('faqs')); 
    }
}