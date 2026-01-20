<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    // Daftar kolom yang boleh diisi secara massal (melalui formulir)
    protected $fillable = [
        'product_id',
        'name',
        'email',       // <--- PENTING: Sudah ditambahkan
        'whatsapp',
        'quantity',
        'length',      // Dimensi custom
        'width',
        'height',
        'notes',
        'status',      // pending, processed, completed
    ];

    // Relasi: Setiap Order "milik" satu Product
    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}