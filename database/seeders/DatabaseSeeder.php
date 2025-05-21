<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Coupons;
use App\Models\Product;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();



        $this->call([
            UserSeeder::class,
            BrandSeeder::class,
            CategorySeeder::class,
            SlideSeeder::class,
            ProductSeeder::class,
            WishlistSeeder::class,
            CouponsSeeder::class,
            CartSeeder::class,
            CartItemSeeder::class,
            OrderSeeder::class,
            OrderProductSeeder::class,
            ReviewSeeder::class,
            ShippingSeeder::class,
            BlogSeeder::class,
        ]);
    }
}
