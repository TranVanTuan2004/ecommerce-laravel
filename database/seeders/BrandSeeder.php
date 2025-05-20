<?php

namespace Database\Seeders;

use App\Models\Brand;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BrandSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Brand::factory(20)->create();
        Brand::truncate();
        Brand::factory()->create([
            'name' => 'Chanel',
            'description' => "Nothing to show desctiption"
        ]);
        Brand::factory()->create([
            'name' => 'Gucci',
            'description' => "Nothing to show desctiption"
        ]);
        Brand::factory()->create([
            'name' => 'Hermes',
            'description' => "Nothing to show desctiption"
        ]);
        Brand::factory()->create([
            'name' => 'Dior',
            'description' => "Nothing to show desctiption"
        ]);
        Brand::factory()->create([
            'name' => 'Adidas',
            'description' => "Nothing to show desctiption"
        ]);
        Brand::factory()->create([
            'name' => 'Nike',
            'description' => "Nothing to show desctiption"
        ]);
    }
}
