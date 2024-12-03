<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;

class HomeController extends Controller
{
    public function home(Request $request)
    {
        // Mengambil semua kategori
        $categories = Category::all();
    
        // Menangkap parameter pencarian (jika ada)
        $search = $request->input('search');
    
        // Query untuk produk baru
        $query = Product::with('images', 'category');
    
        // Jika ada pencarian, tambahkan filter
        if ($search) {
            $query->where('name', 'LIKE', '%' . $search . '%')
                  ->orWhere('description', 'LIKE', '%' . $search . '%');
        }
    
        // Ambil produk terbaru (terbatas pada 12 jika tidak ada pencarian)
        $newproducts = $query->latest()->paginate(12); // Pagination mendukung pencarian
    
        foreach ($newproducts as $product) {
            if ($product->images->isNotEmpty()) {
                foreach ($product->images as $image) {
                    try {
                        $path = 'public/products/' . basename($image->image);
                        if (Storage::exists($path)) {
                            $encryptedContent = Storage::get($path);
                            $decryptedContent = decrypt($encryptedContent);
                            $base64Image = base64_encode($decryptedContent);
                            $image->decoded_image = 'data:image/jpeg;base64,' . $base64Image;
                        } else {
                            Log::warning('Image file not found: ' . $path);
                            $image->decoded_image = asset('second_choice/images/no-image.png');
                        }
                    } catch (\Exception $e) {
                        Log::error('Error decrypting image: ' . $e->getMessage());
                        $image->decoded_image = asset('second_choice/images/no-image.png');
                    }
                }
            }
        }
    
        // Kirim data ke view
        return view('frontend.home', [
            'newproducts' => $newproducts,
            'categories' => $categories,
            'search' => $search, // Kirim kata kunci pencarian untuk ditampilkan di form
        ]);
    }
        

    public function show($id)
    {
        $product = Product::with('images', 'category')->findOrFail($id);

        if ($product->images->isNotEmpty()) {
            foreach ($product->images as $image) {
                try {
                    $path = 'public/products/' . basename($image->image);
                    if (Storage::exists($path)) {
                        $encryptedContent = Storage::get($path);
                        $decryptedContent = decrypt($encryptedContent);
                        $base64Image = base64_encode($decryptedContent);
                        $image->decoded_image = 'data:image/jpeg;base64,' . $base64Image;
                    } else {
                        $image->decoded_image = asset('second_choice/images/no-image.png');
                    }
                } catch (\Exception $e) {
                    Log::error('Error decrypting image: ' . $e->getMessage());
                    $image->decoded_image = asset('second_choice/images/no-image.png');
                }
            }
        }

        return view('frontend.product-detail', compact('product'));
    }

}
