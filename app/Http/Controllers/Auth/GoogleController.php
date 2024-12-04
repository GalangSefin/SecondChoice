<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Laravel\Socialite\Facades\Socialite;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;

class GoogleController extends Controller
{
    public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }

    public function handleCallback()
    {
        try {
            $user = Socialite::driver('google')->user();
            
            $finduser = User::where('email', $user->email)->first();
            
            if($finduser) {
                Auth::login($finduser);
                return redirect()->route('home');
            } else {
                $newUser = User::create([
                    'name' => $user->name,
                    'email' => $user->email,
                    'username' => explode('@', $user->email)[0],
                    'password' => Hash::make('123456dummy'),
                    'is_active' => 1,
                    'email_verified_at' => now()
                ]);
                
                Auth::login($newUser);
                return redirect()->route('home');
            }
        } catch (\Exception $e) {
            return redirect()->route('login')->with('error', 'Terjadi kesalahan saat login dengan Google');
        }
    }
} 