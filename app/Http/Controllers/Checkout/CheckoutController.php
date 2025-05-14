<?php

namespace App\Http\Controllers\Checkout;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\CartItem;
use App\Models\Coupons;
use App\Models\Order;
use App\Models\OrderProduct;
use App\Models\Product;
use Flasher\Toastr\Laravel\Facade\Toastr;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use PhpParser\Node\Expr\Throw_;

use function Laravel\Prompts\error;

class CheckoutController extends Controller
{
    public function index(Request $request)
    {
        $selectedProducts = $request->input('products');
        $user = Auth::user();
        if ($selectedProducts) {
            $products = Product::join('cart_items', 'products.id', '=', 'cart_items.product_id')
                ->whereIn('products.id', $selectedProducts)->where('cart_items.cart_id', Auth::id())
                ->select('products.*', 'cart_items.quantity')
                ->get();
            return view('client.pages.checkout.checkout', compact(['products', 'user']));
        } else {
            toastr()->info('Bạn vẫn chưa chọn sản phẩm nào để mua', [], 'Thông báo');
            return redirect()->back();
        }
    }

    public function getAllVouchers()
    {
        $vouchers = Coupons::all();
        return view('client.pages.checkout.voucherList', compact('vouchers'));
    }

    public function store(Request $request)
    {
        try {
            $vocher_code = $request->input('voucher_code');
            $productIds = $request->input('product_ids');
            $user = Auth::user();

            $totalPrice = 0;
            $discount = 0;
            $newPrice = 0;

            $cartItems = CartItem::with('product')
                ->where('cart_id', $user->id)
                ->whereIn('product_id', $productIds)
                ->get();

            foreach ($cartItems as $item) {
                $totalPrice += $item->product->price * $item->quantity;
            }

            $coupons = Coupons::where('code', $vocher_code)->first();
            if ($coupons) {
                $percent = $coupons->discount;
                $discount = $totalPrice * ($percent / 100);
                $newPrice = $totalPrice - $discount;
            } else {
                $newPrice = $totalPrice;
            }

            $order = Order::create([
                'user_id' => $user->id,
                'total_price' => $newPrice,
                'payment_method' => 'cod',
                'status' => 'pending'
            ]);

            foreach ($cartItems as $item) {
                OrderProduct::create([
                    'order_id' => $order->id,
                    'product_id' => $item->product->id,
                    'quantity' => $item->quantity,
                    'price' => $item->product->price * $item->quantity
                ]);
            }

            // sau khi order xong xóa các sản phẩm đã order trong giỏ hàng
            $cart = Cart::with('items')->where('user_id', $user->id)->first();
            if ($cart) {
                $cart->items()->whereIn('product_id', $productIds)->delete();
            }
            return redirect()->route('orders.show', $order->id);
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Quá trình đặt hàng đang bị lỗi ' . $e->getMessage());
        }
    }

    public function abc(Request $request)
    {

        $order = Order::findOrFail($request->id);
        return view('client.pages.checkout.success', compact('order'));
    }
}
