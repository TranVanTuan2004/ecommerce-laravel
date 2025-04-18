<?php

namespace Database\Factories;

use App\Models\Cart;
use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\CartItem>
 */
class CartItemFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     * 
     * 
     * 
     */


    public function definition(): array
    {
        static $createdCombinations = [];

        // Tạo một cặp cart_id và product_id duy nhất
        do {
            $cartId = Cart::inRandomOrder()->first()?->id;
            $productId = Product::inRandomOrder()->first()?->id;
        } while (in_array([$cartId, $productId], $createdCombinations));

        // Lưu cặp cart_id và product_id vào danh sách để tránh trùng
        $createdCombinations[] = [$cartId, $productId];
        return [
            'cart_id' => $cartId,
            'product_id' => $productId,
            'quantity' => $this->faker->numberBetween(1, 10), // Số lượng ngẫu nhiên từ 1 đến 10
        ];
    }
}
