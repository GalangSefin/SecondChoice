<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CheckoutController extends Controller
{
    /**
     * Menampilkan halaman checkout.
     */
    public function index()
    {
        // Data pengguna (ambil dari user yang sedang login)
        $user = auth()->user();

        // Ambil pesanan (contoh: dari sesi atau tabel keranjang)
        $order = session('order') ?? []; // Menggunakan sesi atau ambil dari database

        // Metode pengiriman (contoh: dapat diambil dari database)
        $shipping_methods = [
            ['id' => 1, 'name' => 'JNE', 'cost' => 20000],
            ['id' => 2, 'name' => 'J&T', 'cost' => 18000],
            ['id' => 3, 'name' => 'SiCepat', 'cost' => 22000],
        ];

        return view('frontend.checkout', compact('user', 'order', 'shipping_methods'));
    }

    /**
     * Menangani data pengiriman dan memproses ke halaman pembayaran.
     */
    public function handleShipping(Request $request)
    {
        // Validasi data pengiriman
        $request->validate([
            'shipping_method' => 'required|in:1,2,3', // Validasi metode pengiriman
        ]);

        // Cari metode pengiriman yang dipilih
        $shipping_methods = collect([
            ['id' => 1, 'name' => 'JNE', 'cost' => 20000],
            ['id' => 2, 'name' => 'J&T', 'cost' => 18000],
            ['id' => 3, 'name' => 'SiCepat', 'cost' => 22000],
        ]);

        $shipping_method = $shipping_methods->firstWhere('id', $request->shipping_method);

        // Hitung total biaya
        $order_price = session('order_price') ?? 0; // Ambil dari sesi (atau database)
        $total_cost = $order_price + $shipping_method['cost'];

        // Simpan data ke sesi untuk dilanjutkan ke pembayaran
        session([
            'shipping_cost' => $shipping_method['cost'],
            'total_cost' => $total_cost,
            'shipping_method' => $shipping_method['name'],
        ]);

        return redirect()->route('frontend.checkout');
    }

    /**
     * Menampilkan halaman pembayaran.
     */
    public function paymentPage()
    {
        // Ambil data dari sesi
        $order_price = session('order_price');
        $shipping_cost = session('shipping_cost');
        $total_cost = session('total_cost');
        $shipping_method = session('shipping_method');

        // Cek jika data belum lengkap
        if (!$order_price || !$shipping_cost || !$total_cost || !$shipping_method) {
            return redirect()->route('frontend.checkout')->with('error', 'Harap pilih metode pengiriman terlebih dahulu.');
        }

        return view('frontend.checkout', compact('order_price', 'shipping_cost', 'total_cost', 'shipping_method'));
    }

    /**
     * Menampilkan halaman keranjang belanja.
     */
    public function cartPage()
    {
        // Data keranjang (misalnya diambil dari session atau database)
        $cartItems = session()->get('cart', []); // Contoh pengambilan data dari session

        return view('frontend.checkout', compact('cartItems'));
    }
}
