<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;
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

    // Proses dekripsi gambar untuk setiap produk
    foreach ($products as $product) {
        if ($product->images->isNotEmpty()) {
            foreach ($product->images as $image) {
                try {
                    $path = 'public/products/' . basename($image->image);
                    if (Storage::exists($path)) {
                        $encryptedContent = Storage::get($path);
                        $decryptedContent = decrypt($encryptedContent);
                        $base64Image = base64_encode($decryptedContent);
                        $image->decoded_image = 'data:image/jpeg;base64,' . $base64Image;
                    } else {
                        Log::warning('Image file not found: ' . $path);
                        $image->decoded_image = asset('second_choice/images/no-image.png');
                    }
                } catch (\Exception $e) {
                    Log::error('Error decrypting image: ' . $e->getMessage());
                    $image->decoded_image = asset('second_choice/images/no-image.png');
                }
            }
        }
    }

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
    ]);

    return redirect()->back()->with('success', 'Profil berhasil diperbarui.');
}
}