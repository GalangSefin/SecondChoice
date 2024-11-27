<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
   // Middleware to ensure only authenticated users can access the dashboard
   public function __construct()
   {
       $this->middleware('auth');
   }

   // Method to display the dashboard page
   public function index()
   {
       // Contoh data yang bisa ditampilkan pada dashboard
       $totalEarnings = 0; // Replace with actual calculation or database query
       $productsSold = 0; // Replace with actual calculation or database query
       $orders = []; // Replace with actual data from database

       return view('frontend.Dashboard', [
           'totalEarnings' => $totalEarnings,
           'productsSold' => $productsSold,
           'orders' => $orders,
           'user' => Auth::user()
       ]);
   }

    public function dashboard()
    {
        $products = Product::with('images')->get(); // Ambil semua produk dengan gambar
        return view('frontend.dashboard');
    }

}