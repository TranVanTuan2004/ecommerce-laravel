<?php

namespace Database\Seeders;

use App\Models\Order;
use App\Models\User;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class OrderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user = User::first(); // hoặc tạo user trước

        $order = Order::create([
            'user_id' => $user->id,
            'total_price' => 500000,
            'payment_method' => 'COD',
            'status' => 'processing'
        ]);

        // Shipping
        $order->shipping()->create([
            'recipient_name' => $user->name,
            'phone' => '0901234567',
            'address' => '123 Đường ABC, TP.HCM'
        ]);

        // Order detail
        $order->orderDetails()->create([
            'product_id' => 1, // đảm bảo đã có product
            'quantity' => 2,
            'price' => 250000
        ]);

        // Payment
        $order->payments()->create([
            'method' => 'COD',
            'amount' => 500000
        ]);
    }
}
