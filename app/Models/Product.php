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
        'price_min',      
        'is_ready_stock', 
        'status',         
        'sold_count',
        'name_en',
        'description_en',
        'name_zh',
        'description_zh',
    ];
}