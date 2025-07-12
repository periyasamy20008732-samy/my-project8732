<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User_level;

class AdminSeeder extends Seeder
{
    public function run(): void
    {
        $roles = [
            ['name' => 'Superadmin', 'role' => '1'],
            ['name' => 'Manager', 'role' => '2'],
            ['name' => 'Staff', 'role' => '3'],
            ['name' => 'Store Admin', 'role' => '4'],
            ['name' => 'Store Manager', 'role' => '5'],
            ['name' => 'Store Accountant', 'role' => '6'],
            ['name' => 'Store Staff', 'role' => '7'],
            ['name' => 'Biller ', 'role' => '8'],
            ['name' => 'Executive', 'role' => '9'],
            ['name' => 'Customer', 'role' => '10'],
        ];

        foreach ($roles as $role) {
            User_level::updateOrCreate(
                ['role' => $role['role']], // match by role number
                ['name' => $role['name']]  // update name if it already exists
            );
        }
    }
}