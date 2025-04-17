<?php

namespace Database\Seeders;

use App\Models\Cart;
use App\Models\CartItem;
use App\Models\Product;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CartItemSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $carts = Cart::all();
        $products = Product::all();

        foreach ($carts as $cart) {
            // Chọn ngẫu nhiên 3–5 sản phẩm cho mỗi cart
            $selectedProducts = $products->random(rand(3, 5));

            foreach ($selectedProducts as $product) {
                // Dùng firstOrCreate để tránh trùng primary key
                CartItem::firstOrCreate(
                    [
                        'cart_id' => $cart->id,
                        'product_id' => $product->id
                    ],
                    [
                        'quantity' => rand(1, 10)
                    ]
                );
            }
        }
    }
}
