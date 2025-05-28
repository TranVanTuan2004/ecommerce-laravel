<?php

namespace App\Http\Controllers\Cart;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\CartItem;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    public function index()
    {
        session()->forget('order_submitted');
        if (!Auth::check())
            return redirect()->route('login');
        $cart = Cart::with('items.product')->where('user_id', Auth::id())->first();
        return view('client.pages.cart.cart', compact('cart'));
    }

    public function addToCart(Request $request)
    {
        if (!Auth::check())
            return redirect()->route('login');
        $product = Product::findOrFail($request->product_id);

        // Tạo giỏ hàng cho user nếu chưa có
        $cart = Cart::firstOrCreate([
            'user_id' => Auth::user()->id,
        ]);

        $cartItem = CartItem::where('cart_id', $cart->id)
            ->where('product_id', $product->id)->first();


        if ($cartItem) {
            $cartItem->quantity += 1;
            $cartItem->save();
        } else {
            CartItem::create([
                'cart_id' => $cart->id,
                'product_id' => $product->id,
                'quantity' => 1,
            ]);
        }
        return redirect()->back()->with('success', 'Đã thêm vào giỏ hàng');
    }

    public function increase($productId)
    {
        try {
            $cart = Cart::where('user_id', Auth::id())->first();
            if (!$cart)
                return redirect()->back();
            $cartItem = CartItem::where('cart_id', $cart->id)
                ->where('product_id', $productId)
                ->first();

            if ($cartItem) {
                $cartItem->increment('quantity');
            }

            return redirect()->back();
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Lỗi khi tăng số lượng');
        }
    }

    public function decrease($productId)
    {
        try {
            $cart = Cart::where('user_id', Auth::id())->first();
            if (!$cart)
                return redirect()->back();

            $cartItem = CartItem::where('cart_id', $cart->id)
                ->where('product_id', $productId)
                ->first();

            if ($cartItem) {
                if ($cartItem->quantity > 1) {
                    $cartItem->decrement('quantity');
                } else {
                    $cartItem->delete();
                }
            }

            return redirect()->back();
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Lỗi khi giảm số lượng ' . $e->getMessage());
        }
    }

    public function destroy($productId)
    {
        try {
            $cart = Cart::where('user_id', Auth::id())->first();
            if ($cart) {
                CartItem::where('cart_id', $cart->id)
                    ->where('product_id', $productId)
                    ->delete();
            }
            return redirect()->back();
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Lỗi khi xóa sản phẩm ' . $e->getMessage());
        }
    }

    public function clearAllCart()
    {
        try {
            $cart = Cart::where('user_id', Auth::id())->first();
            // dd($cart);
            if ($cart) {
                $rs = CartItem::where('cart_id', $cart->id)->delete();
                if ($rs) {
                    return redirect()->back()->with('success', 'Đã xoá toàn bộ giỏ hàng!');
                } else {
                    return redirect()->back()->with('error', 'Giỏ hàng không còn gì để xóa hẹ hẹ!');
                }
            }
            return redirect()->back()->with('error', 'Lỗi khi xóa giỏ hàng');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Lỗi khi xóa tất cả giỏ hàng ' . $e->getMessage());
        }
    }
}
