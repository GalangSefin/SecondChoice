<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    /**
     * Display the dashboard with static data.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        // Contoh data statis untuk dashboard
        $userCount = 150; // Jumlah pengguna
        $orderCount = 75; // Jumlah pesanan
        $recentOrders = [
            ['id' => 1, 'order_number' => 'ORD123', 'total_price' => 250.00],
            ['id' => 2, 'order_number' => 'ORD124', 'total_price' => 300.00],
            ['id' => 3, 'order_number' => 'ORD125', 'total_price' => 150.00],
            ['id' => 4, 'order_number' => 'ORD126', 'total_price' => 400.00],
            ['id' => 5, 'order_number' => 'ORD127', 'total_price' => 500.00],
        ];

        // Kirim data ke tampilan dashboard
        return view('frontend.Dashboard', [
            'userCount' => $userCount,
            'orderCount' => $orderCount,
            'recentOrders' => $recentOrders,
        ]);
    }

    /**
     * Show user statistics section of the dashboard with static data.
     *
     * @return \Illuminate\View\View
     */
    public function showUserStats()
    {
        // Contoh data statis pengguna
        $users = [
            ['id' => 1, 'name' => 'John Doe', 'email' => 'john@example.com'],
            ['id' => 2, 'name' => 'Jane Smith', 'email' => 'jane@example.com'],
            ['id' => 3, 'name' => 'Alice Johnson', 'email' => 'alice@example.com'],
        ];

        return view('frontend.jual', ['users' => $users]);
    }

    /**
     * Store a new user with validated static data (simulation).
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function storeUser(Request $request)
    {
        // Validasi input (contoh validasi saja)
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:8|confirmed',
        ]);

        // Simulasi pembuatan pengguna tanpa database
        $newUser = [
            'name' => $validatedData['name'],
            'email' => $validatedData['email'],
            'password' => bcrypt($validatedData['password']),
        ];

        // Redirect ke halaman dashboard dengan pesan sukses
        return redirect()->route('dashboard.index')->with('success', 'Pengguna baru berhasil disimulasikan.');
    }
}
