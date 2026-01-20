<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'slug',
        'category',
        'description',
        'image',
        'price_min',      // KITA PAKAI INI SAJA
        'is_ready_stock', // Sesuai database Anda (tinyint)
        'status',         // Opsional (jika masih dipakai untuk filter)
        'sold_count',
    ];
}