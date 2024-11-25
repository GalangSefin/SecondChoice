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
        Schema::table('category', function (Blueprint $table) {
            $table->dropColumn('name');
        });

        // Menambahkan kolom baru dengan nama 'category_name'
        Schema::table('category', function (Blueprint $table) {
            $table->string('category_name');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Menghapus kolom 'category_name' yang baru
        Schema::table('category', function (Blueprint $table) {
            $table->dropColumn('category_name');
        });

        // Menambahkan kembali kolom 'name' yang lama
        Schema::table('category', function (Blueprint $table) {
            $table->string('name');
        });
    }
};
