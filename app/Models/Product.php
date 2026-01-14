<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    // // Daftar kolom yang diizinkan diisi lewat Product::create()
    // protected $fillable = [
    //     'name',
    //     'slug',        // Penting: karena di controller ada 'slug' => ...
    //     'category',
    //     'price_min',
    //     'description',
    //     'image',
    // ];
    // Artinya: "Izinkan semua kolom diisi"
    protected $guarded = [];
}
