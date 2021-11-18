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
                'image'     => public_path('images/cars/toyota-logo.svg'),
            ],
            [
                'name_ar'   => 'نيسان',
                'name_en'   => 'Nissan',
                'image'     => public_path('images/cars/nissan-logo.svg'),
            ],
            [
                'name_ar'   => 'مرسيدس',
                'name_en'   => 'Mersedes',
                'image'     => public_path('images/cars/mersedes-logo.svg'),
            ],
            [
                'name_ar'   => 'لكزس',
                'name_en'   => 'Lexus',
                'image'     => public_path('images/cars/lexus-icon.svg'),
            ],
            [
                'name_ar'   => 'فورد',
                'name_en'   => 'Ford',
                'image'     => public_path('images/cars/ford-logo.svg'),
            ],
            [
                'name_ar'   => 'شيفروليه',
                'name_en'   => 'Chevrolet',
                'image'     => public_path('images/cars/chevrolet-logo.svg'),
            ],

        ]);
    }
}
