<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    /** @use HasFactory<\Database\Factories\ProductFactory> */
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'price',
        'category_id',
        'brand_id',
        'slide_id',
        'image'
    ];
    // 1 sản phẩm thuộc về 1 brand
    public function brand()
    {
        return $this->belongsTo(Brand::class, 'brand_id');
    }

    // 1 sản phẩm thuộc về 1 danh mục
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    // 1 sản phẩm có nhiều đánh giá
    public function reviews()
    {
        return $this->belongsTo(Category::class);
    }

    public function slides()
    {
        return $this->belongsTo(Category::class);
    }

    public function cartItems()
    {
        return $this->hasMany(CartItem::class);
    }

    // 1 sản phẩm nằm trong nhiều đơn hàng
    public function orders()
    {
        return $this->belongsToMany(Order::class, 'order_products')
            ->withPivot('quantity', 'price')
            ->withTimestamps();
    }

    // 1 sản phẩm có thể được thêm vào nhiều wishlist
    public function wishedByUsers()
    {
        return $this->belongsToMany(User::class, 'wishlists')->withTimestamps();
    }
}
