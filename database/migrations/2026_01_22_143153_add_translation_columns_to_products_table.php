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
        Schema::table('products', function (Blueprint $table) {
            // Kolom untuk Bahasa Inggris
            $table->string('name_en')->nullable()->after('name');
            $table->text('description_en')->nullable()->after('description');

            // Kolom untuk Bahasa Mandarin (China)
            $table->string('name_zh')->nullable()->after('name_en');
            $table->text('description_zh')->nullable()->after('description_en');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('products', function (Blueprint $table) {
            //
        });
    }
};
