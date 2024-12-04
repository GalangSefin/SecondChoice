<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Product; // pastikan ada model Product


class KategoriController extends Controller
{
    /**
     * Menampilkan halaman kategori.
     *
     * @return \Illuminate\View\View
     */
    // public function index()
    // {
        
    //     return view('frontend'); // Pastikan file view sesuai dengan struktur proyek Anda
    // }
    public function index(Request $request)
{
    $search = $request->input('search', '');
    $categories = Category::all(); // Ambil semua kategori dari database
    
    $products = Product::when($search, function ($query, $search) {
        return $query->where('name', 'LIKE', '%' . $search . '%');
    })->paginate(30);

    return view('frontend.ViewAll', compact('products', 'categories'));
}
}