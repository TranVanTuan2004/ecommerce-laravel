<?php

namespace Database\Seeders;

use App\Models\Cart;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CartSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Lấy tất cả các users
        $users = User::all();

        // Duyệt qua từng user để tạo giỏ hàng cho họ
        foreach ($users as $user) {
            Cart::factory()->create([
                'user_id' => $user->id,
            ]);
        }
    }
}
