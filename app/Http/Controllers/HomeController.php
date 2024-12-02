<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product; // pastikan ada model Product
use Illuminate\Support\Facades\Log;

class HomeController extends Controller
{
    /**
     * Menampilkan daftar produk.
     *
     * @return \Illuminate\View\View
     */
    public function home()
    {
       // Mengambil 12 produk terbaru dari database
       $products = Product::with('images')->latest()->take(12)->get();

       // Debugging
        Log::info('Products fetched: ', ['products' => $products]);

        // Mengirimkan data ke view
        return view('frontend.ViewAll', compact('products'));
    }
    public function search(Request $request){
        $search = $request->input('search', ''); // Default ke string kosong jika tidak ada input
        $products = Product::when($search, function ($query, $search) {
            return $query->where('name', 'LIKE', '%'.$search.'%');
        })->paginate(30);
        return view('frontend.ViewAll', compact('products'));

    }
}
