<?php

namespace App\Http\Controllers\Order;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    public function index()
    {
        // Cập nhật lại tên quan hệ để đúng với bảng trung gian order_products
        $orders = Order::with(['orderProducts.product', 'shipping', 'products', 'payments'])
            ->where('user_id', Auth::id())
            ->latest()
            ->paginate(10);
        return view('orders.index', compact('orders'));
    }

    public function history()
    {
        // Cập nhật lại tên quan hệ để đúng với bảng trung gian order_products
        $orders = Order::with(['orderProducts.product', 'products'])
            ->where('user_id', Auth::id())
            ->where('status', 'delivered')
            ->latest()
            ->paginate(10);
        return view('orders.history', compact('orders'));
    }

    public function cancel($id)
    {
        $order = Order::where('id', $id)->where('user_id', Auth::id())->firstOrFail();
        if (in_array($order->status, ['pending', 'processing'])) {
            $order->update(['status' => 'cancelled']);
        }
        return redirect()->route('orders.index')->with('success', 'Đơn hàng đã được hủy.');
    }
}
