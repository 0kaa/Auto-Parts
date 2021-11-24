<?php

namespace Database\Seeders;

use App\Models\ActivityType;
use App\Models\SubActivity;

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

        ActivityType::insert([
            [
                'name_ar' => 'قطع غيار جديدة',
                'name_en' => 'new spare parts',
                'type' => 1,
                'num_pieces' => 1234,
                'image' => 'images/1.png',
                'created_at' => now(),
                'updated_at' => now(),
            ], [
                'name_ar' => 'قطع غيار تشليح',
                'name_en' => 'repair spare parts',
                'type' => 1,
                'num_pieces' => 250,
                'image' => 'images/car-parts.png',
                'created_at' => now(),
                'updated_at' => now(),
            ], [
                'name_ar' => 'العنايه بالسيارات',
                'name_en' => 'car care',
                'type' => 2,
                'num_pieces' => 100,
                'image' => 'images/5.png',
                'created_at' => now(),
                'updated_at' => now(),
            ], [
                'name_ar' => 'إطارات',
                'name_en' => 'tires',
                'type' => 2,
                'num_pieces' => 745,
                'image' => 'images/3.png',
                'created_at' => now(),
                'updated_at' => now(),
            ], [
                'name_ar' => 'زيوت',
                'name_en' => 'oils',
                'type' => 2,
                'num_pieces' => 745,
                'image' => 'images/4.png',
                'created_at' => now(),
                'updated_at' => now(),
            ]
        ]);

        SubActivity::insert([
            [
                'name_ar' => 'مكيانيكا',
                'name_en' => 'mechanics',
                'activity_type_id' => 1
            ],
            [
                'name_ar' => 'كهرباء',
                'name_en' => 'electricity',
                'activity_type_id' => 1
            ],
            [
                'name_ar' => 'الهيكل الخارجي',
                'name_en' => 'external structure',
                'activity_type_id' => 1
            ],
            [
                'name_ar' => 'الهيكل الداخلي',
                'name_en' => 'internal structure',
                'activity_type_id' => 1
            ],
            [
                'name_ar' => 'مكيانيكا',
                'name_en' => 'mechanics',
                'activity_type_id' => 2
            ],
            [
                'name_ar' => 'كهرباء',
                'name_en' => 'electricity',
                'activity_type_id' => 2
            ],
            [
                'name_ar' => 'الهيكل الخارجي',
                'name_en' => 'external structure',
                'activity_type_id' => 2
            ],
            [
                'name_ar' => 'الهيكل الداخلي',
                'name_en' => 'internal structure',
                'activity_type_id' => 2
            ],


        ]);
    }
}
