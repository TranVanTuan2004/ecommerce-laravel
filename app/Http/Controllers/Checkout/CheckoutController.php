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

        DB::beginTransaction();
        try {
            $cartItems = CartItem::with('product')
                ->where('cart_id', $user->id)
                ->whereIn('product_id', $productIds)
                ->get();

            $totalPrice = 0;
            foreach ($cartItems as $item) {
                $totalPrice += $item->product->price * $item->quantity;
            }

            $discount = 0;
            $percent = 0;
            $coupons = Coupons::where('code', $voucher_code)->first();
            if ($coupons) {
                $percent = $coupons->discount;
                $discount = $totalPrice * ($percent / 100);
            }

            $finalPrice = $totalPrice - $discount;

            // Tạo đơn hàng
            $order = Order::create([
                'user_id' => $user->id,
                'price' => $finalPrice,
                'discount' => $discount, // thêm cột này trong DB nếu chưa có
                'payment_method' => 'cod',
                'status' => 'pending'
            ]);

            // Lưu từng sản phẩm vào order_products
            foreach ($cartItems as $item) {
                OrderProduct::create([
                    'order_id' => $order->id,
                    'product_id' => $item->product->id,
                    'quantity' => $item->quantity,
                    'price' => $item->product->price, // đơn giá gốc tại thời điểm mua
                ]);
            }

            // Xóa các item đã mua khỏi giỏ hàng
            $cart = Cart::with('items')->where('user_id', $user->id)->first();
            if ($cart) {
                $cart->items()->whereIn('product_id', $productIds)->delete();
            }

            DB::commit();
            // Xóa session và redirect
            session()->forget('order_submitted');
            session(['order_submitted' => true]);
            return view('client.pages.checkout.success', compact('order'));

        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->route('homePage')->with('error', 'Lỗi khi đặt hàng: ' . $e->getMessage());
        }
    }

}
