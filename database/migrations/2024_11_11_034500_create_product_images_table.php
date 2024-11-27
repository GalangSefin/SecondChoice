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
        Schema::create('product_images', function (Blueprint $table) {
            $table->id();  // Kolom ID otomatis
            $table->foreignId('product_id')->constrained()->onDelete('cascade');
            $table->string('image_name');  // Nama file gambar
            $table->string('image_path');  // Path gambar di direktori server
            $table->string('image_url');   // URL gambar untuk akses via HTTP
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('product_images');
    }
};
