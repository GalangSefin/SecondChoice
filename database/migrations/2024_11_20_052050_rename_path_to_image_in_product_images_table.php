<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        DB::statement('ALTER TABLE product_images CHANGE COLUMN path image VARCHAR(255)');
    }

    public function down(): void
    {
        DB::statement('ALTER TABLE product_images CHANGE COLUMN image path VARCHAR(255)');
    }
};