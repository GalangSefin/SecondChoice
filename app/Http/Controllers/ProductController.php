<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;

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
        // Ambil daftar kategori unik dari tabel 'products'
        $categories = Product::select('category')->distinct()->pluck('category');

    // Query dasar untuk mengambil produk
    $query = Product::with('images');

    // Filter berdasarkan kolom 'category'
    if ($request->has('category') && $request->category != '') {
        $query->where('category', $request->category);
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
        $products = $query->with('images')->paginate(12);

        foreach ($products as $product) {
            if ($product->images->isNotEmpty()) {
                foreach ($product->images as $image) {
                    try {
                        $path = 'public/products/' . basename($image->image);
                        if (Storage::exists($path)) {
                            $encryptedContent = Storage::get($path);
                            $decryptedContent = decrypt($encryptedContent);
                            $base64Image = base64_encode($decryptedContent);
                            $image->decoded_image = 'data:image/jpeg;base64,' . $base64Image;
                        }
                    } catch (\Exception $e) {
                        Log::error('Error decrypting image: ' . $e->getMessage());
                        $image->decoded_image = asset('second_choice/images/no-image.png');
                    }
                }
            }
        }

        // Kirim data produk ke view bersama filter aktif
        return view('frontend.ViewAll', [
            'products' => $products,
            'filters' => $request->all(),
            'categories' => $categories, // Kirim data kategori ke view
        ]);
    }
}