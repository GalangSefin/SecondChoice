<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
class ProductImage extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'product_id',
        'image',
    ];

    // Accessor untuk mendapatkan full URL gambar
    public function getImageUrlAttribute()
    {
        return asset($this->image);
    }

    // Relasi balik ke produk
    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
