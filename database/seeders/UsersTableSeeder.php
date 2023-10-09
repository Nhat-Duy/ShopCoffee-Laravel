<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Admin;
use App\Models\Roles;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Admin::truncate();

        $adminRoles = Roles::where('name', 'admin')->first();
        $authorRoles = Roles::where('name', 'author')->first();
        $userRoles = Roles::where('name', 'user')->first();

        $admin = Admin::create([
            'admin_name' => 'duyadmin',
            'admin_email' => 'duyadmin@gmail.com',
            'admin_phone' => '012125125',
            'admin_password' => md5('123456')
        ]);

        $author = Admin::create([
            'admin_name' => 'duyauthor',
            'admin_email' => 'duyauthor@gmail.com',
            'admin_phone' => '012125125',
            'admin_password' => md5('123456')
        ]);

        $user = Admin::create([
            'admin_name' => 'duyuser',
            'admin_email' => 'duyuser@gmail.com',
            'admin_phone' => '012125125',
            'admin_password' => md5('123456')
        ]);

        $admin->roles()->attach($adminRoles);
        $author->roles()->attach($authorRoles);
        $user->roles()->attach($userRoles);
    }
}
