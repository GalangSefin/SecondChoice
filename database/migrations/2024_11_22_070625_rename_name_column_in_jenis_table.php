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
            $table->dropColumn('name');
        });

        // Menambahkan kolom baru dengan nama 'jenis_name'
        Schema::table('jenis', function (Blueprint $table) {
            $table->string('jenis_name');
        });
    }

    public function down()
    {
        // Menghapus kolom 'jenis_name' yang baru
        Schema::table('jenis', function (Blueprint $table) {
            $table->dropColumn('jenis_name');
        });

        // Menambahkan kembali kolom 'name' yang lama
        Schema::table('jenis', function (Blueprint $table) {
            $table->string('name');
        });
    }
};
