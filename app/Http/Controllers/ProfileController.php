<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use App\Http\Requests\ProfileUpdateRequest;

class ProfileController extends Controller
{
    // Menampilkan halaman profil pengguna
    public function index()
    {
        $user = auth()->user();
        return view('frontend.profile', compact('user'));
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
        ]);

        return redirect()->back()->with('success', 'Profil berhasil diperbarui.');
    }
}