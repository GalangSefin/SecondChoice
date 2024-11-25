<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Jenis extends Model
{
    use HasFactory;

    protected $table = 'jenis';

    // Tentukan kolom yang dapat diisi
    protected $fillable = [
        'category_id',
        'jenis_nama'
    ];


     // Relasi dengan model Product (jika ada)
     public function product()
     {
         return $this->hasMany(Product::class, 'jenis_id');  // Relasi satu ke banyak (one-to-many)
     }
 
     public function category()
     {
         return $this->belongsTo(Category::class);
     }
 }
