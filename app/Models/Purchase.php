<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Purchase extends Model
{
    use HasFactory;

    // Nama tabel di database (opsional jika tabel bernama 'purchases')
    protected $table = 'purchases';

    // Kolom-kolom yang diizinkan untuk diisi secara massal
    protected $fillable = [
        'product_name',
        'size',
        'color',
        'price',
        'total_price',
        'estimated_delivery',
        'status',
        'image',
    ];

    // Tipe data yang perlu di-cast
    protected $casts = [
        'price' => 'decimal:2',
        'total_price' => 'decimal:2',
        'estimated_delivery' => 'datetime',
    ];

    /**
     * Relasi ke tabel users.
     * Setiap pembelian terkait dengan satu pengguna (user).
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
