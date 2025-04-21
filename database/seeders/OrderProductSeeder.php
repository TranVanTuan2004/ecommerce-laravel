<?php

namespace Database\Seeders;

use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\OrderProduct;
use App\Models\Product;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class OrderProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $orders = Order::all();
        $products = Product::all();

        foreach ($orders as $order) {
            $selectedProducts = $products->random(rand(2, 5));

            foreach ($selectedProducts as $product) {
                OrderProduct::firstOrCreate(
                    [
                        'order_id' => $order->id,
                        'product_id' => $product->id
                    ],
                    [
                        'quantity' => rand(1, 5),
                        'price' => $product->price
                    ]
                );
            }
        }
    }
}
