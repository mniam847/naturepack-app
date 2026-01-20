<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('products', function (Blueprint $table) {
            // HAPUS kolom 'price' karena kita sudah sepakat pakai 'price_min'
            // Pastikan kolom ini benar-benar ada di database sebelumnya, kalau ragu bisa dihapus baris ini
            if (Schema::hasColumn('products', 'price')) {
                $table->dropColumn('price');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('products', function (Blueprint $table) {
            // Ini perintah untuk membatalkan (mengembalikan kolom price jika di-rollback)
            $table->decimal('price', 10, 2)->default(0)->after('price_min');
        });
    }
};