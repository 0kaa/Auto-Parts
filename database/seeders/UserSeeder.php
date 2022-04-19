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
            'first_name' => 'Admin',
            'last_name' => 'Admin',
            'username'  => 'admin',
            'email' => "info@jaadara.com",
            'address' => "Egypt, Elmansoura",
            'password' => bcrypt("password"),
            'phone' => '9665214578952',
            'email_verified_at' => now()
        ));

        $admin->assignRole('admin');

        $owner_store = User::create(array(
            'first_name'                => 'owner',
            'last_name'                 => 'owner',
            'username'                  => 'owner',
            'email'                     => "owner@gmail.com",
            'password'                  => bcrypt("password"),
            'phone'                     => '123123',
            'address'                   => "Egypt, Elmansoura",
            'approved'                  => 1,
            'city_id'                   => 1,
            'region_id'                 => 1,
            'activity_type_id'          => 1,
            'company_sector_id'         => 1,
            'commercial_register_id'    => "123123",
            'email_verified_at'         => now()

        ));

        $owner_store->assignRole('owner_store');

        $owner_store2 = User::create(array(
            'first_name'                => 'owner1',
            'last_name'                 => 'owner1',
            'username'                  => 'owner1',
            'email'                     => "owner1@gmail.com",
            'password'                  => bcrypt("password"),
            'phone'                     => '1231233',
            'address'                   => "Egypt, Elmansoura",
            'approved'                  => 1,
            'city_id'                   => 1,
            'region_id'                 => 1,
            'activity_type_id'          => 1,
            'company_sector_id'         => 1,
            'commercial_register_id'    => "123123",
            'email_verified_at'         => now()

        ));

        $owner_store2->assignRole('owner_store');

        $owner_store3 = User::create(array(
            'first_name'                => 'owner2',
            'last_name'                 => 'owner2',
            'username'                  => 'owner2',
            'email'                     => "owner2@gmail.com",
            'password'                  => bcrypt("password"),
            'phone'                     => '12312333',
            'address'                   => "Egypt, Elmansoura",
            'approved'                  => 1,
            'city_id'                   => 1,
            'region_id'                 => 1,
            'activity_type_id'          => 1,
            'company_sector_id'         => 1,
            'commercial_register_id'    => "123123",
            'email_verified_at'         => now()

        ));

        $owner_store3->assignRole('owner_store');


        $user = User::create(array(
            'first_name' => 'user',
            'last_name' => 'user',
            'username' => 'user',
            'email' => "user@gmail.com",
            'password' => bcrypt("password"),
            'phone' => '1231234',
            'address' => "Egypt, Elmansoura",
            'approved' => 1,
            'email_verified_at' => now()

        ));

        $user->assignRole('user');

        $workshop = User::create(array(
            'first_name' => 'work',
            'last_name' => 'shop',
            'username' => 'workshop',
            'email' => "workshop@gmail.com",
            'password' => bcrypt("password"),
            'phone' => '123321',
            'address' => "Egypt, Elmansoura",
            'approved' => 1,
            'email_verified_at' => now()

        ));

        $workshop->assignRole('workshop');
    }
}
