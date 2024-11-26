<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use App\Http\Requests\ProfileUpdateRequest;
use App\Models\Product;

class ProfileController extends Controller
{
     // Menampilkan halaman profil pengguna
     public function index()
{
    // Mengambil data pengguna yang sedang login
    $user = auth()->user();

    // Mengambil daftar produk milik pengguna yang sedang login
    $products = Product::where('user_id', $user->id)->with('images')->paginate(6);

    // Mengirim data pengguna dan daftar produk ke view profile
    return view('frontend.profile', compact('user', 'products'));
}

    // Menampilkan halaman edit profil (jika diperlukan)
    public function show()
    {
        return view('auth.profile');
    }

    // Memperbarui data profil pengguna
    public function update(ProfileUpdateRequest $request)
    {
        // Update password jika ada input password baru
        if ($request->password) {
            auth()->user()->update(['password' => Hash::make($request->password)]);
        }

        // Update nama dan email
        auth()->user()->update([
            'name' => $request->name,
            'email' => $request->email,
            'bio' => $request->bio,
            'phone_number' => $request->phone_number,
            'website' => $request->website,
            'alamat' => $request->alamat,
        ]);



        return redirect()->back()->with('success', 'Profil berhasil diperbarui.');
    }
}