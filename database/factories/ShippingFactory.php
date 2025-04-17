<?php

namespace Database\Factories;

use App\Models\Order;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Shipping>
 */
class ShippingFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'order_id' => Order::inRandomOrder()->first()?->id,
            'carrier' => $this->faker->randomElement(['GHTK', 'VNPost', 'GHN', 'J&T', 'Ninja Van']),
            'status' => $this->faker->randomElement(['processing', 'shipped', 'in_transit', 'delivered', 'cancelled']),
            'estimated_delivery' => $this->faker->dateTimeBetween('+1 days', '+7 days'),
        ];
    }
}
