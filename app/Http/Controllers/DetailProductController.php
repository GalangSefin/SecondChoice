<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;

class DetailProductController extends Controller
{
    public function show($id)
    {
        try {
            // Query untuk mengambil produk dengan semua relasi yang diperlukan
            $query = Product::with(['images', 'seller', 'namacategory', 'namajenis']);
            
            // Mengambil produk berdasarkan ID
            $product = $query->findOrFail($id);

            // Proses dekripsi gambar
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

            // Kirim data ke view
            return view('frontend.detail_produk', [
                'product' => $product,
            ]);

        } catch (\Exception $e) {
            Log::error('Error in show function: ' . $e->getMessage());
            return redirect()->route('home')->with('error', 'Produk tidak ditemukan');
        }
    }
}
