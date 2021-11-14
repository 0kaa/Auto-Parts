<?php

namespace Database\Seeders;

use App\Models\CompanySector as AppCompanySector;

use Illuminate\Database\Seeder;

class CompanySector extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        AppCompanySector::insert([
            'name_ar' => 'شركات تجارية',
            'name_en' => 'Companies',
        ]);
    }
}
