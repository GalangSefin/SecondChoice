<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        // Menonaktifkan pemeriksaan foreign key
        DB::statement('SET FOREIGN_KEY_CHECKS = 0;');

        // Menghapus data di tabel yang bergantung pada foreign key
        DB::table('keranjang')->truncate(); // Menghapus data keranjang

        // Menghapus data pada tabel utama
        DB::table('products')->truncate();
        DB::table('jenis')->truncate();
        DB::table('category')->truncate();

        // Mengaktifkan kembali pemeriksaan foreign key
        DB::statement('SET FOREIGN_KEY_CHECKS = 1;');
    }

    public function down()
    {
        // Opsional: menambahkan data kembali jika diperlukan
    }
};
