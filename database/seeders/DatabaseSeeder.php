<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(RoleTableSeeder::class);
        $this->call(UserSeeder::class);
        $this->call(StaticPageSeeder::class);
        $this->call(SettingSeeder::class);
        $this->call(ActivityTypeSeeder::class);
    }
}
