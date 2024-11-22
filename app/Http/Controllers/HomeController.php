<?php

namespace App\Http\Controllers;
use App\Models\Product;
use Illuminate\Http\Request;
class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Request $request)
    {
        $search = $request->search;

        if ($search) {
            $produk = Product::where('name', 'LIKE', '%' . $search . '%')
                ->orWhere('category', 'LIKE', '%' . $search . '%')
                ->get();
        } else {
            $produk = Product::all(); // Ambil semua produk jika pencarian kosong
        }

        // Mengarahkan ke file viewall.blade.php dengan data $produk
        return view('ViewAll', compact('produk'));
    }
}

