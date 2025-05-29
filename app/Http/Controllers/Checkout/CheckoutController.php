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
        $user = Auth::user();
        $productId = $request->input('productId');
        $quantity = $request->input('quantity', 1); // mặc định 1 nếu không có
        $selectedProducts = $request->input('products');

        // Trường hợp mua ngay
        if ($productId) {
            $product = Product::find($productId);

            if (!$product) {
                toastr()->error('Sản phẩm không tồn tại', [], 'Lỗi');
                return redirect()->back();
            }

            $product->quantity = $quantity;

            return view('client.pages.checkout.checkout', compact('user', 'product', 'quantity'));
        }

        // Trường hợp mua từ giỏ hàng
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

            return view('client.pages.checkout.checkout', compact('products', 'user'));
        }

        // Nếu không chọn sản phẩm nào cả
        toastr()->info('Bạn vẫn chưa chọn sản phẩm nào để mua', [], 'Thông báo');
        return redirect()->back();
    }

    public function getAllVouchers()
    {
        $vouchers = Coupons::latest()->get();
        return view('client.pages.checkout.voucherList', compact('vouchers'));
    }

    public function checkout(Request $request)
    {
        if (session('order_submitted')) {
            toastr()->info('Phiên đã hết hạn');
            return redirect()->route('homePage');
        }

        $user = Auth::user();
        $voucher_code = $request->input('voucher_code');

        $productIds = $request->input('product_ids'); // từ giỏ hàng
        $buyNowId = $request->input('product_id');    // từ trang chi tiết
        $buyNowQuantity = $request->input('quantity', 1);

        $user = Auth::user();
        $cart = Cart::where('user_id', $user->id)->first();

        if (!$cart) {
            toastr()->error('Không tìm thấy giỏ hàng');
            return redirect()->back();
        }

        DB::beginTransaction();
        try {
            if ($buyNowId) {
                // Mua ngay: tạo đơn hàng từ 1 sản phẩm
                $product = Product::findOrFail($buyNowId);

                $totalPrice = $product->price * $buyNowQuantity;
                $discount = 0;

                $coupon = Coupons::where('code', $request->input('voucher_code'))->first();
                if ($coupon) {
                    $discount = $totalPrice * ($coupon->discount / 100);
                }

                $finalPrice = $totalPrice - $discount;

                $order = Order::create([
                    'user_id' => $user->id,
                    'price' => $finalPrice,
                    'discount_price' => $discount,
                    'voucher_code' => $coupon?->code,
                    'payment_method' => 'cod',
                    'status' => 'pending'
                ]);

                OrderProduct::create([
                    'order_id' => $order->id,
                    'product_id' => $product->id,
                    'quantity' => $buyNowQuantity,
                    'price' => $product->price,
                ]);
            } else if (!empty($productIds)) {
                // Mua từ giỏ hàng
                $cartItems = CartItem::with('product')
                    ->where('cart_id', $cart->id)
                    ->whereIn('product_id', $productIds)
                    ->get();

                if ($cartItems->isEmpty()) {
                    toastr()->info('Không tìm thấy sản phẩm trong giỏ hàng');
                    return redirect()->back();
                }

                $totalPrice = $cartItems->sum(fn($item) => $item->product->price * $item->quantity);

                $coupon = Coupons::where('code', $request->input('voucher_code'))->first();
                $discount = $coupon ? ($totalPrice * ($coupon->discount / 100)) : 0;
                $finalPrice = $totalPrice - $discount;

                $order = Order::create([
                    'user_id' => $user->id,
                    'price' => $finalPrice,
                    'discount_price' => $discount,
                    'voucher_code' => $coupon?->code,
                    'payment_method' => 'cod',
                    'status' => 'pending'
                ]);

                foreach ($cartItems as $item) {
                    OrderProduct::create([
                        'order_id' => $order->id,
                        'product_id' => $item->product->id,
                        'quantity' => $item->quantity,
                        'price' => $item->product->price,
                    ]);
                }

                // Xóa sản phẩm đã mua khỏi giỏ hàng
                $cart->items()->whereIn('product_id', $productIds)->delete();
            } else {
                toastr()->info('Không có sản phẩm để đặt hàng');
                return redirect()->back();
            }

            DB::commit();
            session(['order_submitted' => true]);

            return view('client.pages.checkout.success', compact('order'));
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->route('homePage')->with('error', 'Lỗi khi đặt hàng: ' . $e->getMessage());
        }
    }

}
