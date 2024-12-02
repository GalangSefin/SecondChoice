<?php

// app/Http/Controllers/CartController.php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Cart;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    public function addToCart(Product $product)
    {
        // Cek apakah produk sudah ada di keranjang
        $cart = Cart::where('user_id', Auth::id())
                    ->where('product_id', $product->id)
                    ->first();

        if ($cart) {
            // Jika produk sudah ada, update quantity
            $cart->quantity += 1;
            $cart->save();
        } else {
            // Jika produk belum ada, tambahkan produk ke keranjang
            Cart::create([
                'user_id' => Auth::id(),
                'product_id' => $product->id,
                'seller_id' => $product->seller_id, // Asumsi seller_id ada di tabel produk
                'quantity' => 1,
                'price' => $product->price,
            ]);
        }

        return redirect()->route('cart.show');
    }

    public function showCart()
    {
        // Ambil keranjang belanja pengguna
        $cartItems = Cart::where('user_id', Auth::id())->get();

        return view('cart.show', compact('cartItems'));
    }

    public function removeFromCart($cartId)
    {
        // Hapus item dari keranjang berdasarkan ID
        $cartItem = Cart::findOrFail($cartId);
        $cartItem->delete();

        return redirect()->route('cart.show');
    }
}
