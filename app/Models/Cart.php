<?php

// app/Models/Cart.php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    protected $fillable = [
        'user_id',
        'seller_id',
        'product_id',
        'quantity',
        'price'
    ];

    // Relasi dengan produk
    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    // Relasi dengan seller (jika ada)
    public function seller()
    {
        return $this->belongsTo(User::class, 'seller_id');
    }
}
