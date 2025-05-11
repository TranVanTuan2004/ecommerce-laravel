<?php

namespace App\Http\Controllers\Checkout;

use App\Http\Controllers\Controller;
use App\Models\CartItem;
use App\Models\Product;
use Flasher\Toastr\Laravel\Facade\Toastr;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
}
