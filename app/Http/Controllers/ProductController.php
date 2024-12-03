<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;

class ProductController extends Controller
{
    /**
     * Menampilkan daftar produk dengan filter.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\View\View
     */
    public function viewAll(Request $request)
    {
        // Ambil daftar kategori unik dari tabel 'products'
        $categories = Product::select('category')->distinct()->pluck('category');
    
        // Query dasar untuk mengambil produk
        $query = Product::with('images');
    
        // Filter berdasarkan pencarian
        if ($request->has('search') && $request->search != '') {
            $query->where('name', 'LIKE', '%' . $request->search . '%')
                  ->orWhere('description', 'LIKE', '%' . $request->search . '%');
        }
    
        // Filter berdasarkan kategori
        if ($request->has('category') && $request->category != '') {
            $query->where('category', $request->category);
        }
    
        // Filter Harga, Kondisi, dan Sorting (kode sebelumnya tetap sama)
    
        // Mengambil produk berdasarkan query
        $products = $query->paginate(12);
    
        // Dekripsi gambar (jika ada)
        foreach ($products as $product) {
            if ($product->images->isNotEmpty()) {
                foreach ($product->images as $image) {
                    try {
                        $path = 'public/products/' . basename($image->image);
                        if (Storage::exists($path)) {
                            $encryptedContent = Storage::get($path);
                            $decryptedContent = decrypt($encryptedContent);
                            $base64Image = base64_encode($decryptedContent);
                            $image->decoded_image = 'data:image/jpeg;base64,' . $base64Image;
                        }
                    } catch (\Exception $e) {
                        Log::error('Error decrypting image: ' . $e->getMessage());
                        $image->decoded_image = asset('second_choice/images/no-image.png');
                    }
                }
            }
        }
    
        // Kirim data ke view
        return view('frontend.ViewAll', [
            'products' => $products,
            'filters' => $request->all(),
            'categories' => $categories,
            'search' => $request->search,
        ]);
    }

    //
    public function store(Request $request)
    {
        // Validasi data produk
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0',
            'condition' => 'required|string|in:new,used',
            'category' => 'required|string',
            'images' => 'array',
            'images.*' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        // Simpan gambar produk (jika ada)
        $images = [];
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $file) {
                $images[] = $file->store('products', 'public');
            }
        }

        // Simpan produk ke database (opsional)
        // $product = Product::create([...]);

        // Kirim produk ke keranjang
        $cart = Session::get('cart', []);
        $cart[] = [
            'id' => uniqid(),
            'name' => $request->name,
            'description' => $request->description,
            'price' => $request->price,
            'quantity' => 1,
            'image' => count($images) > 0 ? asset('storage/' . $images[0]) : asset('default-image.jpg'),
        ];

        Session::put('cart', $cart);

        return redirect()->route('cart.show')->with('success', 'Produk berhasil ditambahkan ke keranjang.');
    }
}