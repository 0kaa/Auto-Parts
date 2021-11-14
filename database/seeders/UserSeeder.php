<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $admin = User::create(array(
            'name' => 'Admin',
            'email' => "info@jaadara.com",
            'address' => "Egypt, Elmansoura",
            'password' => bcrypt("password"),
            'phone' => '9665214578952',
            'email_verified_at' => now()
        ));

        $admin->assignRole('admin');

        $owner_store = User::create(array(
            'name' => 'Owner',
            'email' => "owner@gmail.com",
            'password' => bcrypt("password"),
            'phone' => '123123',
            'address' => "Egypt, Elmansoura",
            'email_verified_at' => now()

        ));

        $owner_store->assignRole('owner_store');


        $user = User::create(array(
            'name' => 'User',
            'email' => "user@gmail.com",
            'password' => bcrypt("password"),
            'phone' => '1231234',
            'address' => "Egypt, Elmansoura",
            'email_verified_at' => now()

        ));

        $user->assignRole('user');
    }
}
