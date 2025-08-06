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
            ['name' => 'Superadmin', 'email'        => 'superadmin@admin.com', 'role' => 1],
            ['name' => 'Manager', 'email'           => 'manager@manager.com', 'role' => 2],
            ['name' => 'Staff', 'email'             => 'staff@staff.com', 'role' => 3],
            ['name' => 'Store Admin', 'email'       => 'storeadmin@storeadmin.com', 'role' => 4],
            ['name' => 'Store Manager', 'email'     => 'storemanager@storemanager.com', 'role' => 5],
            ['name' => 'Store Accountant', 'email'  => 'storeaccountant@storeaccountant.com', 'role' => 6],
            ['name' => 'Store Staff', 'email'       => 'storestaff@storestaff.com', 'role' => 7],
            ['name' => 'Biller', 'email'            => 'biller@biller.com', 'role' => 8],
            ['name' => 'Executive', 'email'         => 'executive@executive.com', 'role' => 9],
            ['name' => 'Customer', 'email'          => 'customer@customer.com', 'role' => 10],
            ['name' => 'Reseller', 'email'          => 'reseller@reseller.com', 'role' => 11],

        ];

        foreach ($roles as $data) {
            $userLevel = User_level::firstOrCreate(
                ['role' => $data['role']],
                ['name' => $data['name']]
            );

            User::updateOrCreate(
                ['email' => $data['email']],
                [
                    'name' => $data['name'],
                    'user_level' => $userLevel->id,
                    'password' => bcrypt('123'),
                    //'profile_photo' => 'uploads/users/default.png',
                    'profile_image' => 'admin-assets/img/profiles/profile.png',
                ]
            );
        }
    }
}
