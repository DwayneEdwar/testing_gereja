<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;

class AdminUserSeeder extends Seeder
{
    public function run(): void
    {
        User::updateOrCreate(
            ['email' => 'superadmin@test.com'],
            [
                'name' => 'admin',
                'password' => bcrypt('password123'),
            ]
        );
    }
}
