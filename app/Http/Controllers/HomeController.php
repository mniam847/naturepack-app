<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product; // <--- PENTING: Panggil Model Product

class HomeController extends Controller
{
    public function index()
    {
        // AMBIL DATA DARI DATABASE (bukan manual lagi)
        $featured_products = Product::all(); 

        return view('home', compact('featured_products'));
    }
}