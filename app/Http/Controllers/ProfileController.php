<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Product;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        // Ambil produk user yang sedang login
        $products = Product::where('user_id', $user->id)
                         ->orderBy('created_at', 'desc')
                         ->paginate(10); // 10 produk per halaman
        
        // Jika foto profil ada, pastikan file ada di storage
        if ($user->profile_picture && Storage::exists('public/profile_pictures/' . $user->profile_picture)) {
            return view('frontend.profile', compact('user', 'products'));
        } else {
            // Jika file tidak ditemukan, reset profile_picture ke null
            $user->profile_picture = null;
            // $user->save();
            return view('frontend.profile', compact('user', 'products'));
        }
    }

    public function show($id)
    {
        $user = User::findOrFail($id);
        // Ambil produk user yang ditampilkan
        $products = Product::where('user_id', $user->id)
                         ->orderBy('created_at', 'desc')
                         ->paginate(10);
        
        // Jika foto profil ada, pastikan file ada di storage
        if ($user->profile_picture && Storage::exists('public/profile_pictures/' . $user->profile_picture)) {
            return view('frontend.profile', compact('user', 'products'));
        } else {
            // Jika file tidak ditemukan, reset profile_picture ke null
            if ($user->profile_picture) {
                $user->profile_picture = null;
                $user->save();
            }
            return view('frontend.profile', compact('user', 'products'));
        }
    }

    // Method lain jika ada...
}