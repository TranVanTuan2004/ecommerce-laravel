<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Category::create([
            'name' => "Áo",
            'description' => 'abc',
        ]);
        Category::create([
            'name' => "Quần",
            'description' => 'abc',
        ]);
        Category::create([
            'name' => "Giày",
            'description' => 'abc',
        ]);
        Category::create([
            'name' => "Túi xách",
            'description' => 'abc',
        ]);
    }
}
