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
        // Menghapus kolom 'name' yang lama
        Schema::table('jenis', function (Blueprint $table) {
            $table->dropColumn('jenis_name');
        });

         // Menambahkan kolom baru dengan nama 'jenis_nama' setelah kolom 'category_id'
         Schema::table('jenis', function (Blueprint $table) {
            $table->string('jenis_nama')->after('category_id');
        });
    }

    public function down()
    {
        // Menghapus kolom 'jenis_nama' yang baru
        Schema::table('jenis', function (Blueprint $table) {
            $table->dropColumn('jenis_nama');
        });

        // Menambahkan kembali kolom 'jenis_name' setelah kolom 'category_id'
        Schema::table('jenis', function (Blueprint $table) {
            $table->string('jenis_name')->after('category_id');
        });
    }
};
