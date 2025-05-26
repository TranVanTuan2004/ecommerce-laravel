<?php

namespace App\Providers;

use App\Models\Cart;
use App\Models\CartItem;
use App\Models\Category;
use App\Models\Wishlist;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Auth;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        View::composer('client.components.header', function ($view) {
            $count = 0;

            if (Auth::check()) {
                $cart = Cart::where('user_id', Auth::id())->first();
                if ($cart) {
                    $count = CartItem::where('cart_id', $cart->id)->count();
                }
            }
            // Đếm số sản phẩm yêu thích
            $wishlistCount = Wishlist::where('user_id', Auth::id())->count();
            $view->with([
                'count' => $count,
                'wishlistCount' => $wishlistCount,
            ]);
        });
        Paginator::useBootstrapFive();
    }
}
