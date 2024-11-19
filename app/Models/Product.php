<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    // Kolom-kolom yang boleh diisi
    protected $fillable = [
        'category', 'type', 'name', 'description', 'price', 'stock', 'condition'
    ];

    // nyobak
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Relasi dengan model ProductImage (jika ada)
    public function images()
    {
        return $this->hasMany(ProductImage::class);  // Relasi satu ke banyak (one-to-many)
    }
}
