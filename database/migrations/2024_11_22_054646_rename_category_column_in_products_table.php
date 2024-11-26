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
        Schema::table('products', function (Blueprint $table) {
            // Hapus kolom category yang lama
            $table->dropColumn('category');
            
            // Tambahkan kolom category_id baru sebagai foreign key
            $table->unsignedBigInteger('category_id')->after('id');
            $table->foreign('category_id')->references('id')->on('category')->onDelete('cascade');

            // Hapus kolom type yang lama
            $table->dropColumn('type');

            // Tambahkan kolom jenis_id baru sebagai foreign key
            $table->unsignedBigInteger('jenis_id')->after('category_id');
            $table->foreign('jenis_id')->references('id')->on('jenis')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('products', function (Blueprint $table) {
            // Hapus foreign key dari category_id dan jenis_id
            $table->dropForeign(['category_id']);
            $table->dropForeign(['jenis_id']);

            // Hapus kolom category_id dan jenis_id
            $table->dropColumn('category_id');
            $table->dropColumn('jenis_id');

            // Tambahkan kembali kolom category dan type
            $table->string('category')->after('id');
            $table->string('type')->after('category');

        });
    }
};
