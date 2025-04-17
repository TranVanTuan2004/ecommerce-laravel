<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;

class OrderController extends Controller
{
    // Hiển thị danh sách đơn hàng của người dùng hiện tại
    public function tracking()
    {
        // Lấy danh sách order của user đang đăng nhập
        $orders = Order::with('shipping', 'payments')
            ->where('user_id', auth()->id())
            ->orderByDesc('created_at')
            ->paginate(10); // phân trang

        return view('user.orders.tracking', compact('orders'));
    }

    // Hiển thị chi tiết 1 đơn hàng
    public function show(Order $order)
    {
        // Check quyền user
        if ($order->user_id !== auth()->id()) {
            abort(403);
        }

        // Load thêm thông tin liên quan
        $order->load('orderDetails.product', 'shipping', 'payments');

        return view('user.orders.show', compact('order'));
    }
}
