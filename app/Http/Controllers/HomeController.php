<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product; // pastikan ada model Product
use Illuminate\Support\Facades\Log;
use Illuminate\Foundation\Auth\EmailVerificationRequest;


class HomeController extends Controller
{
    /**
     * Menampilkan daftar produk.
     *
     * @return \Illuminate\View\View
     */
    public function home()
    {
        if (auth()->check() && !auth()->user()->email_verified_at) {
            return redirect()->route('verification.notice');
        }

        // Mengambil 12 produk terbaru dari database
        $products = Product::with('images')->latest()->take(12)->get();

        // Mengirimkan data ke view
        return view('frontend.home', compact('products'));
       // Mengambil 12 produk terbaru dari database
       $products = Product::with('images')->latest()->take(12)->get();

       // Debugging
        Log::info('Products fetched: ', ['products' => $products]);

        // Mengirimkan data ke view
        return view('frontend.home', compact('products'));
    }
}
