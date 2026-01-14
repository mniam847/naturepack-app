<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->string('customer_name');
            $table->string('customer_whatsapp'); // Penting untuk notifikasi
            
            // Spesifikasi Box
            $table->integer('length'); // Panjang
            $table->integer('width');  // Lebar
            $table->integer('height'); // Tinggi
            $table->string('material'); // Bahan
            $table->integer('quantity'); // Jumlah
            
            $table->string('design_file')->nullable(); // Nama file upload
            $table->string('status')->default('Menunggu Konfirmasi'); // Status pesanan
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::dropIfExists('orders');
    }
};