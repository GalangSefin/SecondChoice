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
        'category_id',
        'jenis_id',
        'user_id',
        'name',
        'description',
        'price', 
        'stock', 
        'condition', 
    ];

    public $timestamps = true;


    // Relasi dengan model ProductImage (jika ada)
    public function images()
    {
        return $this->hasMany(ProductImage::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function jenis()
    {
        return $this->belongsTo(Jenis::class);
    }

    public function seller()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function namacategory()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }

    public function namajenis()
    {
        return $this->belongsTo(Jenis::class, 'jenis_id');
    }
}


