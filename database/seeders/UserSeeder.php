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
            'name'                      => 'Owner',
            'email'                     => "owner@gmail.com",
            'password'                  => bcrypt("password"),
            'phone'                     => '123123',
            'address'                   => "Egypt, Elmansoura",
            'city_id'                   => 1,
            'region_id'                 => 1,
            'activity_type_id'          => 1,
            'company_sector_id'         => 1,
            'commercial_register_id'    => "123123",
            'email_verified_at'         => now()

        ));

        $owner_store->assignRole('owner_store');

        $owner_store2 = User::create(array(
            'name'                      => 'Owner',
            'email'                     => "owner1@gmail.com",
            'password'                  => bcrypt("password"),
            'phone'                     => '1231233',
            'address'                   => "Egypt, Elmansoura",
            'city_id'                   => 1,
            'region_id'                 => 1,
            'activity_type_id'          => 1,
            'company_sector_id'         => 1,
            'commercial_register_id'    => "123123",
            'email_verified_at'         => now()

        ));

        $owner_store2->assignRole('owner_store');

        $owner_store3 = User::create(array(
            'name'                      => 'Owner',
            'email'                     => "owner2@gmail.com",
            'password'                  => bcrypt("password"),
            'phone'                     => '12312333',
            'address'                   => "Egypt, Elmansoura",
            'city_id'                   => 1,
            'region_id'                 => 1,
            'activity_type_id'          => 1,
            'company_sector_id'         => 1,
            'commercial_register_id'    => "123123",
            'email_verified_at'         => now()

        ));

        $owner_store3->assignRole('owner_store');


        $user = User::create(array(
            'name' => 'User',
            'email' => "user@gmail.com",
            'password' => bcrypt("password"),
            'phone' => '1231234',
            'address' => "Egypt, Elmansoura",
            'email_verified_at' => now()

        ));

        $user->assignRole('user');

        $workshop = User::create(array(
            'name' => 'Workshop',
            'email' => "workshop@gmail.com",
            'password' => bcrypt("password"),
            'phone' => '123321',
            'address' => "Egypt, Elmansoura",
            'email_verified_at' => now()

        ));

        $workshop->assignRole('workshop');
    }
}
