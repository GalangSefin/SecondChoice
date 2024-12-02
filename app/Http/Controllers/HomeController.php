<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;

class HomeController extends Controller
{
    public function index(Request $request){
        $search = $request->search;

        $produk = Product::where('name', 'LIKE', '%'.$search. '%')->paginate(30);
        return view('frontend.ViewAll', compact('product'));
   
    }
    public function home()
    {
        // Mengambil semua kategori
        $categories = Category::all();

        // Query dasar untuk mengambil produk beserta relasinya
        $query = Product::with('images', 'category');

        // Mengambil produk berdasarkan query (termasuk filter jika ada)
        $newproducts = $query->latest()->take(12)->get();

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

        // Kirim data produk ke view dengan nama variabel baru
        return view('frontend.home', [
            'newproducts' => $newproducts,
            'categories' => $categories,
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
