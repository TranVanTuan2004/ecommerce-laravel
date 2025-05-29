<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Message;
use App\Models\User;
use Faker\Factory as Faker;

class MessageSeeder extends Seeder
{
    public function run()
    {
        $faker = Faker::create();

        // Lấy danh sách user_id có role = 'user'
        $userIds = User::where('role', 'user')->pluck('id')->toArray();

        if (empty($userIds)) {
            $this->command->info('No users with role user found.');
            return;
        }

        // Tạo 50 tin nhắn do user gửi
        for ($i = 0; $i < 5; $i++) {
            Message::create([
                'user_id' => $faker->randomElement($userIds),
                'sender' => 'user', // chỉ gửi từ user
                'content' => $faker->sentence(10),
                'created_at' => $faker->dateTimeBetween('-1 month', 'now'),
                'updated_at' => now(),
            ]);
        }
    }
}
