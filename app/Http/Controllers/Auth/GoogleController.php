<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Laravel\Socialite\Facades\Socialite;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class GoogleController extends Controller
{
    public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }

    public function handleCallback()
    {
        try {
            $google_user = Socialite::driver('google')->user();
            
            $user = User::updateOrCreate(
                ['email' => $google_user->email],
                [
                    'name' => $google_user->name,
                    'username' => explode('@', $google_user->email)[0],
                    'email_verified_at' => now(),
                    'password' => bcrypt(Str::random(16))
                ]
            );
            
            Auth::login($user);
            return redirect()->route('home')->with('success', 'Berhasil login dengan Google');
            
        } catch (\Exception $e) {
            return redirect()->route('home')->with('error', 'Gagal login dengan Google');
        }
    }
} 