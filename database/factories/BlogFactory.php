<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\User;

class BlogFactory extends Factory
{
    protected $model = \App\Models\Blog::class;


    public function definition()
    {
        // Lấy 1 user có role là admin ngẫu nhiên
        $admin = User::where('role', 'admin')->inRandomOrder()->first();

        return [
            'title' => $this->faker->sentence(6),
            'content' => $this->faker->paragraphs(3, true),
            'user_id' => $admin ? $admin->id : User::factory(),

        ];
    }
}
