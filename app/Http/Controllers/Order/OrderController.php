<?php

namespace App\Http\Controllers\Order;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\Coupons;
use App\Models\Cart;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $status = $request->query('status');
        $query = Order::with(['voucher', 'orderProducts.product'])->where('user_id', Auth::id());

        if ($status && $status != 'all') {
            $query->where('status', $status);
        }

        $orders = $query->orderBy('created_at', 'desc')->paginate(10);
        return view('client.pages.orders.index', compact('orders'));
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */

    public function store(Request $request)
    {
        // Lấy giỏ hàng hiện tại theo user
        $cart = Cart::with('items.product')->where('user_id', Auth::id())->first();

        if (!$cart || $cart->items->isEmpty()) {
            return redirect()->back()->with('error', 'Giỏ hàng đang trống.');
        }

        // Tính tổng tiền
        $subtotal = $cart->items->sum(function ($item) {
            return $item->product->price * $item->quantity;
        });

        $voucherCode = $request->input('voucher_code');
        $discount = 0;

        if ($voucherCode) {
            $voucher = Coupons::where('code', $voucherCode)
                ->where('expiration_date', '>=', now())
                ->first();

            if ($voucher && $subtotal >= $voucher->min_order_value) {
                $discount = $subtotal * ($voucher->discount / 100);
            }
        }

        $finalTotal = $subtotal - $discount;

        $order = Order::create([
            'user_id' => Auth::id(),
            'voucher_code' => $voucherCode,
            'discount_price' => $discount,
            'price' => $finalTotal,
            'payment_method' => $request->input('payment_method'),
            'status' => 'pending',
            'ordered_at' => now(),
        ]);

        // Gắn sản phẩm từ giỏ hàng vào đơn hàng
        foreach ($cart->items as $item) {
            $order->orderProducts()->create([
                'product_id' => $item->product_id,
                'quantity' => $item->quantity,
                'price' => $item->product->price,
            ]);
        }

        // Xóa giỏ hàng sau khi đặt hàng
        $cart->items()->delete();

        return redirect()->route('orders.show', $order->id);
    }


    /**
     * Display the specified resource.
     */
    public function show(Order $order)
    {
        //$this->authorize('view', $order); // (nếu muốn bảo vệ)
        $order->load('orderProducts.product');
        return view('client.pages.orders.show', compact('order'));
    }

    public function cancel(Order $order)
    {
        // Kiểm tra người dùng có quyền hủy không
        if ($order->user_id !== Auth::id()) {
            abort(403, 'Bạn không có quyền hủy đơn hàng này.');
        }

        // Chỉ cho hủy nếu chưa giao
        if (in_array($order->status, ['delivered', 'cancelled'])) {
            return back()->with('error', 'Không thể hủy đơn hàng này.');
        }

        // Cập nhật trạng thái
        $order->status = 'cancelled';
        $order->save();

        return back()->with('success', 'Đơn hàng đã được hủy thành công.');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
