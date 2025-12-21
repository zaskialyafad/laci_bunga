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
        Schema::create('Product_variations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('product_id')->constrained()->onDelete('cascade');
            $table->string('size')->nullable();  // Contoh: XL, L, 42, 43
            $table->string('color')->nullable(); // Contoh: Merah, hijau
            $table->unsignedInteger('price')->default(0); // Harga produk per varian tapi bisa juga perproduk
            $table->unsignedInteger('stock')->default(0); // Stok spesifik varian
            $table->string('sku')->unique(); // Stock Keeping Unit, kode unik untuk tiap varian
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ProductVariations');
    }
};
