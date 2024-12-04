<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Keranjang;
use App\Models\Product;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;

class KeranjangController extends Controller
{
    // Menampilkan Keranjang
    public function showKeranjang()
    {
        $user_id = auth()->id();
        
        $keranjangItems = Keranjang::with([
            'product.images',
            'seller:id,name',
        ])
        ->where('user_id', $user_id)
        ->get()
        ->groupBy('seller_id');

        // Debug dan decode gambar
        foreach($keranjangItems as $items) {
            foreach($items as $item) {
                Log::info('Product ID: ' . $item->product_id);
                Log::info('Product Name: ' . $item->product->name);
                
                if($item->product->images->isNotEmpty()) {
                    foreach($item->product->images as $image) {
                        try {
                            $path = 'public/products/' . basename($image->image);
                            Log::info('Checking image path: ' . $path);
                            
                            if (Storage::exists($path)) {
                                $encryptedContent = Storage::get($path);
                                $decryptedContent = decrypt($encryptedContent);
                                $base64Image = base64_encode($decryptedContent);
                                $image->decoded_image = 'data:image/jpeg;base64,' . $base64Image;
                                Log::info('Image successfully decoded');
                            } else {
                                Log::warning('Image file not found: ' . $path);
                                $image->decoded_image = asset('second_choice/images/no-image.png');
                            }
                        } catch (\Exception $e) {
                            Log::error('Error decrypting image: ' . $e->getMessage());
                            $image->decoded_image = asset('second_choice/images/no-image.png');
                        }
                    }
                } else {
                    Log::info('No images found for product');
                }
            }
        }

        return view('frontend.keranjang', compact('keranjangItems'));
    }
    

    public function addToKeranjang(Request $request)
{
    $product_id = $request->product_id;
    $action = $request->action;

    // Validasi keberadaan produk
    $product = Product::findOrFail($product_id);

    // Ambil user_id dan seller_id
    $user_id = auth()->id(); // Pastikan user login
    $seller_id = $product->user_id;

    if ($action === 'add-to-cart') {
        // Cek apakah sudah ada produk di keranjang
        $keranjangItem = Keranjang::where('user_id', $user_id)
                                  ->where('product_id', $product_id)
                                  ->first();

        if ($keranjangItem) {
            // Jika produk sudah ada, tambahkan quantity
            $keranjangItem->quantity += 1;
            $keranjangItem->save();
        } else {
            // Tambahkan produk baru ke keranjang
            Keranjang::create([
                'user_id' => $user_id,
                'seller_id' => $seller_id,
                'product_id' => $product->id,
                'quantity' => 1,
                'price' => $product->price,
            ]);
        }

        return redirect()->back()->with('success', 'Produk berhasil ditambahkan ke keranjang!');
    } elseif ($action === 'buy-now') {
        // Alihkan ke halaman checkout
        return redirect()->route('checkout')->with('product_id', $product->id);
    }

    // Jika aksi tidak valid
    return redirect()->back()->with('error', 'Aksi tidak valid.');
}


    // Menghapus produk dari keranjang
    public function removeFromKeranjang($id)
    {
        $keranjangItem = Keranjang::findOrFail($id);

        // Pastikan item milik user yang sedang login
        if ($keranjangItem->user_id === auth()->id()) {
            $keranjangItem->delete();
            return redirect()->back()->with('success', 'Item berhasil dihapus dari keranjang!');
        }

        return redirect()->back()->with('error', 'Anda tidak berhak menghapus item ini.');
    }

    // Mengubah jumlah item dalam keranjang
    public function updateQuantity(Request $request, $id)
    {
        $keranjangItem = Keranjang::findOrFail($id);

        // Pastikan item milik user yang sedang login
        if ($keranjangItem->user_id === auth()->id()) {
            $keranjangItem->quantity = $request->quantity;
            $keranjangItem->save();
            return redirect()->back()->with('success', 'Jumlah item berhasil diperbarui!');
        }

        return redirect()->back()->with('error', 'Anda tidak berhak memperbarui item ini.');
    }
}
