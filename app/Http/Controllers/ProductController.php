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
    public function viewAll(Request $request)
    {

        // Mengambil semua daftar produk tanpa filter berdasarkan user
        $products = Product::with('images')->paginate(9);

        // Mengambil data produk dari database
        // $products = Product::all(); // atau bisa menggunakan query lain sesuai kebutuhan
        $search = $request->search;

        if ($search) {
            $products = Product::where('name', 'LIKE', '%' . $search . '%')
                ->orWhere('category', 'LIKE', '%' . $search . '%')
                ->get();
        } else {
            $produk = Product::all(); // Ambil semua produk jika pencarian kosong
        }
        // Mengirim data produk ke view
        return view('frontend.ViewAll', compact('products'));
    }
}
