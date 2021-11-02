<?php

namespace Database\Seeders;

use App\Models\ActivityType;
use Illuminate\Database\Seeder;

class ActivityTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //

        ActivityType::insert([[
            'name_ar'=>'قطع غيار جديدة',
            'name_en'=>'new spare parts',
            'type'=>1,
            'num_pieces'=>1234,
            'image'=>'images/1.png'
        ],[
            'name_ar'=>'قطع غيار تشليح',
            'name_en'=>'repair spare parts',
            'type'=>1,
            'num_pieces'=>250,
            'image'=>'images/car-parts.png'
            ],[
            'name_ar'=>'العنايه بالسيارات',
            'name_en'=>'car care',
            'type'=>2,
            'num_pieces'=>100,
            'image'=>'images/5.png'
            ],[
            'name_ar'=>'إطارات',
            'name_en'=>'tires',
            'type'=>2,
            'num_pieces'=>745,
            'image'=>'images/3.png'
        ],[
            'name_ar'=>'زيوت',
            'name_en'=>'oils',
            'type'=>2,
            'num_pieces'=>745,
            'image'=>'images/4.png'
            ]
        ]);
    }
}
