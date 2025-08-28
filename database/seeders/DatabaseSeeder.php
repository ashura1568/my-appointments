<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::factory()->create([
            'name' => 'Andres Molina',
            'email' => 'hola@mail.com',
            'password' => bcrypt('123'),
            'dni' => '112233',
            'address' => '',
            'phone' => '',
            'role' => 'admin'
        ]);

        User::factory(50)->create();


    }
}
