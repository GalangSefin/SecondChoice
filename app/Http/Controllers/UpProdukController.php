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
   // Menampilkan form unggah produk
   public function tampilForm()
   {
       return view('frontend.uploadproduk'); // Nama view yang sudah Anda buat
   }

   // Menangani pengiriman produk
   public function kirimProduk(Request $request)
   {
       // Validasi request
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

       // Simpan data produk
       $product = Product::create([
           'category' => $request->category,
           'jenis' => $request->jenis,
           'user_id' => auth()->id(),
           'name' => $request->name,
           'description' => $request->description,
           'price' => $request->price,
           'stock' => $request->stock,
           'condition' => $request->condition,
       ]);

       // Proses upload gambar
       if ($request->hasFile('images')) {
           foreach ($request->file('images') as $image) {
               // Baca file sebagai binary
               $imageContent = file_get_contents($image->getRealPath());
               
               // Enkripsi konten gambar (opsional)
               $encryptedContent = encrypt($imageContent);
               
               // Generate nama file yang unik
               $filename = time() . '_' . uniqid() . '.bin';
               
               // Simpan file terenkripsi
               Storage::put('public/products/' . $filename, $encryptedContent);

               // Simpan informasi gambar ke database
               ProductImage::create([
                   'product_id' => $product->id,
                   'image' => 'storage/products/' . $filename
               ]);
           }
       }

       return redirect()->back()->with('success', 'Produk berhasil ditambahkan!');
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