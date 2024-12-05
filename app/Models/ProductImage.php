<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class ProductImage extends Model
{
    protected $fillable = ['product_id', 'image'];

    public function getImageUrlAttribute()
    {
        if ($this->image && Storage::exists('public/products/' . $this->image)) {
            $path = Storage::path('public/products/' . $this->image);
            $type = pathinfo($path, PATHINFO_EXTENSION);
            $data = file_get_contents($path);
            return 'data:image/' . $type . ';base64,' . base64_encode($data);
        }
        
        // Return default image jika gambar tidak ditemukan
        return asset('images/default-product.jpg');
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
