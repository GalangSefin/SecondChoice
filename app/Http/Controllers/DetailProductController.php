<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class DetailProductController extends Controller
{
    public function show($id)
    {
        // Mengambil data produk dengan relasi
        $products = Product::with(['images', 'seller'])->findOrFail($id);

        // Mengembalikan view dengan data produk
        return view('frontend.detail_produk', compact('products'));
    }
}
