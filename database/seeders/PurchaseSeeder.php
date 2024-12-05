<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Purchase;

class PurchaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Purchase::create([
            'user_id' => 1,
            'name' => 'Crop Top',
            'size' => 'M',
            'color' => 'White',
            'price' => 45000,
            'total' => 50000,
            'estimated_delivery' => '2024-11-10',
            'status' => 'dikemas',
            'image' => 'croptop.jpg',
        ]);

        Purchase::create([
            'user_id' => 1,
            'name' => 'Galon Aqua',
            'size' => null,
            'color' => 'Blue',
            'price' => 28000,
            'total' => 33000,
            'estimated_delivery' => '2024-11-10',
            'status' => 'dikirim',
            'image' => 'galon.jpeg',
        ]);
    }
}
