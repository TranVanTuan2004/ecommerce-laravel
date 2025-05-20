<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $products = [
            [
                'name' => 'Áo thun Dragon Ball chính hãng',
                'description' => 'Áo thun in hình Goku cực chất, chất liệu cotton 100%.',
                'price' => 299000,
                'category_id' => 1,
                'brand_id' => 1,
                'slide_id' => 1,
                'image' => 'https://via.placeholder.com/640x480.png?text=Goku+Shirt',
            ],
        ];

        foreach ($products as $product) {
            Product::create($product);
        }
    }
}
