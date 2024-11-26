<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AddressController extends Controller
{
    public function edit()
    {
        return view('ubah-alamat');
    }

    public function update(Request $request)
    {
        $validated = $request->validate([
            'recipient_name' => 'required|string|max:255',
            'phone_number' => 'required|numeric',
            'full_address' => 'required|string',
        ]);

        // Simpan data (contoh dengan User model)
        $user = auth()->user();
        $user->update($validated);

        return redirect()->route('address.edit')->with('success', 'Alamat berhasil diperbarui!');
    }
}
