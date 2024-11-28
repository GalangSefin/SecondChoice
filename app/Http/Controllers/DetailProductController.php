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
            // Tambahkan eager loading untuk namajenis dan namacategory
            $product = Product::with(['images', 'seller', 'namajenis', 'namacategory'])
                             ->findOrFail($id);

            // Dekripsi gambar
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

            return view('frontend.detail_produk', compact('product'));

        } catch (\Exception $e) {
            Log::error('Error in show function: ' . $e->getMessage());
            return redirect()->route('home')->with('error', 'Produk tidak ditemukan');
        }
    }
}
