<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'product_id',
        'customer_name',      // Wajib (No Null)
        'email',              // Boleh Null
        'customer_whatsapp',  // Wajib (No Null)
        'length',             // Wajib (No Null)
        'width',              // Wajib (No Null)
        'height',             // Wajib (No Null)
        'notes',              // Boleh Null
        'material',           // WAJIB (No Null)
        'quantity',           // Wajib (No Null)
        'design_file',        // Boleh Null
        'status',             // Ada default, tapi boleh diisi
    ];

    // Relasi ke Produk
    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}