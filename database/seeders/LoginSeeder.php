<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\User_level;

class LoginSeeder extends Seeder
{
    public function run(): void
    {
        $roles = [
            ['name' => 'Superadmin', 'email' => 'superadmin@admin.com', 'role' => 1],
            ['name' => 'Manager', 'email' => 'manager@manager.com', 'role' => 2],
        ];

        foreach ($roles as $data) {
            // Find or create the role in user_level table
            $userLevel = User_level::firstOrCreate(
                ['role' => $data['role']],
                ['name' => $data['name']]
            );

            // Create or update the user and link the user_level_id
            User::updateOrCreate(
                ['email' => $data['email']],
                [
                    'name' => $data['name'],
                    'user_level' => $userLevel->id,
                    'password' => bcrypt('123'), // add default password
                ]
            );
        }
    }
}