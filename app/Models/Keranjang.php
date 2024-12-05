<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Keranjang extends Model
{
    use HasFactory;

    protected $table = 'keranjang'; // Hanya jika tabel bernama 'keranjang'
    protected $fillable = [
        'user_id',
        'seller_id',
        'product_id',
        'quantity',
        'price',
    ];

    // Relasi ke produk
    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id')->with('images');
    }

    // Relasi ke seller melalui Product
    public function seller()
    {
        return $this->belongsTo(User::class, 'seller_id');
    }

    // Relasi ke pengguna pemilik keranjang
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}