<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use Illuminate\Support\Facades\Storage;
use App\Models\ProductImage;
use App\Models\Category;
use App\Models\Jenis;
use Illuminate\Support\Facades\Log;

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
       $request->validate([
           'category' => 'required',
           'jenis' => 'required',
           'name' => 'required',
           'description' => 'required',
           'price' => 'required|numeric',
           'stock' => 'required|integer',
           'condition' => 'required',
           'images.*' => 'image|mimes:jpeg,png,jpg,gif|max:2048'
       ]);

       // Buat produk baru
       $product = Product::create([
           'user_id' => auth()->id(),
           'category' => $request->category,
           'jenis' => $request->jenis,
           'name' => $request->name,
           'description' => $request->description,
           'price' => $request->price,
           'stock' => $request->stock,
           'condition' => $request->condition
       ]);

       // Handle multiple images
       if ($request->hasFile('images')) {
           foreach ($request->file('images') as $index => $image) {
               try {
                   // Generate nama unik untuk setiap file dengan menambahkan index
                   $imageName = time() . '_' . $index . '_' . $image->getClientOriginalName();
                   
                   // Baca konten file
                   $imageContent = file_get_contents($image->getRealPath());
                   
                   // Enkripsi konten
                   $encryptedContent = encrypt($imageContent);
                   
                   // Simpan file terenkripsi dengan nama unik
                   Storage::put('public/products/' . $imageName, $encryptedContent);

                   // Simpan informasi gambar ke database
                   $product->images()->create([
                       'image' => $imageName,
                   ]);

               } catch (\Exception $e) {
                Log::error('Error uploading image: ' . $e->getMessage());
                   continue;
               }
           }
       }

       return redirect()->route('home')->with('success', 'Produk berhasil ditambahkan!');
   }

   // Tambahkan method untuk menampilkan gambar
   public function showImage($filename)
   {
       try {
           $path = 'public/products/' . $filename;
           
           if (!Storage::exists($path)) {
               return response()->file(public_path('second_choice/images/no-image.png'));
           }

           // Ambil konten terenkripsi
           $encryptedContent = Storage::get($path);
           
           // Dekripsi konten
           $imageContent = decrypt($encryptedContent);
           
           // Deteksi mime type
           $finfo = new \finfo(FILEINFO_MIME_TYPE);
           $mimeType = $finfo->buffer($imageContent);
           
           return response($imageContent)
               ->header('Content-Type', $mimeType)
               ->header('Cache-Control', 'public, max-age=3600');
               
       } catch (\Exception $e) {
           \Illuminate\Support\Facades\Log::error('Error showing image: ' . $e->getMessage());
           return response()->file(public_path('second_choice/images/no-image.png'));
       }
   }
}