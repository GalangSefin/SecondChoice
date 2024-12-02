<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
// use App\Notifications\WelcomeNotification; // Import notification class 
use App\Models\User;

class NotificationController extends Controller
{

    // public function sendNotification()
    // {
    //     $message = "Anda memiliki notifikasi baru!"; // Contoh data
    //     $hasNotification = true; // Contoh logika, ganti sesuai kebutuhan
    
    //     if ($hasNotification) {
    //         return response()->json([
    //             'html' => view('partials.notifications', compact('message'))->render()
    //         ]);
    //     }
    //     return '<p>Tidak ada notifikasi baru</p>';
    // }
    
    public function sendNotification()
    {
    // Periksa apakah ada pengguna yang login
    if (auth()->check()) {
        $user = auth()->user(); // Dapatkan pengguna yang sedang login
        $message = "Selamat datang, " . $user->name . "!"; // Pesan berdasarkan nama pengguna
    } else {
        $message = "Anda belum login."; // Pesan jika tidak ada pengguna login
    }

    return response()->json([
        'html' => view('partials.notifications', compact('message'))->render()
    ]);
    }


}