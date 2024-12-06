<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddPhoneNumberToUsersTable extends Migration
{
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            // Menambahkan kolom phone_number dengan tipe data string dan bersifat nullable
            $table->string('phone_number')->nullable()->after('email'); // Anda bisa memilih posisi kolom dengan after()
        });
    }

    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            // Menghapus kolom phone_number jika rollback dilakukan
            $table->dropColumn('phone_number');
        });
    }
}
