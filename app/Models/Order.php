<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'total_price', 'status'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Quan hệ với bảng order_products
    public function orderProducts()
    {
        return $this->hasMany(OrderProduct::class);
    }

    // Quan hệ với Shipping
    public function shipping()
    {
        return $this->hasOne(Shipping::class);
    }

    // Quan hệ với bảng trung gian order_products và Product
    public function products()
    {
        return $this->belongsToMany(Product::class, 'order_products')
            ->withPivot('quantity', 'price')
            ->withTimestamps();
    }

    // Quan hệ với Payment
    public function payments()
    {
        return $this->hasMany(Payment::class);
    }
}
