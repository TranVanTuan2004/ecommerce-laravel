<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\User;

class BlogFactory extends Factory
{
    protected $model = \App\Models\Blog::class;


    public function definition()
    {
        $admin = \App\Models\User::where('role', 'admin')->inRandomOrder()->first();

        // Danh sách các ảnh đã có sẵn
        $imagePaths = [
            'storage/blog_images/a1.jpg',
            'storage/blog_images/a2.jpg',
            'storage/blog_images/a3.jpg',
            'storage/blog_images/a4.jpg',
        ];

        return [
            'title' => $this->faker->sentence(6),
            'content' => $this->faker->paragraphs(3, true),
            'user_id' => $admin ? $admin->id : \App\Models\User::factory(),
            'image' => $this->faker->randomElement($imagePaths),
        ];
    }
}
