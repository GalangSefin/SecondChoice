<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class KategoriController extends Controller
{
    /**
     * Menampilkan halaman kategori.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        return view('frontent'); // Pastikan file view sesuai dengan struktur proyek Anda
    }
}
