<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product; // Pastikan model Product diimport
use Illuminate\Support\Facades\Session;


class CartController extends Controller
{
    public function addToCart(Request $request, $id)
    {
        \Log::info("Adding product with ID: $id");

        // Ambil data produk
        $product = Product::find($id);

        if (!$product) {
            \Log::error("Product not found: ID $id");
            return response()->json(['message' => 'Produk tidak ditemukan.'], 404);
        }

        // Ambil keranjang dari session
        $cart = session()->get('cart', []);

        // Tambahkan atau perbarui produk di keranjang
        if (isset($cart[$id])) {
            $cart[$id]['quantity']++;
        } else {
            $cart[$id] = [
                "name" => $product->name,
                "price" => $product->price,
                "quantity" => 1,
                "image" => $product->images->first()->decoded_image ?? asset('second_choice/images/no-image.png'),
            ];
        }

        // Simpan kembali ke session
        session()->put('cart', $cart);

        \Log::info("Cart updated:", $cart);

        // Kirim respons sukses ke JavaScript
        return response()->json(['message' => 'Produk berhasil ditambahkan ke keranjang.']);
    }

    public function viewCart()
    {
        // Mengambil keranjang dari session
        $cart = session()->get('cart', []);

        // Mengirim data keranjang ke view
        return view('frontend.cart', compact('cart'));
    }
}
