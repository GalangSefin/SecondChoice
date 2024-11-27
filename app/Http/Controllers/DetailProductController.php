<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;

class DetailProductController extends Controller
{
    public function show($id)
    {
        // Mengambil data produk dengan relasi
        $products = Product::with(['images', 'seller', 'namacategory', 'namajenis'])->findOrFail($id);

        // Mengembalikan view dengan data produk
        return view('frontend.detail_produk', compact('product'));
    }
}
