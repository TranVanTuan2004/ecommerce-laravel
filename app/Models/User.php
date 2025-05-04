<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'phone',
        'avatar',
        'address',
        'role',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    // quan hệ với role
    public function role()
    {
        return $this->belongsTo(Role::class);
    }

    // Quan hệ với bảng Cart
    public function cart()
    {
        return $this->hasOne(Cart::class);
    }


    public function orders()
    {
        return $this->hasMany(Order::class);
    }

    // Quan hệ với bảng Reviews
    public function reviews()
    {
        return $this->hasMany(Review::class);
    }

    // Quan hệ với bảng Wishlists
    public function wishlist()
    {
        return $this->belongsToMany(Product::class, 'wishlists')->withTimestamps();
    }

    // Quan hệ với bảng Payments
    public function payments()
    {
        return $this->hasMany(Payment::class);
    }
}
