<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product; // pastikan ada model Product

class ProductController extends Controller
{
    /**
     * Menampilkan daftar produk.
     *
     * @return \Illuminate\View\View
     */
    public function viewAll()
    {

        // Mengambil semua daftar produk tanpa filter berdasarkan user
        $products = Product::with('images')->paginate(9);

        // Mengirim data produk ke view
        return view('frontend.ViewAll', compact('products'));
    }
}
