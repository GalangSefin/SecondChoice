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
            $table->id();  // Kolom ID otomatis
            $table->string('category');  // Kategori produk
            $table->string('type');  // Jenis produk
            $table->string('name');  // Nama produk
            $table->text('description')->nullable();  // Deskripsi produk (nullable)
            $table->decimal('price', 10, 2);  // Harga produk
            $table->integer('stock');  // Jumlah stok produk
            $table->string('condition');  // Kondisi produk (baru/bekas)
            $table->string('image');
            $table->timestamps();  // Kolom created_at dan updated_at
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
