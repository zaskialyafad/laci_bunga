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
        Schema::create('gambar_produks', function (Blueprint $table) {
            $table->id();
        $table->foreignId('product_id')->constrained()->onDelete('cascade');
        $table->string('image'); // nama file gambar
        $table->boolean('is_primary')->default(true); // Untuk foto utama yang ditampikan di web
        $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('Gambar_produks');
    }
};
