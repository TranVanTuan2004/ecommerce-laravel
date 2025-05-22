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
            'description' => "Nothing to show desctiption",
            'logo' => ""
        ]);
        Brand::factory()->create([
            'name' => 'Gucci',
            'description' => "Nothing to show desctiption",
            'logo' => "storage/brandlogo/gucci.png"
        ]);
        Brand::factory()->create([
            'name' => 'Hermes',
            'description' => "Nothing to show desctiption",
            'logo' => "storage/brandlogo/hermes.png"
        ]);
        Brand::factory()->create([
            'name' => 'Dior',
            'description' => "Nothing to show desctiption",
            'logo' => "Dior.jpg"
        ]);
        Brand::factory()->create([
            'name' => 'Adidas',
            'description' => "Nothing to show desctiption",
            'logo' => "storage/brandlogo/Adidas.png"
        ]);
        Brand::factory()->create([
            'name' => 'Nike',
            'description' => "Nothing to show desctiption",
            'logo' => "storage/brandlogo/nike.png"
        ]);
        Brand::factory()->create([
            'name' => 'Zara',
            'description' => "Nothing to show desctiption",
            'logo' => "storage/brandlogo/zara.png"
        ]);
    }
}
