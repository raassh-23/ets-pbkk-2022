<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::factory()->create([
            'name' => 'Admin',
            'email' => 'admin@mail.com',
            'role' => 1,
        ]);

        User::factory()->create([
            'name' => 'User',
            'email' => 'user@mail.com',
            'role' => 0,
        ]);

        User::factory()->count(5)->create();
    }
}
