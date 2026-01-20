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
            // 1. Cek & Buat kolom 'price' jika belum ada (agar fitur sort harga jalan)
            // Kita taruh setelah 'price_min' agar rapi
            if (!Schema::hasColumn('products', 'price')) {
                $table->decimal('price', 15, 2)->default(0)->after('price_min');
            }

            // 2. Tambahkan kolom 'status' (ready/empty)
            if (!Schema::hasColumn('products', 'status')) {
                // Kita taruh setelah kolom image atau price_min
                $table->enum('status', ['ready', 'empty'])->default('ready')->after('image');
            }

            // 3. Tambahkan kolom 'sold_count' (jumlah terjual)
            if (!Schema::hasColumn('products', 'sold_count')) {
                $table->integer('sold_count')->default(0)->after('status');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('products', function (Blueprint $table) {
            // Hapus kolom jika migrasi di-rollback
            if (Schema::hasColumn('products', 'sold_count')) {
                $table->dropColumn('sold_count');
            }
            if (Schema::hasColumn('products', 'status')) {
                $table->dropColumn('status');
            }
            if (Schema::hasColumn('products', 'price')) {
                $table->dropColumn('price');
            }
        });
    }
};