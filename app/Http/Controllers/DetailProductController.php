<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;
use App\Models\Keranjang;
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

    public function addToCart(Request $request)
    {
        try {
            $product = Product::with(['images'])->findOrFail($request->product_id);
            
            // Ambil gambar pertama
            $firstImage = $product->images->first();
            $productImage = $firstImage ? $firstImage->image : null;

            // Buat atau update item di keranjang
            $cartItem = Keranjang::updateOrCreate(
                [
                    'user_id' => auth()->id(),
                    'product_id' => $product->id,
                ],
                [
                    'quantity' => 1,
                    'price' => $product->price,
                    'product_name' => $product->name,
                    'product_description' => $product->description,
                    'product_category' => $product->namacategory->category_nama,
                    'product_jenis' => $product->namajenis->jenis_nama,
                    'product_stock' => $product->stock,
                    'product_condition' => $product->condition,
                    'product_image' => $productImage,
                ]
            );

            if ($request->action === 'buy-now') {
                return redirect()->route('checkout.index');
            }

            return redirect()->back()->with('success', 'Produk berhasil ditambahkan ke keranjang');

        } catch (\Exception $e) {
            Log::error('Error adding to cart: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Gagal menambahkan produk ke keranjang');
        }
    }
}
