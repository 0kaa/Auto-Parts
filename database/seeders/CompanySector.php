<?php

namespace Database\Seeders;

use App\Models\CompanyModel;
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
            [
                'name_ar'   => 'تويوتا',
                'name_en'   => 'Toyota',
                'image'     => 'cars/toyota.png',
            ],
            [
                'name_ar'   => 'نيسان',
                'name_en'   => 'Nissan',
                'image'     => 'cars/nissan-logo.svg',
            ],
            [
                'name_ar'   => 'مرسيدس',
                'name_en'   => 'Mersedes',
                'image'     => 'cars/mersedes-logo.svg',
            ],
            [
                'name_ar'   => 'لكزس',
                'name_en'   => 'Lexus',
                'image'     => 'cars/lexus-icon.svg',
            ],
            [
                'name_ar'   => 'فورد',
                'name_en'   => 'Ford',
                'image'     => 'cars/ford-logo.svg',
            ],
            [
                'name_ar'   => 'شيفروليه',
                'name_en'   => 'Chevrolet',
                'image'     => 'cars/chevrolet-logo.svg',
            ],

        ]);
        CompanyModel::insert([
            [
                'name'                  => '2010',
                'company_sector_id'     => 1,
            ],
            [
                'name'                  => '2011',
                'company_sector_id'     => 2,
            ],
            [
                'name'                  => '2012',
                'company_sector_id'     => 3,
            ],
            [
                'name'                  => '2013',
                'company_sector_id'     => 4,
            ],
            [
                'name'                  => '2014',
                'company_sector_id'     => 5,
            ],
            [
                'name'                  => '2015',
                'company_sector_id'     => 6,
            ],
        ]);
    }
}
