<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Models\User;

class SettingController extends Controller
{
    /**
     * Menampilkan halaman edit profile.
     */
    public function editProfile()
    {
        return view('frontend.editprofile');
    }

    /**
     * Mengupdate profil pengguna.
     */
    public function updateProfile(Request $request)
    {
        // Validasi input
        $request->validate([
            'name' => 'required|string|max:255',
            'bio' => 'nullable|string|max:500',
            'website' => 'nullable|url|max:255',
            'profile_picture' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        // Ambil data pengguna yang sedang login
        $user = Auth::user();

        // Cek apakah ada file gambar yang di-upload
        if ($request->hasFile('profile_picture')) {
            // Hapus foto profil lama jika ada
            if ($user->profile_picture) {
                Storage::delete($user->profile_picture);
            }

            // Simpan foto profil baru
            $filePath = $request->file('profile_picture')->store('profile_pictures', 'public');
            $user->profile_picture = $filePath;
        }

        // Update data profil pengguna
        $user->name = $request->input('name');
        $user->bio = $request->input('bio');
        $user->phone_number = $request->input('phone_number');
        $user->website = $request->input('website');
        $user->alamat = $request->input('alamat');
        $user->save();

        // Redirect dengan pesan sukses
        return redirect()->route('settings')->with('success', 'Profil berhasil diperbarui.');
    }
}
