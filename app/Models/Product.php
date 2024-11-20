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
        'user_id',
        'type',
        'description',
        'id', 
        'category', 
        'type', 
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
        return $this->hasMany(ProductImage::class, 'product_id');  // Relasi satu ke banyak (one-to-many)
    }
}
