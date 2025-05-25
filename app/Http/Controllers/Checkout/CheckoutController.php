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
use Illuminate\Support\Facades\DB;
use PhpParser\Node\Expr\Throw_;

use function Laravel\Prompts\error;

class CheckoutController extends Controller
{
    public function index(Request $request)
    {
        $selectedProducts = $request->input('products');
        $user = Auth::user();

        if ($selectedProducts) {
            $cart = Cart::where('user_id', $user->id)->first();

            if (!$cart) {
                toastr()->info('Không tìm thấy giỏ hàng', [], 'Thông báo');
                return redirect()->back();
            }

            $products = Product::join('cart_items', 'products.id', '=', 'cart_items.product_id')
                ->whereIn('products.id', $selectedProducts)
                ->where('cart_items.cart_id', $cart->id)
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
        $vouchers = Coupons::latest()->get();
        return view('client.pages.checkout.voucherList', compact('vouchers'));
    }

    public function store(Request $request)
    {
        if (session('order_submitted')) {
            toastr()->info('Phiên đã hết hạn');
            return redirect()->route('homePage');
        }

        $voucher_code = $request->input('voucher_code');
        $productIds = $request->input('product_ids');

        if (empty($productIds)) {
            toastr()->info('Phiên đã hết hạn', [], 'Thông báo');
            return redirect()->back();
        }

        $user = Auth::user();
        // lấy ra được cái cart trước
        $cart = Cart::where('user_id', $user->id)->first();

        if (!$cart) {
            toastr()->error('Không tìm thấy giỏ hàng');
            return redirect()->back();
        }

        DB::beginTransaction();
        try {
            $cartItems = CartItem::with('product')
                ->where('cart_id', $cart->id)
                ->whereIn('product_id', $productIds)
                ->get();

            if ($cartItems->isEmpty()) {
                toastr()->info('Không tìm thấy sản phẩm trong giỏ hàng');
                return redirect()->back();
            }

            $totalPrice = $cartItems->sum(function ($item) {
                return $item->product->price * $item->quantity;
            });

            $discount = 0;
            $percent = 0;

            $coupon = Coupons::where('code', $voucher_code)->first();
            if ($coupon) {
                $percent = $coupon->discount;
                $discount = $totalPrice * ($percent / 100);
            }

            $finalPrice = $totalPrice - $discount;

            // Tạo đơn hàng
            $order = Order::create([
                'user_id' => $user->id,
                'price' => $finalPrice,
                'discount_price' => $discount,
                'voucher_code' => $voucher_code,
                'payment_method' => 'cod',
                'status' => 'pending'
            ]);

            // Thêm từng sản phẩm vào đơn hàng
            foreach ($cartItems as $item) {
                OrderProduct::create([
                    'order_id' => $order->id,
                    'product_id' => $item->product->id,
                    'quantity' => $item->quantity,
                    'price' => $item->product->price,
                ]);
            }

            // Xóa các item khỏi giỏ hàng
            $cart->items()->whereIn('product_id', $productIds)->delete();

            DB::commit();

            session()->forget('order_submitted');
            session(['order_submitted' => true]);

            return view('client.pages.checkout.success', compact('order'));
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->route('homePage')->with('error', 'Lỗi khi đặt hàng: ' . $e->getMessage());
        }
    }
}
