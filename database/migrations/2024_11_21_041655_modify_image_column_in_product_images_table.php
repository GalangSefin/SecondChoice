<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // Ubah kolom menjadi LONGBLOB menggunakan SQL mentah
        DB::statement('ALTER TABLE product_images MODIFY image LONGBLOB');
    }

    public function down(): void
    {
        // Ubah kembali ke tipe data sebelumnya jika rollback dilakukan
        DB::statement('ALTER TABLE product_images MODIFY image BLOB');
    }
};
