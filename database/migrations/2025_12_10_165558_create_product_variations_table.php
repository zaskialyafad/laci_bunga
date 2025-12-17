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
        Schema::create('ProductVariations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('product_id')->constrained('products')->onDelete('cascade');
            $table->string('size');  // Contoh: XL, L, 42, 43
            $table->string('color'); // Contoh: Merah, hijau
            $table->unsignedInteger('price'); // Harga spesifik varian
            $table->unsignedInteger('stock'); // Stok spesifik varian
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
