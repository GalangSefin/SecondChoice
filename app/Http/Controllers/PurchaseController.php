<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Purchase; // Model untuk pesanan
use Illuminate\Support\Facades\Auth;

class PurchaseController extends Controller
{
    /**
     * Menampilkan halaman purchases.
     */
    public function index()
    {
        // Mengambil data pesanan berdasarkan user yang sedang login
        $purchases = Purchase::where('user_id', auth()->id())->get();

        // Mengirimkan data pesanan ke view
        return view('frontend.purchases', compact('purchases'));
    }

    /**
     * Mengubah status pesanan menjadi "Pesanan Diterima".
     */
    public function confirmReceived($id)
    {
        // Mencari pesanan berdasarkan ID
        $purchase = Purchase::find($id);

        // Memastikan pesanan ditemukan dan milik user yang login
        if ($purchase && $purchase->user_id === Auth::id()) {
            $purchase->status = 'Diterima';
            $purchase->save();

            return redirect()->back()->with('success', 'Pesanan berhasil dikonfirmasi diterima.');
        }

        return redirect()->back()->with('error', 'Pesanan tidak ditemukan.');
    }
}
