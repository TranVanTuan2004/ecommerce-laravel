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
}
