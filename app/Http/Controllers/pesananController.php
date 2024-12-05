<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class pesananController extends Controller
{
    /**
     * Menampilkan halaman pesanan pengguna.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        // Mengecek apakah pengguna sudah login
        if (Auth::check()) {
            // Di sini, Anda bisa mengambil data pesanan dari database jika diperlukan
            // $pesanan = Pesanan::where('user_id', Auth::id())->get();

            return view('frontend.pesanan');  // Mengembalikan view pesanan.blade.php
        } else {
            return redirect()->route('login')->with('error', 'Anda harus login terlebih dahulu.');
        }
    }
}
