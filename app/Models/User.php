<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'username',
        'password',
        'is_active',
        'email_verified_at',
        'bio',
        'phone_number',
        'website',
        'alamat',
        'profile_picture'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'is_active' => 'boolean',
    ];

    public function roles() {
        return $this->belongsToMany(Role::class, 'role_user');
    }

    public function notifiable() {
        return $this->belongsToMany(User::class, 'user_id');
    }

    public function getIsActiveAttribute($value)
    {
        return $value ?? $this->hasVerifiedEmail();
    }

    public function markEmailAsVerified()
    {
        $this->forceFill([
            'email_verified_at' => $this->freshTimestamp(),
            'is_active' => true,
        ])->save();

        return true;
    }

    public function getEmailForVerification()
    {
        return $this->email;
    }

    public function keranjang()
    {
        return $this->hasMany(Keranjang::class, 'user_id');
    }

    public function sellerKeranjang()
    {
        return $this->hasMany(Keranjang::class, 'seller_id');
    }
    public function reviews()
{
    return $this->hasMany(Review::class);
}

}
