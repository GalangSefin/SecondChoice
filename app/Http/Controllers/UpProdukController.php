<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;

class UpProdukController extends Controller
{
   // Menampilkan form unggah produk
   public function tampilForm()
   {
       return view('frontend.uploadproduk'); // Nama view yang sudah Anda buat
   }

   // Menangani pengiriman produk
   public function store(Request $request)
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
       $product = Product::create([
        'category' => $validated['category'],
        'type' => $validated['type'],
        'name' => $validated['name'],
        'description' => $validated['description'] ?? '',
        'price' => $validated['price'],
        'stock' => $validated['stock'],
        'condition' => $validated['condition'],
        'user_id' => Auth::id(), // Asosiasi dengan pengguna
    ]);

       // Menangani unggahan gambar (jika ada)
       if ($request->hasFile('images')) {
           foreach ($request->file('images') as $image) {
               // Menyimpan gambar ke folder 'products' di storage
               $path = $image->store('products', 'public');

               // Jika Anda memiliki model ProductImage untuk mengelola gambar produk
               $product->images()->create(['path' => $path]);
           }
       }

       // Arahkan ke halaman produk yang baru dibuat, atau halaman sukses
       return redirect()->route('dashboard')
                        ->with('success', 'Produk berhasil ditambahkan!');
   }
}