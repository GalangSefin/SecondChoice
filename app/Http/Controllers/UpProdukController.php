<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use Illuminate\Support\Facades\Storage;
use App\Models\ProductImage;
use App\Models\Category;
use App\Models\Jenis;

class UpProdukController extends Controller
{
   public function tampilForm()
   {
       return view('frontend.uploadproduk');
   }

   public function kirimProduk(Request $request)
   {
       $validated = $request->validate([
           'category' => 'required|string',
           'jenis' => 'required|string',
           'name' => 'required|string|max:255',
           'description' => 'nullable|string',
           'price' => 'required|numeric|min:0',
           'stock' => 'required|integer|min:0',
           'condition' => 'required|string',
           'images' => 'nullable|array',
           'images.*' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
       ]);

       $category = Category::firstOrCreate(
           ['category_nama' => $request->category]
       );

       $jenis = Jenis::firstOrCreate(
           ['jenis_nama' => $request->jenis],
           ['category_id' => $category->id]
       );

       $produk = Product::create([
           'user_id' => auth()->id(),
           'category_id' => $category->id,
           'jenis_id' => $jenis->id,
           'name' => $validated['name'],
           'description' => $validated['description'] ?? '',
           'price' => $validated['price'],
           'stock' => $validated['stock'],
           'condition' => $validated['condition'],
       ]);

       if ($request->hasFile('images')) {
           foreach ($request->file('images') as $image) {
               $imageContent = file_get_contents($image);
               ProductImage::create([
                   'product_id' => $produk->id,
                   'image' => $imageContent,
               ]);
           }
       }

       return redirect()->route('produk.upload', $produk->id)
                       ->with('success', 'Produk berhasil ditambahkan!');
   }
}