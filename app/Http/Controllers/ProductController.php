<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;

class ProductController extends Controller
{
    /**
     * Menampilkan daftar produk dengan filter.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\View\View
     */
    public function viewAll(Request $request)
    {
        // Mengambil semua kategori
        $categories = Category::all();
        
        // Query dasar untuk mengambil produk beserta relasinya
        $query = Product::with('images', 'category');

       // Filter berdasarkan nama kategori (bukan id kategori)
    if ($request->has('category') && $request->category != '') {
        $query->whereHas('category', function ($q) use ($request) {
            $q->where('id', $request->category); // Filter berdasarkan nama kategori
        });
    }

        // Filter Price
        if ($request->has('price') && $request->price != '') {
            if ($request->price == 'under_50000') {
                $query->where('price', '<', 50000);
            } elseif ($request->price == '50k_100k') {
                $query->whereBetween('price', [50000, 100000]);
            } elseif ($request->price == '100k_200k') {
                $query->whereBetween('price', [100000, 200000]);
            } elseif ($request->price == 'above_200k') {
                $query->where('price', '>', 200000);
            }
        }

        // Filter Condition
        if ($request->has('condition') && $request->condition != '') {
            $query->where('condition', $request->condition);
        }

        // Sort Options
        if ($request->has('sort') && $request->sort != '') {
            if ($request->sort == 'lowest_price') {
                $query->orderBy('price', 'asc');
            } elseif ($request->sort == 'highest_price') {
                $query->orderBy('price', 'desc');
            } elseif ($request->sort == 'newest') {
                $query->orderBy('created_at', 'desc');
            } elseif ($request->sort == 'oldest') {
                $query->orderBy('created_at', 'asc');
            }
        }

        // Mengambil produk berdasarkan query (termasuk filter jika ada)
        $products = $query->get();

        // Kirim data produk ke view bersama filter aktif
        return view('frontend.ViewAll', [
            'products' => $products,
            'filters' => $request->all(),
            'categories' => $categories, // Kirim data kategori ke view
        ]);
    }
}