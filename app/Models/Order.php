<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    /** @use HasFactory<\Database\Factories\OrderFactory> */
    use HasFactory;

    protected $fillable = [
        'user_id',
        'total_price',
        'payment_method',
        'status'
    ];

    // 1 order thuộc về 1 user
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // 1 order có nhiều chi tiết sản phẩm
    public function orderDetails()
    {
        return $this->hasMany(OrderDetail::class);
    }

    // 1 order có nhiều sản phẩm (qua order_details)
    public function products()
    {
        return $this->belongsToMany(Product::class, 'order_details')
            ->withPivot('quantity', 'price', 'created_at');
    }


    // 1 order có thông tin giao hàng
    public function shipping()
    {
        return $this->hasOne(Shipping::class);
    }

    // 1 order có thể có nhiều payment
    public function payments()
    {
        return $this->hasMany(Payment::class);
    }
}
