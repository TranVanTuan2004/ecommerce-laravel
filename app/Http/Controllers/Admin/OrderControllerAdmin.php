<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;

class OrderControllerAdmin extends Controller
{
    public function index(Request $request)
    {
        $query = Order::with('user')->orderBy('created_at', 'desc');

        if ($request->has('status') && $request->status != '') {
            $query->where('status', $request->status);
        }

        $orders = $query->paginate(10);
        return view('admin.pages.order.index', compact('orders'));
    }

    public function show($id)
    {
        $order = Order::with(['user', 'products', 'orderProducts.product'])->findOrFail($id);

        return view('admin.pages.order.show', compact('order'));
    }

    public function updateStatus(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:pending,confirmed,shipping,delivering,delivered,cancelled',
        ]);

        $order = Order::findOrFail($id);
        $order->status = $request->status;
        $order->save();

        return redirect()->back()->with('success', 'Cập nhật trạng thái thành công.');
    }

    public function cancel($id)
    {
        $order = Order::findOrFail($id);

        // Kiểm tra nếu đơn chưa bị huỷ hoặc giao rồi thì mới huỷ
        if (!in_array($order->status, ['cancelled', 'delivered'])) {
            $order->status = 'cancelled';
            $order->save();
        }

        return redirect()->back()->with('success', 'Đơn hàng đã được hủy.');
    }

    // Hiển thị form sửa đơn hàng (nếu cần)
    public function edit($id)
    {
        $order = Order::with('orderProducts.product')->findOrFail($id);
        return view('admin.pages.order.edit', compact('order'));
    }

    // Xóa đơn hàng
    public function destroy($id)
    {
        $order = Order::findOrFail($id);
        $order->delete();

        return redirect()->route('order.index')->with('success', 'Đơn hàng đã được xóa.');
    }

    public function update(Request $request, $id)
    {
        $order = Order::findOrFail($id);

        // Validate dữ liệu nếu cần
        $request->validate([
            'shipping_address' => 'required|string|max:255',
            'total_price' => 'required|numeric|min:0',
            'discount_amount' => 'nullable|numeric|min:0',
            'status' => 'required|string',
            'payment_method' => 'required|string',
        ]);

        // Gán các giá trị mới từ form
        $order->shipping_address = $request->input('shipping_address');
        $order->price = $request->input('total_price');
        $order->discount_price = $request->input('discount_amount');
        $order->status = $request->input('status');
        $order->payment_method = $request->input('payment_method');

        $order->save();

        return redirect()->route('order.index')->with('success', 'Cập nhật đơn hàng thành công!');
    }
}
