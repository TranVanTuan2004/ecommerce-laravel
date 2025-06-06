<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\Slide;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Role::factory()->create([
            'name' => 'user',
        ]);

        Role::factory()->create([
            'name' => 'admin',
        ]);
    }
}
