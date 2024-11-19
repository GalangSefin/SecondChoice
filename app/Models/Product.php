<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    // Menentukan nama tabel jika tidak sesuai dengan konvensi
    protected $table = 'products';

    // Tentukan kolom yang bisa diisi secara massal
    protected $fillable = [
        'name', 
        'price', 
        'category', 
        'stock', 
        'condition', 
        'image'
    ];

    // Relasi dengan model ProductImage (jika ada)
    public function images()
    {
        return $this->hasMany(ProductImage::class);  // Relasi satu ke banyak (one-to-many)
    }

    public function user()
    {
    return $this->belongsTo(User::class);
    }
}
