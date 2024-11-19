<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use Illuminate\Support\Facades\Storage;

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
       $produk = new Product();
       $produk->user_id = auth()->id();  // Mengambil ID pengguna yang sedang login
       $produk->category = $validated['category'];
       $produk->type = $validated['type'];
       $produk->name = $validated['name'];
       $produk->description = $validated['description'] ?? '';  // Jika tidak ada deskripsi, kosongkan
       $produk->price = $validated['price'];
       $produk->stock = $validated['stock'];
       $produk->condition = $validated['condition'];

       // Simpan produk pertama kali untuk mendapatkan ID
       $produk->save();

       // Menangani unggahan gambar (jika ada)
       if ($request->hasFile('images')) {
           foreach ($request->file('images') as $image) {
               // Menyimpan gambar ke folder 'products' di storage
               $path = $image->store('products', 'public');

               // Jika Anda memiliki model ProductImage untuk mengelola gambar produk
               $produk->images()->create([
                   'path' => $path,
               ]);
           }
       }

    //    // Arahkan ke halaman produk yang baru dibuat, atau halaman sukses
    //    return redirect()->route('product.show', $produk->id)
    //                     ->with('success', 'Produk berhasil ditambahkan!');
   }
}