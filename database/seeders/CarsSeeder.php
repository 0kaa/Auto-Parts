<?php

namespace Database\Seeders;

use App\Models\Car;
use Illuminate\Database\Seeder;

class CarsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {


        Car::insert([
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
    }
}
