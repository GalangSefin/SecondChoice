<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use Illuminate\Support\Facades\Storage;
use App\Models\ProductImage;


class UpProdukController extends Controller
{
   // Menampilkan form unggah produk
   public function tampilForm()
   {
       return view('frontend.uploadproduk'); // Nama view yang sudah Anda buat
   }

   // Menangani pengiriman produk
   public function kirimProduk(Request $request)
   {
       // Validasi data yang dikirimkan
       $validated = $request->validate([
           'category' => 'required|string',
           'type' => 'required|string',
           'name' => 'required|string|max:255',
           'description' => 'nullable|string',
           'price' => 'required|numeric|min:0',
           'stock' => 'required|integer|min:0',
           'condition' => 'required|string',
           'images' => 'nullable|array',
           'images.*' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
       ]);

       // Membuat produk baru
       $produk = Product::create([
        'user_id' => auth()->id(),
        'category' => $validated['category'],
        'type' => $validated['type'],
        'name' => $validated['name'],
        'description' => $validated['description'] ?? '',
        'price' => $validated['price'],
        'stock' => $validated['stock'],
        'condition' => $validated['condition'],
    ]);


       // Menangani unggahan gambar (jika ada)
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                // Menyimpan gambar ke folder 'public/products'
                $imageName = time() . '_' . $image->getClientOriginalName();
                $imagePath = $image->storeAs('public/products', $imageName);

                // Menyimpan path gambar ke tabel 'product_images'
                ProductImage::create([
                    'product_id' => $produk->id,
                    'image_name' => $imageName,
                    'image_path' => $imagePath,
                    'image_url' => Storage::url($imagePath),
                ]);
            }
        }

    //    // Arahkan ke halaman produk yang baru dibuat, atau halaman sukses
       return redirect()->route('listings', $produk->id)
                        ->with('success', 'Produk sukses ditambahkan!');
   }
}