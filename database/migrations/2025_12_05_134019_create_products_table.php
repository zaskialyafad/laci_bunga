
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
        
        Schema::create('products', function (Blueprint $table) {
            $table->id();  // primary key
            $table->foreignId('category_id')->constrained()->onDelete('cascade'); // foreign key ke tabel kategori, cascade agar saat kategori dihapus, produk terkait juga terhapus
            $table->string('name'); // nama produk
            $table->text('description')->nullable(); //deskripsi produk tapi bisa null atau kosong (isinya detail bahan, ukuran, dll)
            $table->string('price');
            $table->timestamps(); // created_at dan updated_at
        });   
     }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
