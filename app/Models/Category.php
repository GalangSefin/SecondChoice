<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $table = 'category';

    // Tentukan kolom yang dapat diisi
    protected $fillable = [
        'name',
        'image',
    ];



 // Relasi dengan model Jenis (jika ada)
 public function jenis()
 {
     return $this->hasMany(Jenis::class, 'category_id');  // Relasi satu ke banyak (one-to-many)
 }
}
