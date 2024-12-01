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
        // Ambil data user yang sedang login
        $user = auth()->user();
        
        // Pass data user ke view
        return view('frontend.editprofile', compact('user'));
    }

    /**
     * Mengupdate profil pengguna.
     */
    public function updateProfile(Request $request)
    {
        try {
            $request->validate([
                'name' => 'required|string|max:255',
                'bio' => 'nullable|string',
                'phone_number' => 'nullable|string|max:20',
                'website' => 'nullable|string|max:255',
                'alamat' => 'nullable|string|max:255',
                'profile_picture' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            ]);

            $user = User::find(auth()->id());

            if ($request->hasFile('profile_picture')) {
                // Hapus foto lama jika ada
                if ($user->profile_picture) {
                    Storage::delete('public/profile_pictures/' . $user->profile_picture);
                }

                // Proses foto baru
                $image = $request->file('profile_picture');
                $imageContent = file_get_contents($image->getRealPath());
                $base64Image = base64_encode($imageContent);
                
                $fileName = 'profile_' . $user->id . '_' . time() . '.txt';
                Storage::put('public/profile_pictures/' . $fileName, $base64Image);
                
                $user->profile_picture = $fileName;
            }

            // Update data lainnya
            $user->update([
                'name' => $request->name,
                'bio' => $request->bio,
                'phone_number' => $request->phone_number,
                'website' => $request->website,
                'alamat' => $request->alamat,
            ]);

            return redirect()->back()->with('success', 'Profil berhasil diperbarui');
        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Terjadi kesalahan: ' . $e->getMessage())
                ->withInput();
        }
    }

    public function updateProfilePicture(Request $request)
    {
        try {
            $request->validate([
                'profile_picture' => 'required|image|mimes:jpeg,png,jpg|max:2048'
            ]);

            $user = User::find(auth()->id());

            if (!$user) {
                return response()->json(['success' => false, 'message' => 'User tidak ditemukan']);
            }

            // Hapus foto lama jika ada
            if ($user->profile_picture) {
                Storage::delete('public/profile_pictures/' . $user->profile_picture);
            }

            // Proses foto baru
            $image = $request->file('profile_picture');
            $imageContent = file_get_contents($image->getRealPath());
            $base64Image = base64_encode($imageContent);
            
            // Simpan base64 ke file
            $fileName = 'profile_' . $user->id . '_' . time() . '.txt';
            Storage::put('public/profile_pictures/' . $fileName, $base64Image);
            
            // Update nama file di database
            $user->profile_picture = $fileName;
            $user->save();

            return response()->json(['success' => true]);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => $e->getMessage()]);
        }
    }

    public function deleteProfilePicture()
    {
        try {
            $user = User::find(auth()->id());

            if (!$user) {
                return response()->json(['success' => false, 'message' => 'User tidak ditemukan']);
            }
            
            // Hapus file foto dari storage
            if ($user->profile_picture) {
                Storage::delete('public/profile_pictures/' . $user->profile_picture);
                $user->profile_picture = null;
                $user->save();
            }

            return response()->json(['success' => true]);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => $e->getMessage()]);
        }
    }
}
