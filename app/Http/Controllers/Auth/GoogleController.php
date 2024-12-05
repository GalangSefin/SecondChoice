<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Laravel\Socialite\Facades\Socialite;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;

class GoogleController extends Controller
{
    public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }

    public function handleCallback()
    {
        try {
            $googleUser = Socialite::driver('google')->user();
            
            $finduser = User::where('email', $googleUser->email)->first();
            
            if($finduser) {
                if($googleUser->avatar) {
                    $this->updateProfilePicture($finduser, $googleUser->avatar);
                }
                
                Auth::login($finduser);
                return redirect()->route('home');
            } else {
                $newUser = User::create([
                    'name' => $googleUser->name,
                    'email' => $googleUser->email,
                    'username' => explode('@', $googleUser->email)[0],
                    'password' => Hash::make('123456dummy'),
                    'is_active' => 1,
                    'email_verified_at' => now()
                ]);

                if($googleUser->avatar) {
                    $this->updateProfilePicture($newUser, $googleUser->avatar);
                }
                
                Auth::login($newUser);
                return redirect()->route('home');
            }
        } catch (\Exception $e) {
            return redirect()->route('home', ['showLogin' => true])
                ->with('error', 'Terjadi kesalahan saat login dengan Google: ' . $e->getMessage());
        }
    }

    private function updateProfilePicture($user, $avatarUrl)
    {
        try {
            $imageContent = file_get_contents($avatarUrl);
            
            $base64Image = base64_encode($imageContent);
            
            $fileName = 'profile_' . $user->id . '_' . time() . '.txt';
            
            Storage::put('public/profile_pictures/' . $fileName, $base64Image);
            
            $user->update([
                'profile_picture' => $fileName
            ]);
            
        } catch (\Exception $e) {
            Log::error('Error saving profile picture: ' . $e->getMessage());
        }
    }
} 