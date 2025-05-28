<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Order>
 */
class OrderFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */

    public function definition(): array
    {
        return [
            'user_id' => User::inRandomOrder()->first()?->id,
            'price' => $this->faker->randomFloat(3, 100, 10000), // giá từ 100 đến 1000
            'payment_method' => $this->faker->randomElement(['cod', 'paypal', 'momo', 'bank']),
            'status' => $this->faker->randomElement(['pending', 'shipping', 'delivering', 'delivered', 'cancelled']),
        ];
    }
}
