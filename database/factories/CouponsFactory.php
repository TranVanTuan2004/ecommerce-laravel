<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Coupons>
 */
class CouponsFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'code' => strtoupper($this->faker->bothify('SAVE##??')), // ví dụ: SAVE12AB
            'discount' => $this->faker->numberBetween(5, 50), // giảm giá 5% đến 50%
            'min_order_value' => $this->faker->randomFloat(2, 100, 1000), // giá trị đơn tối thiểu từ 100 đến 1000
            'expiration_date' => $this->faker->dateTimeBetween('now', '+1 year'), // hạn dùng từ hôm nay đến 1 năm sau
        ];
    }
}
