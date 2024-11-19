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
        // Mengambil data produk dari database
        $products = Product::all(); // atau bisa menggunakan query lain sesuai kebutuhan

        // Mengirim data produk ke view
        return view('frontend.ViewAll', compact('products'));
    }
}
