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
        'password',
        'nomor',
        'bio',
        'website',
        'profile_picture',
        'google_id',
        'google_token',
        'google_refresh_token',
        'alamat',
        'bio',
        'website',
        'profile_picture',
        'google_id',
        'google_token',
        'google_refresh_token',
        'is_active',
        'email_verified_at'
    ];

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


    public function products()
    {
        return $this->hasMany(Product::class, 'user_id');
    }
}
