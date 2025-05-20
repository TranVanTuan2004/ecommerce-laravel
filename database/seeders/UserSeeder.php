<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Nette\Utils\Random;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::factory()->create([
            'name' => 'Tuấn Trần',
            'email' => 'tuantran280504@gmail.com',
            'password' => Hash::make('123456'),
            'role' => "admin",
            'email_verified_at' => now()
        ]);

        User::factory()->create([
            'name' => 'Hai Ba',
            'email' => 'test@gmail.com',
            'password' => Hash::make('123456'),
            'role' => "user",
            'email_verified_at' => now()
        ]);



        User::factory(100)->create();
    }
}
