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
    // Validasi inputan
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

    // Cek apakah kategori sudah ada, jika belum tambahkan
    $category = Category::firstOrCreate(
        ['category_nama' => $request->category],  // mencari berdasarkan nama
        ['category_nama' => $request->category]   // jika tidak ada, buat dengan nama yang diterima
    );

    // Cek apakah jenis sudah ada, jika belum tambahkan
$jenis = Jenis::firstOrCreate(
    ['jenis_nama' => $request->jenis],  // mencari berdasarkan 'jenis_nama'
    [
        'jenis_nama' => $request->jenis,  // nama jenis
        'category_id' => $category->id   // Menyertakan ID kategori
    ]
);

// Membuat produk baru
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


    // Menangani unggahan gambar
    if ($request->hasFile('images')) {
        foreach ($request->file('images') as $image) {
            // Mengambil konten gambar dalam format binary
            $imageContent = file_get_contents($image);

            // Menyimpan gambar sebagai binary ke tabel product_images
            ProductImage::create([
                'product_id' => $produk->id,
                'image' => $imageContent,  // Menyimpan gambar dalam bentuk binary
            ]);
        }
    }

       // Arahkan ke halaman produk yang baru dibuat, atau halaman sukses
       return redirect()->route('produk.upload', $produk->id)
                        ->with('success', 'Produk berhasil ditambahkan!');
   }
}