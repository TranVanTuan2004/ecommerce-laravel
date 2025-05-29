<?php

namespace App\Models;

use App\Http\Controllers\Cart\CartController;
use App\Http\Controllers\Voucher\VoucherController;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Voucher;

class Order extends Model
{
    use HasFactory;
    protected $table = 'orders';

    protected $fillable = [
        'user_id',
        'shipping_address',
        'status',
        'ordered_at',
        'payment_method',
        'price',
        'voucher_code',
        'discount_price',
    ];


    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function orderProducts()
    {
        return $this->hasMany(OrderProduct::class);
    }

    public function products()
    {
        return $this->belongsToMany(Product::class, 'order_products')
            ->withPivot('quantity', 'price')
            ->withTimestamps();
    }

    public function shippingAddress()
    {
        return $this->hasOne(Shipping::class);
    }

    public function payments()
    {
        return $this->hasMany(Payment::class);
    }

    public function voucher()
    {
        return $this->belongsTo(Coupons::class);
    }


    // Trạng thái dạng đẹp cho giao diện
    public function getStatusLabelAttribute()
    {
        return match ($this->status) {
            'pending' => 'Chờ xác nhận',
            'confirmed' => 'Đã xác nhận',
            'shipping' => 'Đang vận chuyển',
            'delivering' => 'Chờ giao hàng',
            'delivered' => 'Đã giao',
            'cancelled' => 'Đã hủy',
            default => ucfirst($this->status),
        };
    }

    // Trạng thái dùng cho thanh trạng thái (giữ nguyên status hoặc có thể map)
    public function getStatusForBarAttribute()
    {
        return match ($this->status) {
            'pending' => 'ordered',
            'shipping' => 'shipping',
            'delivering' => 'delivering',
            'delivered' => 'delivered',
            default => 'ordered',
        };
    }

    // Alias cho orderProducts, dùng trong view là $order->orderItems
    public function getOrderItemsAttribute()
    {
        return $this->orderProducts;
    }


    // Lấy ra sản phẩm chính để hiển thị (ví dụ: sản phẩm đầu tiên của đơn)
    public function getProductNameAttribute()
    {
        // Lấy tên product đầu tiên của đơn (nếu có)
        $product = $this->products()->first();
        return $product ? $product->name : null;
    }

    // Lấy ảnh sản phẩm đầu tiên (cần chắc chắn Product model có trường image hoặc tương tự)
    public function getProductImageAttribute()
    {
        $product = $this->products()->first();
        return $product ? $product->image_url : null;
    }

    // Lấy phân loại sản phẩm đầu tiên (ví dụ trường variant hoặc options)
    public function getProductVariantAttribute()
    {
        // Nếu bạn lưu phân loại trong bảng order_products pivot hoặc trong products
        // ví dụ: pivot có 'variant' hoặc 'options' (bạn sửa lại theo DB)
        $orderProduct = $this->orderProducts()->first();
        return $orderProduct ? $orderProduct->variant ?? null : null;
    }

    // Lấy số lượng sản phẩm đầu tiên
    public function getQuantityAttribute()
    {
        $orderProduct = $this->orderProducts()->first();
        return $orderProduct ? $orderProduct->quantity : 1;
    }

    // Tính tổng tiền của đơn (hoặc bạn đã lưu trường total_price thì không cần)
    public function getTotalPriceAttribute()
    {
        // Nếu bạn không có trường total_price trong bảng orders,
        // tính tổng = tổng quantity * price các order_products
        return $this->orderProducts->sum(function ($item) {
            return $item->quantity * $item->price;
        });
    }

    public function getHasDiscountAttribute()
    {
        return $this->discount_price > 0 && $this->voucher;
    }

    public function getOrderStatus($id)
    {
        $order = Order::findOrFail($id);
        return response()->json([
            'status' => $order->status_label //Lấy qua assessor
        ]);
    }
}
