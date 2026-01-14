<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        // Pastikan import DB di paling atas: use Illuminate\Support\Facades\DB;
        
        \Illuminate\Support\Facades\DB::table('products')->insert([
            [
                'name' => 'Box Pizza Regular',
                'slug' => 'box-pizza-regular',
                'category' => 'Food Grade',
                'description' => 'Box pizza standar ukuran 20x20cm, bahan kokoh.',
                'price_min' => 1500,
                'image' => 'https://via.placeholder.com/300/0000FF/808080?text=PizzaBox',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Kardus Packing Baju',
                'slug' => 'kardus-packing-baju',
                'category' => 'Shipping',
                'description' => 'Kardus e-commerce untuk pengiriman baju aman.',
                'price_min' => 2500,
                'image' => 'https://via.placeholder.com/300/FF0000/FFFFFF?text=ShippingBox',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Hardbox Gift Premium',
                'slug' => 'hardbox-gift-premium',
                'category' => 'Gift Box',
                'description' => 'Kotak kado tebal dengan penutup magnet.',
                'price_min' => 15000,
                'image' => 'https://via.placeholder.com/300/FFFF00/000000?text=Hardbox',
                'created_at' => now(),
                'updated_at' => now(),
            ]
        ]);
    }
}
