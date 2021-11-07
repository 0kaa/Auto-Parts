<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class RoleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Role::insert([
            [
                "name" => 'user',
                'guard_name' => 'web'
            ],
            [
                "name" => 'admin',
                'guard_name' => 'web'
            ],
            [
                "name" => 'owner_store',
                'guard_name' => 'web'
            ],
            [
                "name" => 'workshop',
                'guard_name' => 'web'
            ],
        ]);
    }
}
