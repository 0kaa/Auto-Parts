<?php

namespace Database\Seeders;

use App\Models\ActivityType;
use App\Models\Attribute;
use App\Models\SubActivity;
use Illuminate\Support\Str;
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
                'name_ar' => 'الجنوط',
                'name_en' => 'wheels',
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

        $actiivties = ActivityType::where('type', 1)->get();
        $actiivties_2 = ActivityType::where('id', 4)->get();
        $actiivties_3 = ActivityType::where('id', 5)->get();
        $actiivties_4 = ActivityType::where('id', 6)->get();

        $subactivities_ar = [
            'مكيانيكا',
            'كهرباء',
            'الهيكل الخارجي',
            'الهيكل الداخلي'

        ];

        $subactivities_en = [
            'mechanical',
            'electric',
            'external',
            'internal'
        ];


        foreach ($actiivties as $activity) {

            foreach ($subactivities_ar as $key => $subactivity_ar) {

                SubActivity::create([
                    'name_ar'   => $subactivity_ar,
                    'name_en'   => $subactivities_en[$key],

                    'activity_type_id' => $activity->id,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }
        }

        $subactivities_2_ar = [
            'سيارات',
            'شاحنات',
            'معدات زراعية',
            'معدات صناعية',

        ];

        $subactivities_2_en = [
            'cars',
            'trucks',
            'agricultural',
            'industrial'
        ];


        foreach ($actiivties_2 as $activity) {

            foreach ($subactivities_2_ar as $key => $subactivity_ar) {

                SubActivity::create([
                    'name_ar'   => $subactivity_ar,
                    'name_en'   => $subactivities_2_en[$key],
                    'activity_type_id' => $activity->id,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }
        }

        $subactivities_3_ar = [
            'سيارات',
            'شاحنات',
            'معدات زراعية',
            'معدات صناعية',

        ];

        $subactivities_3_en = [
            'cars',
            'trucks',
            'agricultural',
            'industrial'
        ];

        foreach ($actiivties_3 as $activity) {

            foreach ($subactivities_3_ar as $key => $subactivity_ar) {

                SubActivity::create([
                    'name_ar'   => $subactivity_ar,
                    'name_en'   => $subactivities_3_en[$key],
                    'activity_type_id' => $activity->id,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }
        }


        $subactivities_4_ar = [
            'زيوت',
            'فلاتر',
            'معالجات',
            'منظفات ميكانيكية',
            'الرديتر',
        ];

        $subactivities_4_en = [
            'oils',
            'filters',
            'machines',
            'mechanical cleaners',
            'rear',
        ];

        foreach ($actiivties_4 as $activity) {

            foreach ($subactivities_4_ar as $key => $subactivity_ar) {

                $parentAttribute = SubActivity::create([
                    'name_ar'   => $subactivity_ar,
                    'name_en'   => $subactivities_4_en[$key],
                    'activity_type_id' => $activity->id,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);

                if ($parentAttribute->slug == 'oils') {
                    $subactivities_5_ar = [
                        'زيت المحرك',
                        'زيت القير',
                        'زيت الدفرنس',
                        'زيت الفرامل',
                        'زيت دركسون',
                        'غير ذلك',
                    ];

                    $subactivities_5_en = [
                        'engine oil',
                        'bituminous oil',
                        'Differential oil',
                        'brake fluid',
                        'derrickson oil',
                        'other',
                    ];


                    foreach ($subactivities_5_ar as $key => $subactivity_ar) {
                        SubActivity::create([
                            'name_ar'   => $subactivity_ar,
                            'name_en'   => $subactivities_5_en[$key],
                            'type'      => 'main_oil',
                            'parent_id' => $parentAttribute->id,
                            'activity_type_id' => $activity->id,
                            'created_at' => now(),
                            'updated_at' => now(),
                        ]);
                    }
                } elseif ($parentAttribute->slug == 'filters') {
                    $subactivities_5_ar = [
                        'فلتر زيت محرك',
                        'فلتر زيت قير',
                        'فلتر بنزين',
                        'فلتر ديزل',
                        'فلتر هواء مكينة',
                        'فلتر هواء مكيف',
                        'غير ذلك',
                    ];

                    $subactivities_5_en = [
                        'engine oil filter',
                        'coolant oil filter',
                        'petrol filter',
                        'diesel filter',
                        'machine air filter',
                        'air conditioner filter',
                        'other',
                    ];


                    foreach ($subactivities_5_ar as $key => $subactivity_ar) {
                        SubActivity::create([
                            'name_ar'   => $subactivity_ar,
                            'name_en'   => $subactivities_5_en[$key],
                            'type'      => 'main_filter',
                            'parent_id' => $parentAttribute->id,
                            'activity_type_id' => $activity->id,
                            'created_at' => now(),
                            'updated_at' => now(),
                        ]);
                    }
                } elseif ($parentAttribute->slug == 'machines') {
                    $subactivities_5_ar = [
                        'معالج مكينة',
                        'معالج قير',
                        'معالج دفرنس',
                        'معالج دركسون',
                        'غير ذلك',

                    ];

                    $subactivities_5_en = [
                        'machine processor',
                        'gear processor',
                        'Difference Wizard',
                        'Drakeson Wizard',
                        'other',
                    ];


                    foreach ($subactivities_5_ar as $key => $subactivity_ar) {
                        SubActivity::create([
                            'name_ar'   => $subactivity_ar,
                            'name_en'   => $subactivities_5_en[$key],
                            'type'      => 'main_machines',
                            'parent_id' => $parentAttribute->id,
                            'activity_type_id' => $activity->id,
                            'created_at' => now(),
                            'updated_at' => now(),
                        ]);
                    }
                } elseif ($parentAttribute->slug == 'mechanical-cleaners') {
                    $mechanical_ar = [
                        'بخاخات',
                        'ثروتل',
                        'الكترونيات',
                        'ثلاجة مكيف',
                        'غير ذلك',

                    ];

                    $mechanical_en = [
                        'wrenches',
                        'screwdrivers',
                        'electronics',
                        'air-conditioning',
                        'other',
                    ];


                    foreach ($mechanical_ar as $key => $subactivity_ar) {
                        SubActivity::create([
                            'name_ar'   => $subactivity_ar,
                            'name_en'   => $mechanical_en[$key],
                            'type'      => 'main_mechanical_cleaners',
                            'parent_id' => $parentAttribute->id,
                            'activity_type_id' => $activity->id,
                            'created_at' => now(),
                            'updated_at' => now(),
                        ]);
                    }
                } elseif ($parentAttribute->slug == 'rear') {
                    $rear_ar = [
                        'ماء الرديتر',
                        'مانع تسريب',
                        'منظف الرديتر',
                        'كولنت',
                        'غير ذلك',
                    ];

                    $rear_en = [
                        'radiator water',
                        'Sealant',
                        'radiator cleaner',
                        'Colent',
                        'other',
                    ];


                    foreach ($rear_ar as $key => $subactivity_ar) {
                        SubActivity::create([
                            'name_ar'   => $subactivity_ar,
                            'name_en'   => $rear_en[$key],
                            'type'      => 'main_rear',
                            'parent_id' => $parentAttribute->id,
                            'activity_type_id' => $activity->id,
                            'created_at' => now(),
                            'updated_at' => now(),
                        ]);
                    }
                }
            }
        }


        $sub_activity = SubActivity::all();

        /***************************************** Attributes for mechanical for new spare parts ****************************************** */
        $attribute_mechanical_ar = [
            'درجة الصناعة',
            'عدد اسطوانات المحرك',
            'الاضافات من الوكالة',
            'نوع القير',
            'كم غيار للقير',
            'نوع وقود السيارة',
            'حجم المكينة'
        ];
        $attribute_mechanical_en = [
            'production grade',
            'number of cylinders',
            'additions from the company',
            'type of crank',
            'number of cranks',
            'fuel type',
            'size of the machine'
        ];
        $attribute_mechanical_options_ar = [
            [
                'type' => "select",
                'options' => [
                    'وكالة',
                    'درجة اولي',
                    'درجة ثانية'
                ]
            ],
            [
                'type' => 'select',
                'options' => [
                    'v4', 'v6', 'v8', 'v10', 'v12'
                ]
            ],
            [
                'type' => 'select',
                'options' => [
                    'تيربو',
                    'توين تيربو',
                    'سوبر',
                    'غير ذلك',
                    'لا يوجد إضافات'
                ]
            ],
            [
                'type' => 'select',
                'options' => [
                    'قير عادي',
                    'قير اوتوماتيك',
                ]
            ],
            [
                'type' => 'select',
                'options' => [
                    '4',
                    '6',
                    '8',
                    '10',
                    '12',
                ]
            ],
            [
                'type' => 'select',
                'options' => [
                    'بنزين',
                    'ديزل',
                    'هجين',
                    'كهرب'
                ]
            ],
            ['type' => 'text'],

        ];

        $attribute_mechanical_options_en = [
            [
                'type' => "select",
                'options' => [
                    'company',
                    'first grade',
                    'second grade'
                ]
            ],
            [
                'type' => 'select',
                'options' => [
                    'v4', 'v6', 'v8', 'v10', 'v12'
                ]
            ],
            [
                'type' => 'select',
                'options' => [
                    'turbine',
                    'turbo-turbine',
                    'super',
                    'other',
                    'no additions'
                ]
            ],
            [
                'type' => 'select',
                'options' => [
                    'normal crank',
                    'automated crank',
                ]
            ],
            [
                'type' => 'select',
                'options' => [
                    '4',
                    '6',
                    '8',
                    '10',
                    '12',
                ]
            ],
            [
                'type' => 'select',
                'options' => [
                    'fuel',
                    'diesel',
                    'hybrid',
                    'electric'
                ]
            ],
            ['type' => 'text'],
        ];

        /***************************************** Attributes for electric for new spare parts ****************************************** */
        $attribute_electric_ar = [
            'درجة الصناعة',
            'عدد اسطوانات المحرك',
            'الاضافات من الوكالة',
            'نوع القير',
            'كم غيار للقير',
            'نوع وقود السيارة',
            'حجم المكينة'
        ];
        $attribute_electric_en = [
            'production grade',
            'number of cylinders',
            'additions from the company',
            'type of crank',
            'number of cranks',
            'fuel type',
            'size of the machine'
        ];
        $attribute_electric_options_ar = [
            [
                'type' => 'select',
                'options' => [
                    'وكالة',
                    'درجة اولي',
                    'درجة ثانية'
                ]
            ],
            [
                'type' => 'select',
                'options' => [
                    'v4', 'v6', 'v8', 'v10', 'v12'
                ]
            ],
            [
                'type' => 'select',
                'options' => [
                    'تيربو',
                    'توين تيربو',
                    'سوبر',
                    'غير ذلك',
                    'لا يوجد إضافات'
                ]
            ],
            [
                'type' => 'select',
                'options' => [
                    'قير عادي',
                    'قير اوتوماتيك',
                ]
            ],
            [
                'type' => 'select',
                'options' => [
                    '4',
                    '6',
                    '8',
                    '10',
                    '12',
                ]
            ],
            [
                'type' => 'select',
                'options' => [
                    'fuel',
                    'diesel',
                    'hybrid',
                    'electric'
                ]
            ],
            ['type' => 'text'],
        ];

        $attribute_electric_options_en = [
            [
                'type' => "select",
                'options' => [
                    'company',
                    'first grade',
                    'second grade'
                ]
            ],
            [
                'type' => 'select',
                'options' => [
                    'v4', 'v6', 'v8', 'v10', 'v12'
                ]
            ],
            [
                'type' => 'select',
                'options' => [
                    'turbine',
                    'turbo-turbine',
                    'super',
                    'other',
                    'no additions'
                ]
            ],
            [
                'type' => 'select',
                'options' => [
                    'normal crank',
                    'automated crank',
                ]
            ],
            [
                'type' => 'select',
                'options' => [
                    '4',
                    '6',
                    '8',
                    '10',
                    '12',
                ]
            ],
            [
                'type' => 'select',
                'options' => [
                    'fuel',
                    'diesel',
                    'hybrid',
                    'electric'
                ]
            ],
            ['type' => 'text'],
        ];

        /***************************************** Attributes for mechanical_1 for repair spare parts ****************************************** */
        $attribute_mechanical_1_ar = [
            'مع ملحقات كاملة ان وجدة',
            'درجة الصناعة',
            'عدد اسطوانات المحرك',
            'الاضافات من الوكالة',
            'نوع القير',
            'كم غيار للقير',
            'نوع وقود السيارة',
            'حجم الماكينه',
        ];
        $attribute_mechanical_1_en = [
            'with complete accessories',
            'production grade',
            'number of cylinders',
            'size of the car',
            'type of crank',
            'number of cranks',
            'fuel type',
            'size of the machine',
        ];
        $attribute_mechanical_1_options_ar = [
            [
                'type' => 'select',
                'options' => [
                    'نعم',
                    'لا',
                ]
            ],
            [
                'type' => 'select',
                'options' => [
                    'وكالة',
                    'درجة اولي',
                    'درجة ثانية'
                ]
            ],
            [
                'type' => 'select',
                'options' => [
                    'v4', 'v6', 'v8', 'v10', 'v12'
                ]
            ],
            [
                'type' => 'select',
                'options' => [
                    'تيربو',
                    'توين تيربو',
                    'سوبر',
                    'غير ذلك',
                    'لا يوجد إضافات'
                ]
            ],
            [
                'type' => 'select',
                'options' => [
                    'قير عادي',
                    'قير اوتوماتيك',
                ]
            ],
            [
                'type' => 'select',
                'options' => [
                    '4',
                    '6',
                    '8',
                    '10',
                    '12',
                ]
            ],
            [
                'type' => 'select',
                'options' => [
                    'بنزين',
                    'ديزل',
                    'هجين',
                    'كهرب'
                ]
            ],
            [
                'type' => 'select',
                'options' => [
                    '1.6',
                    '2.4',
                    '6.0'
                ]
            ],


        ];

        $attribute_mechanical_1_options_en = [
            [
                'type' => "select",
                'options' => [
                    'yes',
                    'no',
                ]
            ],
            [
                'type' => 'select',
                'options' => [
                    'company',
                    'first grade',
                    'second grade'
                ]
            ],
            [
                'type' => 'select',
                'options' => [
                    'v4', 'v6', 'v8', 'v10', 'v12'
                ]
            ],
            [
                'type' => 'select',
                'options' => [
                    'turbine',
                    'turbo-turbine',
                    'super',
                    'other',
                    'no additions'
                ]
            ],
            [
                'type' => 'select',
                'options' => [
                    'normal crank',
                    'automated crank',
                ]
            ],
            [
                'type' => 'select',
                'options' => [
                    '4',
                    '6',
                    '8',
                    '10',
                    '12',
                ]
            ],
            [
                'type' => 'select',
                'options' => [
                    'fuel',
                    'diesel',
                    'hybrid',
                    'electric'
                ]
            ],
            [
                'type' => 'select',
                'options' => [
                    '1.6',
                    '2.4',
                    '6.0'
                ]
            ],
        ];

        /***************************************** Attributes for electric_1 for repair spare parts ****************************************** */

        $attribute_electric_1_ar = [
            'مع ملحقات كاملة ان وجدة',
            'درجة الصناعة',
            'عدد اسطوانات المحرك',
            'الاضافات من الوكالة',
            'نوع القير',
            'كم غيار للقير',
            'نوع وقود السيارة',
            'حجم المكينة'
        ];
        $attribute_electric_1_en = [
            'with complete accessories',
            'production grade',
            'number of cylinders',
            'size of the car',
            'type of crank',
            'number of cranks',
            'fuel type',
            'size of the machine',
        ];
        $attribute_electric_1_options_ar = [
            [
                'type' => 'select',
                'options' => [
                    'نعم',
                    'لا',
                ]
            ],
            [
                'type' => 'select',
                'options' => [
                    'وكالة',
                    'درجة اولي',
                    'درجة ثانية'
                ]
            ],
            [
                'type' => 'select',
                'options' => [
                    'v4', 'v6', 'v8', 'v10', 'v12'
                ]
            ],
            [
                'type' => 'select',
                'options' => [
                    'تيربو',
                    'توين تيربو',
                    'سوبر',
                    'غير ذلك',
                    'لا يوجد إضافات'
                ]
            ],
            [
                'type' => 'select',
                'options' => [
                    'قير عادي',
                    'قير اوتوماتيك',
                ]
            ],
            [
                'type' => 'select',
                'options' => [
                    '4',
                    '6',
                    '8',
                    '10',
                    '12',
                ]
            ],
            [
                'type' => 'select',
                'options' => [
                    'بنزين',
                    'ديزل',
                    'هجين',
                    'كهرب'
                ]
            ],
            [
                'type' => 'text',
            ],
        ];

        $attribute_electric_1_options_en = [
            [
                'type' => "select",
                'options' => [
                    'yes',
                    'no',
                ]
            ],
            [
                'type' => 'select',
                'options' => [
                    'company',
                    'first grade',
                    'second grade'
                ]
            ],
            [
                'type' => 'select',
                'options' => [
                    'v4', 'v6', 'v8', 'v10', 'v12'
                ]
            ],
            [
                'type' => 'select',
                'options' => [
                    'turbine',
                    'turbo-turbine',
                    'super',
                    'other',
                    'no additions'
                ]
            ],
            [
                'type' => 'select',
                'options' => [
                    'normal crank',
                    'automated crank',
                ]
            ],
            [
                'type' => 'select',
                'options' => [
                    '4',
                    '6',
                    '8',
                    '10',
                    '12',
                ]
            ],
            [
                'type' => 'select',
                'options' => [
                    'fuel',
                    'diesel',
                    'hybrid',
                    'electric'
                ]
            ],
            [
                'type' => 'text',
            ],
        ];

        /***************************************** Attributes for external_1 for repair spare parts ****************************************** */

        $attribute_external_1_ar = [
            'لون القطعة',
            'مع ملحقات كاملة ان وجدة',
            'هل تقبل وجود رش بالقطعة',
            'هل تقبل وجود بهتان باللون',
            'هل تقبل وجود طعجة او نهره في القطعة'
        ];
        $attribute_external_1_en = [
            'color of the piece',
            'with complete accessories',
            'with rain cover',
            'with hood',
            'with rain drain'
        ];
        $attribute_external_1_options_ar = [
            [
                "type" => 'select',
                'options'   => [
                    'ابيض ثلجي',
                    'ابيض لؤلؤي',
                    'اسود',
                    'فضي',
                    'الرمادي',
                    'ازرق',
                    'كحلي',
                    'البني',
                    'الذهبي',
                    'احمر',
                    'اصفر',
                    'أخضر',
                    'غير ذلك',
                ]

            ],
            [
                'type' => 'select',
                'options' => [
                    'نعم',
                    'لا',
                ]
            ],
            [
                'type' => 'select',
                'options' => [
                    'نعم',
                    'لا',
                ]
            ],
            [
                'type' => 'select',
                'options' => [
                    'نعم',
                    'لا',
                ]
            ], [
                'type' => 'select',
                'options' => [
                    'نعم',
                    'لا',
                ]
            ],
        ];

        $attribute_external_1_options_en = [
            [
                "type" => 'select',
                'options'   => [
                    'white',
                    'yellow',
                    'black',
                    'grey',
                    'brown',
                    'red',
                    'orange',
                    'yellow',
                    'green',
                    'gold',
                    'silver',
                    'blue',
                    'other',
                ]

            ],
            [
                'type' => 'select',
                'options' => [
                    'yes',
                    'no',
                ]
            ],
            [
                'type' => 'select',
                'options' => [
                    'yes',
                    'no',
                ]
            ],
            [
                'type' => 'select',
                'options' => [
                    'yes',
                    'no',
                ]
            ],
            [
                'type' => 'select',
                'options' => [
                    'yes',
                    'no',
                ]
            ],
        ];

        /***************************************** Attributes for internal_1 for repair spare parts ****************************************** */

        $attribute_internal_1_ar = [
            'لون القطعة',
            'نوع الخامة الداخلية',
            'مع ملحقات كاملة ان وجدة',
            'هل تقبل وجود بهتان باللون',
            'هل تقبل وجود بهتان باللون',
        ];
        $attribute_internal_1_en = [
            'color of the piece',
            'Inner material type',
            'With complete accessories if available',
            'Do you accept the presence of color fading',
            'Do you accept the presence of color fading',
        ];
        $attribute_internal_1_options_ar = [
            [
                'type' => 'select',
                'options' => [
                    'بيج',
                    'أحمر ',
                    'أسود ',
                    'اوف وايت',
                    'رصاصي فاتح',
                    'رصاصي غامق',
                    'أحمر مقلم بأسود',
                    'غير ذلك',
                ]
            ],
            [
                'type' => 'select',
                'options' => [
                    'مخمل',
                    'جلد',
                    'شمواه',
                    'غير ذلك'
                ]
            ],
            [
                'type' => 'select',
                'options' => [
                    'نعم',
                    'لا',
                ]
            ],
            [
                'type' => 'select',
                'options' => [
                    'نعم',
                    'لا',
                ]
            ],
            ['type' => 'text']
        ];

        $attribute_internal_1_options_en = [
            [
                'type' => 'select',
                'options' => [
                    'beige',
                    'red',
                    'black ',
                    'Off White',
                    'light lead',
                    'dark lead',
                    'Red with black stripes',
                    'Other',
                ]
            ],
            [
                'type' => 'select',
                'options' => [
                    'velvet',
                    'leather',
                    'suede',
                    'Other'
                ]
            ],
            [
                'type' => 'select',
                'options' => [
                    'yes',
                    'no',
                ]
            ],
            [
                'type' => 'select',
                'options' => [
                    'yes',
                    'no',
                ]
            ],
            ['type' => 'text']
        ];

        /***************************************** Attributes for cars for tires ****************************************** */

        $attribute_cars_ar = [
            'هل تريد إطارات مماثلة لإطارات مركبتك ؟',
            'عرض الكفر',
            'ارتفاع الكفر',
            'مقاس الجنط',
            'البلد المصنعة للكفر المطلوب',
            'اسم الشركة المصنعة للكفرات',
            'سنة الصنع للكفر',
            'صورة الكفر',
        ];
        $attribute_cars_en = [
            'Do you want similar tires for your car ?',
            'Tire width',
            'Tire height',
            'Tire size',
            'Country of origin of the tire required',
            'Name of the company that manufactures the tires',
            'Year of manufacture of the tire',
            'Tire image',
        ];
        $attribute_cars_options_ar = [
            [
                'type' => 'select',
                'options' => [
                    'نعم',
                    'لا',
                ]
            ],
            [
                'type' => 'range',
                'min' => 155,
                'max' => 315,
                'step' => 5,
            ],
            [
                'type' => 'range',
                'min' => 65,
                'max' => 95,
                'step' => 5,
            ],
            [
                'type' => 'range',
                'min' => 13,
                'max' => 22,
                'step' => 1,
            ],
            ['type' => 'text'],
            ['type' => 'text'],
            [
                'type' => 'select',
                'options' => [
                    'السنة الحالية',
                    'السنة السابقة',
                ]
            ],
            [
                'type' => 'file'
            ],

        ];

        $attribute_cars_options_en = [
            [
                'type' => 'select',
                'options' => [
                    'yes',
                    'no',
                ]
            ],
            [
                'type' => 'range',
                'min' => 155,
                'max' => 315,
                'step' => 5,
            ],
            [
                'type' => 'range',
                'min' => 65,
                'max' => 95,
                'step' => 5,
            ],
            [
                'type' => 'range',
                'min' => 13,
                'max' => 22,
                'step' => 1,
            ],
            ['type' => 'text'],
            ['type' => 'text'],
            [
                'type' => 'select',
                'options' => [
                    'current year',
                    'previous year',
                ]
            ],
            [
                'type' => 'file'
            ],


        ];

        /***************************************** Attributes for trucks for tires ****************************************** */

        $attribute_trucks_ar = [
            'هل تريد إطارات مماثلة لإطارات مركبتك ؟',
            'مقاس الكفر',
            'البلد المصنعة للكفر المطلوب',
            'اسم الشركة المصنعة للكفرات',
            'سنة الصنع للكفر',
            'صورة الكفر',
            'كم غاط ؟',
        ];
        $attribute_trucks_en = [
            'Do you want similar tires for your car ?',
            'Tire size',
            'Country of origin of the tire required',
            'Name of the company that manufactures the tires',
            'Year of manufacture of the tire',
            'Tire image',
            'How many wheels ?',
        ];
        $attribute_trucks_options_ar = [
            [
                'type' => 'select',
                'options' => [
                    'نعم',
                    'لا',
                ]
            ],
            [
                'type' => 'select',
                'options' => [
                    '10R22.5',
                    '1400R20',
                    '1200R20 ',
                    '1100R20 ',
                    '1000R20 ',
                    '900R20 ',
                    '825R20',
                    '385/65R22.5',
                    '315/70R22.5',
                    '315/80R22.5',
                    '13R22.5',
                    '12R22.5',
                    '11R22.5',
                    '1200R24',
                    'غير ذلك',
                ]
            ],
            ['type' => 'text'],
            ['type' => 'text'],
            [
                'type' => 'select',
                'options' => [
                    'السنة الحالية',
                    'السنة السابقة',
                ]
            ],
            ['type' => 'file'],
            [
                'type' => 'select',
                'options' => [
                    '12',
                    '14',
                    '16',
                    '18',
                    '20',
                    'غير ذلك',
                ]

            ]

        ];
        $attribute_trucks_options_en = [
            [
                'type' => 'select',
                'options' => [
                    'yes',
                    'no',
                ]
            ],
            [
                'type' => 'select',
                'options' => [
                    '10R22.5',
                    '1400R20',
                    '1200R20 ',
                    '1100R20 ',
                    '1000R20 ',
                    '900R20 ',
                    '825R20',
                    '385/65R22.5',
                    '315/70R22.5',
                    '315/80R22.5',
                    '13R22.5',
                    '12R22.5',
                    '11R22.5',
                    '1200R24',
                    'other',
                ]
            ],
            ['type' => 'text'],
            ['type' => 'text'],
            [
                'type' => 'select',
                'options' => [
                    'current year',
                    'previous year',
                ]
            ],
            ['type' => 'file'],
            [
                'type' => 'select',
                'options' => [
                    '12',
                    '14',
                    '16',
                    '18',
                    '20',
                    'other',
                ]

            ]


        ];

        /***************************************** Attributes for agricultural for tires ****************************************** */

        $attribute_agricultural_ar = [
            'هل تريد إطارات مماثلة لإطارات مركبتك ؟',
            'مقاس الكفر',
            'البلد المصنعة للكفر المطلوب',
            'اسم الشركة المصنعة للكفرات',
            'سنة الصنع للكفر',
            'صورة الكفر',
            'كم غاط ؟',
        ];
        $attribute_agricultural_en = [
            'Do you want similar tires for your car ?',
            'Tire size',
            'Country of origin of the tire required',
            'Name of the company that manufactures the tires',
            'Year of manufacture of the tire',
            'Tire image',
            'How many wheels ?',
        ];
        $attribute_agricultural_options_ar = [
            [
                'type' => 'select',
                'options' => [
                    'نعم',
                    'لا',
                ]
            ],
            [

                'type' => 'select',
                'options' => [
                    '14.9/28',
                    '13.6/28',
                    '12.4/28',
                    '14.9/24',
                    '750/18',
                    '1110/16',
                    '20.8/38',
                    '13.6/38',
                    '18.4/34',
                    '16.9/34',
                    '18.4/30',
                    'غير ذلك',
                ]
            ],
            ['type' => 'text'],
            ['type' => 'text'],
            [
                'type' => 'select',
                'options' => [
                    'السنة الحالية',
                    'السنة السابقة',
                ]
            ],
            ['type' => 'file'],
            [
                'type' => 'select',
                'options' => [
                    '6',
                    '8',
                    '10',
                    '12',
                    '14',
                    'غير ذلك',
                ]
            ]

        ];

        $attribute_agricultural_options_en = [
            [
                'type' => 'select',
                'options' => [
                    'yes',
                    'no',
                ]
            ],
            [
                'type' => 'select',
                'options' => [
                    '14.9/28',
                    '13.6/28',
                    '12.4/28',
                    '14.9/24',
                    '750/18',
                    '1110/16',
                    '20.8/38',
                    '13.6/38',
                    '18.4/34',
                    '16.9/34',
                    '18.4/30',
                    'other',
                ]
            ],
            ['type' => 'text'],
            ['type' => 'text'],
            [
                'type' => 'select',
                'options' => [
                    'current year',
                    'previous year',
                ]
            ],
            ['type' => 'file'],
            [
                'type' => 'select',
                'options' => [
                    '6',
                    '8',
                    '10',
                    '12',
                    '14',
                    'other',
                ]
            ]

        ];

        /***************************************** Attributes for industrial for tires ****************************************** */

        $attribute_industrial_ar = [
            'هل تريد إطارات مماثلة لإطارات مركبتك ؟',
            'مقاس الكفر',
            'البلد المصنعة للكفر المطلوب',
            'اسم الشركة المصنعة للكفرات',
            'سنة الصنع للكفر',
            'صورة الكفر',
            'كم غاط ؟',
        ];
        $attribute_industrial_en = [
            'Do you want similar tires for your car ?',
            'Tire size',
            'Country of origin of the tire required',
            'Name of the company that manufactures the tires',
            'Year of manufacture of the tire',
            'Tire image',
            'How many wheels ?',
        ];
        $attribute_industrial_options_ar = [
            [
                'type' => 'select',
                'options' => [
                    'نعم',
                    'لا',
                ]
            ],
            [
                'type' => 'select',
                'options' => [
                    '23.5R25',
                    '20.5R25',
                    '17.5R25',
                    '15.5R25',
                    '1600R24',
                    '1400R24',
                    '29.5R25',
                    '26.5R25',
                    'غير ذلك',
                ]

            ],
            ['type' => 'text'],
            ['type' => 'text'],
            [
                'type' => 'select',
                'options' => [
                    'السنة الحالية',
                    'السنة السابقة',
                ]
            ],
            ['type' => 'file'],
            [
                'type' => 'select',
                'options' => [
                    '16',
                    '20',
                    '24',
                    '28',
                    'غير ذلك',
                ]
            ]

        ];

        $attribute_industrial_options_en = [
            [
                'type' => 'select',
                'options' => [
                    'yes',
                    'no',
                ]
            ],
            [
                'type' => 'select',
                'options' => [
                    '23.5R25',
                    '20.5R25',
                    '17.5R25',
                    '15.5R25',
                    '1600R24',
                    '1400R24',
                    '29.5R25',
                    '26.5R25',
                    'other',
                ]
            ],
            ['type' => 'text'],
            ['type' => 'text'],
            [
                'type' => 'select',
                'options' => [
                    'current year',
                    'previous year',
                ]
            ],
            ['type' => 'file'],
            [
                'type' => 'select',
                'options' => [
                    '16',
                    '20',
                    '24',
                    '28',
                    'other',
                ]
            ]
        ];

        /***************************************** Attributes for cars_1 for wheels ****************************************** */

        $attribute_cars_1_ar = [
            'هل تريد إطارات مماثلة لإطارات مركبتك ؟',
            'مقاس الجنوط',
            'اسم الشركة المصنعة للجنوط',
            'نوع الجنوط',
            'كم تحتاج جنط ؟',
            'هل تحتاج صواميل ؟',
            'عدد الصواميل',
            'صورة الكفر',

        ];
        $attribute_cars_1_en = [
            'Do you want similar tires for your car ?',
            'Wheel size',
            'Name of the company that manufactures the tires',
            'Type of wheels',
            'How many wheels do you need ?',
            'Do you need spares ?',
            'How many spares do you need ?',
            'Wheel image',
        ];
        $attribute_cars_1_options_ar = [
            [
                'type' => 'select',
                'options' => [
                    'نعم',
                    'لا',
                ]
            ],
            [
                'type' => 'range',
                'min' => 13,
                'max' => 22,
                'step' => 1,
            ],
            ['type' => 'text'],
            [
                'type' => 'select',
                'options' => [
                    'حديد',
                    'كروم',
                ]
            ],
            ['type' => 'text'],
            [
                'type' => 'select',
                'options' => [
                    'نعم',
                    'لا',
                ]
            ],
            ['type' => 'text'],
            ['type' => 'file'],

        ];
        $attribute_cars_1_options_en = [
            [
                'type' => 'select',
                'options' => [
                    'yes',
                    'no',
                ]
            ],
            [
                'type' => 'range',
                'min' => 13,
                'max' => 22,
                'step' => 1,
            ],
            ['type' => 'text'],
            [
                'type' => 'select',
                'options' => [
                    'alloy',
                    'carbon',
                ]
            ],
            ['type' => 'text'],
            [
                'type' => 'select',
                'options' => [
                    'yes',
                    'no',
                ]
            ],
            ['type' => 'text'],
            ['type' => 'file'],
        ];
        /***************************************** Attributes for trucks_1 for wheels ****************************************** */

        $attribute_trucks_1_ar = [
            'هل تريد إطارات مماثلة لإطارات مركبتك ؟',
            'مقاس الجنوط',
            'اسم الشركة المصنعة للجنوط',
            'نوع الجنوط',
            'كم تحتاج جنط ؟',
            'هل تحتاج صواميل ؟',
            'عدد الصواميل',
            'صورة الكفر',

        ];
        $attribute_trucks_1_en = [
            'Do you want similar tires for your car ?',
            'Wheel size',
            'Name of the company that manufactures the tires',
            'Type of wheels',
            'How many wheels do you need ?',
            'Do you need spares ?',
            'How many spares do you need ?',
            'Wheel image',
        ];
        $attribute_trucks_1_options_ar = [
            [
                'type' => 'select',
                'options' => [
                    'نعم',
                    'لا',
                ]
            ],
            [
                'type' => 'range',
                'min' => 19,
                'max' => 29,
                'step' => 1,
            ],
            ['type' => 'text'],
            [
                'type' => 'select',
                'options' => [
                    'حديد',
                    'كروم',
                ]
            ],
            ['type' => 'text'],
            [
                'type' => 'select',
                'options' => [
                    'نعم',
                    'لا',
                ]
            ],
            ['type' => 'text'],
            ['type' => 'file'],

        ];
        $attribute_trucks_1_options_en = [
            [
                'type' => 'select',
                'options' => [
                    'yes',
                    'no',
                ]
            ],
            [
                'type' => 'range',
                'min' => 19,
                'max' => 29,
                'step' => 1,
            ],
            ['type' => 'text'],
            [
                'type' => 'select',
                'options' => [
                    'alloy',
                    'carbon',
                ]
            ],
            ['type' => 'text'],
            [
                'type' => 'select',
                'options' => [
                    'yes',
                    'no',
                ]
            ],
            ['type' => 'text'],
            ['type' => 'file'],
        ];
        /***************************************** Attributes for agricultural_1 for wheels ****************************************** */

        $attribute_agricultural_1_ar = [
            'هل تريد إطارات مماثلة لإطارات مركبتك ؟',
            'مقاس الجنوط',
            'اسم الشركة المصنعة للجنوط',
            'نوع الجنوط',
            'كم تحتاج جنط ؟',
            'هل تحتاج صواميل ؟',
            'عدد الصواميل',
            'صورة الكفر',

        ];
        $attribute_agricultural_1_en = [
            'Do you want similar tires for your car ?',
            'Wheel size',
            'Name of the company that manufactures the tires',
            'Type of wheels',
            'How many wheels do you need ?',
            'Do you need spares ?',
            'How many spares do you need ?',
            'Wheel image',
        ];
        $attribute_agricultural_1_options_ar = [
            [
                'type' => 'select',
                'options' => [
                    'نعم',
                    'لا',
                ]
            ],
            [
                'type' => 'range',
                'min' => 19,
                'max' => 29,
                'step' => 1,
            ],
            ['type' => 'text'],
            [
                'type' => 'select',
                'options' => [
                    'حديد',
                    'كروم',
                ]
            ],
            ['type' => 'text'],
            [
                'type' => 'select',
                'options' => [
                    'نعم',
                    'لا',
                ]
            ],
            ['type' => 'text'],
            ['type' => 'file'],

        ];
        $attribute_agricultural_1_options_en = [
            [
                'type' => 'select',
                'options' => [
                    'yes',
                    'no',
                ]
            ],
            [
                'type' => 'range',
                'min' => 19,
                'max' => 29,
                'step' => 1,
            ],
            ['type' => 'text'],
            [
                'type' => 'select',
                'options' => [
                    'alloy',
                    'carbon',
                ]
            ],
            ['type' => 'text'],
            [
                'type' => 'select',
                'options' => [
                    'yes',
                    'no',
                ]
            ],
            ['type' => 'text'],
            ['type' => 'file'],
        ];
        /***************************************** Attributes for industrial_1 for wheels ****************************************** */

        $attribute_industrial_1_ar = [
            'هل تريد إطارات مماثلة لإطارات مركبتك ؟',
            'مقاس الجنوط',
            'اسم الشركة المصنعة للجنوط',
            'نوع الجنوط',
            'كم تحتاج جنط ؟',
            'هل تحتاج صواميل ؟',
            'عدد الصواميل',
            'صورة الكفر',

        ];
        $attribute_industrial_1_en = [
            'Do you want similar tires for your car ?',
            'Wheel size',
            'Name of the company that manufactures the tires',
            'Type of wheels',
            'How many wheels do you need ?',
            'Do you need spares ?',
            'How many spares do you need ?',
            'Wheel image',
        ];
        $attribute_industrial_1_options_ar = [
            [
                'type' => 'select',
                'options' => [
                    'نعم',
                    'لا',
                ]
            ],
            [
                'type' => 'range',
                'min' => 19,
                'max' => 29,
                'step' => 1,
            ],
            ['type' => 'text'],
            [
                'type' => 'select',
                'options' => [
                    'حديد',
                    'كروم',
                ]
            ],
            ['type' => 'text'],
            [
                'type' => 'select',
                'options' => [
                    'نعم',
                    'لا',
                ]
            ],
            ['type' => 'text'],
            ['type' => 'file'],

        ];
        $attribute_industrial_1_options_en = [
            [
                'type' => 'select',
                'options' => [
                    'yes',
                    'no',
                ]
            ],
            [
                'type' => 'range',
                'min' => 19,
                'max' => 29,
                'step' => 1,
            ],
            ['type' => 'text'],
            [
                'type' => 'select',
                'options' => [
                    'alloy',
                    'carbon',
                ]
            ],
            ['type' => 'text'],
            [
                'type' => 'select',
                'options' => [
                    'yes',
                    'no',
                ]
            ],
            ['type' => 'text'],
            ['type' => 'file'],
        ];

        /***************************************** Attributes for engine_oils for oils ****************************************** */

        $attribute_engine_oils_ar = [
            'عداد السيارة',
            'نوع وقود السيارة',
            'عدد اسطوانات المحرك',
            'حجم المكينة',
            'الإضافات علي السيارة',
            'لزوجة الزيت المطلوبة',
            'ادخل اسم الشركة المطلوبة ان وجدة',
            'حجم العلبة',
            'العدد المطلوب',
            'لزوجة الزيت السابق',
        ];
        $attribute_engine_oils_en = [
            'Car engine',
            'Car fuel type',
            'Number of cylinders',
            'Engine size',
            'Additional features on the car',
            'Required oil',
            'Enter the name of the company that you need',
            'Oil capacity',
            'Quantity',
            'Previous oil',
        ];
        $attribute_engine_oils_options_ar = [
            ['type' => 'text'],
            [
                'type' => 'select',
                'options' => [
                    'بنزين',
                    'ديزل'
                ]
            ],
            [
                'type' => 'select',
                'options' => [
                    'v3',
                    'v4',
                    'v6',
                    'v8',
                    'v10',
                    'v12',
                ]
            ],
            ['type' => 'text'],
            [
                'type' => 'select',
                'options' => [
                    'لا يوجد إضافات',
                    'تيربو',
                    'توين تيربو',
                    'سوبر',
                    'غير ذلك',
                ]
            ],
            [
                'type' => 'select',
                'options' => [
                    '10w-30',
                    '5w-50',
                    '5w-40',
                    '5w-30',
                    '5w-20',
                    '0w-40',
                    '0w-30',
                    '0w-20',
                    '20w-50',
                    '20w-40',
                    '15w-40',
                    '10w-60',
                    '10w-50',
                    '10w-40',
                ]
            ],
            ['type' => 'text'],
            [

                'type' => 'select',
                'options' => [
                    '0.946ml',
                    '1L',
                    '4L',
                    '5L',
                ]
            ],
            ['type' => 'text'],
            ['type' => 'text'],
        ];
        $attribute_engine_oils_options_en = [
            ['type' => 'text'],
            [
                'type' => 'select',
                'options' => [
                    'gasoline',
                    'diesel',
                ]
            ],
            [
                'type' => 'select',
                'options' => [
                    'v3',
                    'v4',
                    'v6',
                    'v8',
                    'v10',
                    'v12',
                ]
            ],
            ['type' => 'text'],
            [
                'type' => 'select',
                'options' => [
                    'no additional features',
                    'turbo',
                    'turbo-turbo',
                    'super',
                    'other',
                ]
            ],
            [
                'type' => 'select',
                'options' => [
                    '10w-30',
                    '5w-50',
                    '5w-40',
                    '5w-30',
                    '5w-20',
                    '0w-40',
                    '0w-30',
                    '0w-20',
                    '20w-50',
                    '20w-40',
                    '15w-40',
                    '10w-60',
                    '10w-50',
                    '10w-40',
                ]
            ],
            ['type' => 'text'],
            [

                'type' => 'select',
                'options' => [
                    '0.946ml',
                    '1L',
                    '4L',
                    '5L',
                ]
            ],
            ['type' => 'text'],
            ['type' => 'text'],
        ];

        /***************************************** Attributes for bituminous_oil for oils ****************************************** */

        $attribute_bituminous_oil_ar = [
            'عداد السيارة',
            'نوع القير',
            'لزوجة الزيت المطلوبة',
            'لزوجة الزيت المطلوبة',
            'كم غيار للقير',
            'ادخل اسم الشركة المطلوبة',
            'حجم العلبة',
            'العدد المطلوب',
            'هل تم تغير زيت القير مسبقا',
        ];
        $attribute_bituminous_oil_en = [
            'Car engine',
            'Coolant type',
            'Required oil',
            'Required oil',
            'Number of coolant',
            'Enter the name of the company that you need',
            'Oil capacity',
            'Quantity',
            'Has the coolant changed before',
        ];
        $attribute_bituminous_oil_options_ar = [
            ['type' => 'text'],

            [
                'type' => 'select',
                'options' => [
                    'اوتوماتيك',
                    'قير عادي',
                ]
            ],
            [
                'type' => 'select',
                'options' => [
                    '75w-80',
                    '75w-90',
                    '75w-140',
                    '80w-90',
                    '85w-90'
                ]
            ],
            [
                'type' => 'select',
                'options' => [
                    'ATF',
                    'CVT',
                    'DCT'
                ]
            ],
            [
                'type' => 'select',
                'options' => [
                    '4',
                    '6',
                    '8',
                    '10',
                    '12',
                ]

            ],
            ['type' => 'text'],
            [
                'type' => 'select',
                'options' => [
                    '0.946ml',
                    '1L',
                    '4L',
                    '5L'
                ]
            ],
            ['type' => 'text'],
            [
                'type' => 'select',
                'options' => [
                    'نعم',
                    'لا'
                ]
            ]

        ];

        $attribute_bituminous_oil_options_en = [
            ['type' => 'text'],

            [
                'type' => 'select',
                'options' => [
                    'automatic',
                    'regular',
                ]
            ],
            [
                'type' => 'select',
                'options' => [
                    '75w-80',
                    '75w-90',
                    '75w-140',
                    '80w-90',
                    '85w-90'
                ]
            ],
            [
                'type' => 'select',
                'options' => [
                    'ATF',
                    'CVT',
                    'DCT'
                ]
            ],
            [
                'type' => 'select',
                'options' => [
                    '4',
                    '6',
                    '8',
                    '10',
                    '12',
                ]

            ],
            ['type' => 'text'],
            [
                'type' => 'select',
                'options' => [
                    '0.946ml',
                    '1L',
                    '4L',
                    '5L'
                ]
            ],
            ['type' => 'text'],
            [
                'type' => 'select',
                'options' => [
                    'yes',
                    'no'
                ]
            ]
        ];
        /***************************************** Attributes for differential_oil for oils ****************************************** */

        $attribute_differential_oil_ar = [
            'عداد السيارة',
            'لزوجة الزيت المطلوبة',
            'ادخل اسم الشركة المطلوبة',
            'العدد المطلوب',
            'هل تم تغير زيت القير مسبقا',
        ];
        $attribute_differential_oil_en = [
            'Car engine',
            'Required oil',
            'Enter the name of the company that you need',
            'Quantity',
            'Has the coolant changed before',
        ];
        $attribute_differential_oil_options_ar = [
            ['type' => 'text'],
            [
                'type' => 'select',
                'options' => [
                    '75w-80',
                    '75w-90',
                    '75w-140',
                    '80w-90',
                    '85w-90'
                ]
            ],
            ['type' => 'text'],
            ['type' => 'text'],
            [
                'type' => 'select',
                'options' => [
                    'نعم',
                    'لا',
                ]
            ]

        ];
        $attribute_differential_oil_options_en = [
            ['type' => 'text'],
            [
                'type' => 'select',
                'options' => [
                    '75w-80',
                    '75w-90',
                    '75w-140',
                    '80w-90',
                    '85w-90'
                ]
            ],
            ['type' => 'text'],
            ['type' => 'text'],
            [
                'type' => 'select',
                'options' => [
                    'yes',
                    'no'
                ]
            ]
        ];
        /***************************************** Attributes for brake_fluid for oils ****************************************** */

        $attribute_brake_fluid_ar = [
            'نوع الزيت المطلوب',
            'ادخل اسم الشركة المطلوبة ان وجدة',
            'العدد المطلوب',
        ];
        $attribute_brake_fluid_en = [
            'Required oil',
            'Enter the name of the company that you need',
            'Quantity',
        ];
        $attribute_brake_fluid_options_ar = [
            [
                'type' => 'select',
                'options' => [
                    'DOT3',
                    'DOT4',
                    'DOT 5',
                    'DOT 5.1'
                ]
            ],
            ['type' => 'text'],
            ['type' => 'text'],
        ];
        $attribute_brake_fluid_options_en = [
            [
                'type' => 'select',
                'options' => [
                    'DOT3',
                    'DOT4',
                    'DOT 5',
                    'DOT 5.1'
                ]
            ],
            ['type' => 'text'],
            ['type' => 'text'],
        ];
        /***************************************** Attributes for derrickson_oil for oils ****************************************** */

        $attribute_derrickson_oil_ar = [
            'لزوجة الزيت المطلوبة',
            'ادخل اسم الشركة المطلوبة ان وجدة',
            'العدد المطلوب'
        ];
        $attribute_derrickson_oil_en = [
            'Required oil',
            'Enter the name of the company that you need',
            'Quantity'
        ];
        $attribute_derrickson_oil_options_ar = [
            ['type' => 'text'],
            ['type' => 'text'],
            ['type' => 'text'],
        ];

        $attribute_derrickson_oil_options_en = [
            ['type' => 'text'],
            ['type' => 'text'],
            ['type' => 'text'],
        ];
        /***************************************** Attributes for other for oils ****************************************** */

        $attribute_other_ar = [
            'لزوجة الزيت المطلوبة',
            'ادخل اسم الشركة المطلوبة ان وجدة',
            'العدد المطلوب'
        ];
        $attribute_other_en = [
            'Required oil',
            'Enter the name of the company that you need',
            'Quantity'
        ];
        $attribute_other_options_ar = [
            ['type' => 'text'],
            ['type' => 'text'],
            ['type' => 'text'],
        ];

        $attribute_other_options_en = [
            ['type' => 'text'],
            ['type' => 'text'],
            ['type' => 'text'],
        ];
        /***************************************** Attributes for engine_oil_filter for filters ****************************************** */

        $attribute_engine_oil_filter_ar = [
            'حجم المكينة ( فراغ يكتب فيه ) ارقام وفواصل فقط',
            'نوع وقود السيارة',
            'العدد المطلوب'
        ];
        $attribute_engine_oil_filter_en = [
            'Engine size (write in) only numbers and spaces',
            'Car engine type',
            'Quantity'
        ];
        $attribute_engine_oil_filter_options_ar = [
            ['type' => 'text'],
            [
                'type' => 'select',
                'options' => [
                    'بنزين',
                    'ديزل'
                ]
            ],
            ['type' => 'text'],
        ];

        $attribute_engine_oil_filter_options_en = [
            ['type' => 'text'],
            [
                'type' => 'select',
                'options' => [
                    'piston',
                    'disk'
                ]
            ],
            ['type' => 'text'],
        ];
        /***************************************** Attributes for coolant_oil_filter for filters ****************************************** */

        $attribute_coolant_oil_filter_ar = [
            'نوع القير',
            'كم غيار للقير',
            'نوع القير',
            'نوع القير للاوتوماتيك',
            'نوع وقود السيارة',
            'العدد المطلوب'
        ];
        $attribute_coolant_oil_filter_en = [
            'Coolant type',
            'Number of coolant',
            'Coolant type',
            'Coolant type for automatics',
            'Car engine type',
            'Quantity'
        ];
        $attribute_coolant_oil_filter_options_ar = [
            [
                'type' => 'select',
                'options' => [
                    'اوتوماتيك',
                    'قير عادي',
                ]
            ],
            [
                'type' => 'select',
                'options' => [
                    '4',
                    '6',
                    '8',
                    '10',
                    '12',
                ]
            ],
            ['type' => 'text'],
            [
                'type' => 'select',
                'options' => [
                    'ATF',
                    'CVT',
                    'DCT',
                ]
            ],
            [
                'type' => 'select',
                'options' => [
                    'بنزين',
                    'ديزل'
                ]
            ],
            ['type' => 'text'],
        ];

        $attribute_coolant_oil_filter_options_en = [
            [
                'type' => 'select',
                'options' => [
                    'automatics',
                    'normal',
                ]
            ],
            [
                'type' => 'select',
                'options' => [
                    '4',
                    '6',
                    '8',
                    '10',
                    '12',
                ]
            ],
            ['type' => 'text'],
            [
                'type' => 'select',
                'options' => [
                    'ATF',
                    'CVT',
                    'DCT',
                ]
            ],
            [
                'type' => 'select',
                'options' => [
                    'piston',
                    'disk'
                ]
            ],
            ['type' => 'text'],
        ];
        /***************************************** Attributes for petrol_filter for filters ****************************************** */

        $attribute_petrol_filter_ar = [

            'العدد المطلوب'
        ];
        $attribute_petrol_filter_en = [
            'Quantity'
        ];
        $attribute_petrol_filter_options_ar = [
            ['type' => 'text']
        ];

        $attribute_petrol_filter_options_en = [
            ['type' => 'text']
        ];
        /***************************************** Attributes for diesel_filter for filters ****************************************** */

        $attribute_diesel_filter_ar = [

            'العدد المطلوب'
        ];
        $attribute_diesel_filter_en = [
            'Quantity'
        ];
        $attribute_diesel_filter_options_ar = [
            ['type' => 'text']
        ];

        $attribute_diesel_filter_options_en = [
            ['type' => 'text']
        ];
        /***************************************** Attributes for machine_air_filter for filters ****************************************** */

        $attribute_machine_air_filter_ar = [

            'العدد المطلوب'
        ];
        $attribute_machine_air_filter_en = [
            'Quantity'
        ];
        $attribute_machine_air_filter_options_ar = [
            ['type' => 'text']
        ];

        $attribute_machine_air_filter_options_en = [
            ['type' => 'text']
        ];
        /***************************************** Attributes for air_conditioner_filter for filters ****************************************** */

        $attribute_air_conditioner_filter_ar = [

            'العدد المطلوب'
        ];
        $attribute_air_conditioner_filter_en = [
            'Quantity'
        ];
        $attribute_air_conditioner_filter_options_ar = [
            ['type' => 'text']
        ];
        $attribute_air_conditioner_filter_options_en = [
            ['type' => 'text']
        ];
        /***************************************** Attributes for other_1 for filters ****************************************** */

        $attribute_other_1_ar = [
            'طلبك'
        ];
        $attribute_other_1_en = [
            'Your request'
        ];
        $attribute_other_1_options_ar = [
            ['type' => 'text']
        ];

        $attribute_other_1_options_en = [
            ['type' => 'text']
        ];
        /***************************************** Attributes for machine_processor for machines ****************************************** */

        $attribute_machine_processor_ar = [
            'المشكلة',
            'عداد السيارة',
            'نوع وقود السيارة',
            'ادخل اسم الشركة المطلوبة ان وجدة',
            'العدد المطلوب',
        ];
        $attribute_machine_processor_en = [
            'Problem',
            'Car meter',
            'Car engine type',
            'Enter the name of the company that you need',
            'Quantity'
        ];
        $attribute_machine_processor_options_ar = [
            ['type' => 'text'],
            ['type' => 'text'],
            [
                'type' => 'select',
                'options' => [
                    'بنزين',
                    'ديزل'
                ]
            ],
            ['type' => 'text'],
            ['type' => 'text'],
        ];
        $attribute_machine_processor_options_en = [
            ['type' => 'text'],
            ['type' => 'text'],
            [
                'type' => 'select',
                'options' => [
                    'piston',
                    'disk'
                ]
            ],
            ['type' => 'text'],
            ['type' => 'text'],
        ];
        /***************************************** Attributes for gear_processor for machines ****************************************** */

        $attribute_gear_processor_ar = [
            'المشكلة',
            'عداد السيارة',
            'نوع وقود السيارة',
            'نوع القير',
            'كم غيار للقير',
            'نوع القير للاوتوماتيك',
            'ادخل اسم الشركة المطلوبة ان وجدة',
            'العدد المطلوب',
        ];
        $attribute_gear_processor_en = [
            'Problem',
            'Car meter',
            'Car engine type',
            'Coolant type',
            'Number of coolant',
            'Coolant type for automatics',
            'Enter the name of the company that you need',
            'Quantity'
        ];
        $attribute_gear_processor_options_ar = [
            ['type' => 'text'],
            ['type' => 'text'],
            [
                'type' => 'select',
                'options' => [
                    'بنزين',
                    'ديزل'
                ],
            ],
            [
                'type' => 'select',
                'options' => [
                    'اوتوماتيك',
                    'قير عادي'
                ]
            ],
            [
                'type' => 'select',
                'options' => [
                    '4',
                    '6',
                    '8',
                    '10',
                    '12',
                ]

            ],
            [
                'type' => 'select',
                'options' => [
                    'ATF',
                    'CVT',
                    'DCT'
                ]
            ],
            ['type' => 'text'],
            ['type' => 'text'],
        ];
        $attribute_gear_processor_options_en = [
            ['type' => 'text'],
            ['type' => 'text'],
            [
                'type' => 'select',
                'options' => [
                    'piston',
                    'disk'
                ],
            ],
            [
                'type' => 'select',
                'options' => [
                    'automatics',
                    'normal'
                ]
            ],
            [
                'type' => 'select',
                'options' => [
                    '4',
                    '6',
                    '8',
                    '10',
                    '12',
                ]

            ],
            [
                'type' => 'select',
                'options' => [
                    'ATF',
                    'CVT',
                    'DCT'
                ]
            ],
            ['type' => 'text'],
            ['type' => 'text'],

        ];
        /***************************************** Attributes for difference_wizard for machines ****************************************** */

        $attribute_difference_wizard_ar = [
            'المشكلة',
            'عداد السيارة',
            'نوع وقود السيارة',
            'ادخل اسم الشركة المطلوبة ان وجدة',
            'العدد المطلوب',
        ];
        $attribute_difference_wizard_en = [
            'Problem',
            'Car meter',
            'Car engine type',
            'Enter the name of the company that you need',
            'Quantity'
        ];
        $attribute_difference_wizard_options_ar = [
            ['type' => 'text'],
            ['type' => 'text'],
            [
                'type' => 'select',
                'options' => [
                    'بنزين',
                    'ديزل'
                ]
            ],
            ['type' => 'text'],
            ['type' => 'text'],
        ];

        $attribute_difference_wizard_options_en = [
            ['type' => 'text'],
            ['type' => 'text'],
            [
                'type' => 'select',
                'options' => [
                    'piston',
                    'disk'
                ]
            ],
            ['type' => 'text'],
            ['type' => 'text'],
        ];
        /***************************************** Attributes for drakeson_wizard for machines ****************************************** */

        $attribute_drakeson_wizard_ar = [
            'المشكلة',
            'عداد السيارة',
            'ادخل اسم الشركة المطلوبة ان وجدة',
            'العدد المطلوب',
        ];
        $attribute_drakeson_wizard_en = [
            'Problem',
            'Car meter',
            'Enter the name of the company that you need',
            'Quantity'
        ];
        $attribute_drakeson_wizard_options_ar = [
            ['type' => 'text'],
            ['type' => 'text'],
            ['type' => 'text'],
            ['type' => 'text'],
        ];
        $attribute_drakeson_wizard_options_en = [
            ['type' => 'text'],
            ['type' => 'text'],
            ['type' => 'text'],
            ['type' => 'text'],
        ];
        /***************************************** Attributes for other_2 for machines ****************************************** */

        $attribute_other_2_ar = [
            'طلبك',
            'المشكلة',
            'ادخل اسم الشركة المطلوبة ان وجدة',
            'عداد السيارة',
            'نوع وقود السيارة',
            'نوع القير',
            'نوع القير للاوتوماتيك',
        ];
        $attribute_other_2_en = [
            'Your request',
            'Problem',
            'Enter the name of the company that you need',
            'Car meter',
            'Car engine type',
            'Coolant type',
            'Coolant type for automatics',
        ];
        $attribute_other_2_options_ar = [
            ['type' => 'text'],
            ['type' => 'text'],
            ['type' => 'text'],
            ['type' => 'text'],
            [
                'type' => 'select',
                'options' => [
                    'بنزين',
                    'ديزل'
                ]
            ],
            [
                'type' => 'select',
                'options' => [
                    'اوتوماتيك',
                    'عادي'
                ]

            ],
            [
                'type' => 'select',
                'options' => [
                    'ATF',
                    'CVT',
                    'DCT'
                ]
            ]
        ];

        $attribute_other_2_options_en = [
            ['type' => 'text'],
            ['type' => 'text'],
            ['type' => 'text'],
            ['type' => 'text'],
            [
                'type' => 'select',
                'options' => [
                    'piston',
                    'disk'
                ]
            ],
            [
                'type' => 'select',
                'options' => [
                    'automatics',
                    'normal'
                ]
            ],
            [
                'type' => 'select',
                'options' => [
                    'ATF',
                    'CVT',
                    'DCT'
                ]
            ]
        ];
        /***************************************** Attributes for wrenches for mechanical-cleaners ****************************************** */

        $attribute_wrenches_ar = [
            'نوع وقود السيارة',
            'ادخل اسم الشركة المطلوبة ان وجدة',
            'العدد المطلوب',
        ];
        $attribute_wrenches_en = [
            'Car engine type',
            'Enter the name of the company that you need',
            'Quantity'
        ];
        $attribute_wrenches_options_ar = [
            [
                'type' => 'select',
                'options' => [
                    'بنزين',
                    'ديزل',
                ]
            ],
            ['type' => 'text'],
            ['type' => 'text'],

        ];

        $attribute_wrenches_options_en = [
            [
                'type' => 'select',
                'options' => [
                    'piston',
                    'disk',
                ]
            ],
            ['type' => 'text'],
            ['type' => 'text'],
        ];
        /***************************************** Attributes for screwdrivers for mechanical-cleaners ****************************************** */

        $attribute_screwdrivers_ar = [
            'نوع وقود السيارة',
            'ادخل اسم الشركة المطلوبة ان وجدة',
            'العدد المطلوب',
        ];
        $attribute_screwdrivers_en = [
            'Car engine type',
            'Enter the name of the company that you need',
            'Quantity'
        ];
        $attribute_screwdrivers_options_ar = [
            [
                'type' => 'select',
                'options' => [
                    'بنزين',
                    'ديزل',
                ]
            ],
            ['type' => 'text'],
            ['type' => 'text'],
        ];

        $attribute_screwdrivers_options_en = [
            [
                'type' => 'select',
                'options' => [
                    'piston',
                    'disk',
                ]
            ],
            ['type' => 'text'],
            ['type' => 'text'],
        ];
        /***************************************** Attributes for electronics for mechanical-cleaners ****************************************** */

        $attribute_electronics_ar = [
            'ادخل اسم الشركة المطلوبة ان وجدة',
            'العدد المطلوب',
        ];
        $attribute_electronics_en = [
            'Enter the name of the company that you need',
            'Quantity'
        ];
        $attribute_electronics_options_ar = [
            ['type' => 'text'],
            ['type' => 'text'],
        ];

        $attribute_electronics_options_en = [
            ['type' => 'text'],
            ['type' => 'text'],
        ];
        /***************************************** Attributes for air_conditioning for mechanical-cleaners ****************************************** */

        $attribute_air_conditioning_ar = [
            'ادخل اسم الشركة المطلوبة ان وجدة',
            'العدد المطلوب',
        ];
        $attribute_air_conditioning_en = [
            'Enter the name of the company that you need',
            'Quantity'
        ];
        $attribute_air_conditioning_options_ar = [
            ['type' => 'text'],
            ['type' => 'text'],
        ];

        $attribute_air_conditioning_options_en = [
            ['type' => 'text'],
            ['type' => 'text'],
        ];
        /***************************************** Attributes for other_3 for mechanical-cleaners ****************************************** */

        $attribute_other_3_ar = [
            'الغرض من المنظف',
            'ادخل اسم الشركة المطلوبة ان وجدة',
            'نوع وقود السيارة',
            'نوع القير',
            'عدد اسطوانات المحرك',
            'الاضافات علي السيارة',
            'العدد المطلوب',
        ];
        $attribute_other_3_en = [
            'Purpose of the cleaner',
            'Enter the name of the company that you need',
            'Car engine type',
            'Coolant type',
            'Number of cylinders',
            'Additions on the car',
            'Quantity'
        ];
        $attribute_other_3_options_ar = [
            ['type' => 'text'],
            ['type' => 'text'],
            [
                'type' => 'select',
                'options' => [
                    'بنزين',
                    'ديزل',
                ]
            ],
            [
                'type' => 'select',
                'options' => [
                    'اوتوماتيك',
                    'عادي'
                ]
            ],
            [
                'type' => 'select',
                'options' => [
                    'v2',
                    'v3',
                    'v4',
                    'v6',
                    'v8',
                    'v10',
                    'v12',
                ]
            ],
            [
                'type' => 'select',
                'options' => [
                    'لا يوجد اضافات',
                    'تيربو',
                    'توين تيربو',
                    'سوبر',
                    'غير ذلك',
                ]
            ],
            ['type' => 'text']

        ];

        $attribute_other_3_options_en = [
            ['type' => 'text'],
            ['type' => 'text'],
            [
                'type' => 'select',
                'options' => [
                    'piston',
                    'disk',
                ]
            ],
            [
                'type' => 'select',
                'options' => [
                    'automatic',
                    'manual',
                ]
            ],
            [
                'type' => 'select',
                'options' => [
                    'v2',
                    'v3',
                    'v4',
                    'v6',
                    'v8',
                    'v10',
                    'v12',
                ]
            ],
            [
                'type' => 'select',
                'options' => [
                    'no additions',
                    'tire',
                    'tire tire',
                    'super',
                    'other',
                ]
            ],
            ['type' => 'text']
        ];
        /***************************************** Attributes for radiator_water for rear ****************************************** */

        $attribute_radiator_water_ar = [
            'ادخل اسم الشركة المطلوبة ان وجدة',
            'تركيز الماء',
            'العدد المطلوب',
        ];
        $attribute_radiator_water_en = [
            'Enter the name of the company that you need',
            'Water pressure',
            'Quantity'
        ];
        $attribute_radiator_water_options_ar = [
            ['type' => 'text'],
            [
                'type' => 'select',
                'options' => [
                    '33%',
                    '50%',
                    '100%',
                    'مياه مقطرة',
                ]
            ],
            ['type' => 'text'],
        ];

        $attribute_radiator_water_options_en = [
            ['type' => 'text'],
            [
                'type' => 'select',
                'options' => [
                    '33%',
                    '50%',
                    '100%',
                    'water tank',
                ]
            ],
            ['type' => 'text'],
        ];
        /***************************************** Attributes for sealant for rear ****************************************** */

        $attribute_sealant_ar = [
            'ادخل اسم الشركة المطلوبة ان وجدة',
            'العدد المطلوب',
        ];
        $attribute_sealant_en = [
            'Enter the name of the company that you need',
            'Quantity'
        ];
        $attribute_sealant_options_ar = [
            ['type' => 'text'],
            ['type' => 'text'],
        ];
        $attribute_sealant_options_en = [
            ['type' => 'text'],
            ['type' => 'text'],
        ];
        /***************************************** Attributes for radiator_cleaner for rear ****************************************** */

        $attribute_radiator_cleaner_ar = [
            'ادخل اسم الشركة المطلوبة ان وجدة',
            'العدد المطلوب',
        ];
        $attribute_radiator_cleaner_en = [
            'Enter the name of the company that you need',
            'Quantity'
        ];
        $attribute_radiator_cleaner_options_ar = [
            ['type' => 'text'],
            ['type' => 'text'],
        ];
        $attribute_radiator_cleaner_options_en = [
            ['type' => 'text'],
            ['type' => 'text'],
        ];
        /***************************************** Attributes for colent for rear ****************************************** */

        $attribute_colent_ar = [
            'ادخل اسم الشركة المطلوبة ان وجدة',
            'العدد المطلوب',
        ];
        $attribute_colent_en = [
            'Enter the name of the company that you need',
            'Quantity'
        ];
        $attribute_colent_options_ar = [
            ['type' => 'text'],
            ['type' => 'text'],
        ];
        $attribute_colent_options_en = [
            ['type' => 'text'],
            ['type' => 'text'],
        ];
        /***************************************** Attributes for other_4 for rear ****************************************** */
        $attribute_other_4_ar = [
            'سجل طلبك',
            'ادخل اسم الشركة المطلوبة ان وجدة',
            'العدد المطلوب',
        ];
        $attribute_other_4_en = [
            'Enter your request',
            'Enter the name of the company that you need',
            'Quantity'
        ];
        $attribute_other_4_options_ar = [
            ['type' => 'text'],
            ['type' => 'text'],
            ['type' => 'text'],
        ];
        $attribute_other_4_options_en = [
            ['type' => 'text'],
            ['type' => 'text'],
            ['type' => 'text'],
        ];

        foreach ($sub_activity as $key =>  $sub) {
            if ($sub->slug == 'mechanical') {
                foreach ($attribute_mechanical_ar as $attributeKey => $attribute) {
                    $parnetAttribute = Attribute::create([
                        'name_ar' => $attribute,
                        'name_en' => $attribute_mechanical_en[$attributeKey],
                        'sub_activity_id' => $sub->id,
                        'type' => $attribute_mechanical_options_ar[$attributeKey]['type'],
                        'created_at' => now(),
                        'updated_at' => now(),
                    ]);
                    if ($attribute_mechanical_options_ar[$attributeKey]['type'] == 'select') {
                        foreach ($attribute_mechanical_options_ar[$attributeKey]['options'] as $optionKey => $option) {

                            $parnetAttribute->options()->create([
                                'name_ar' => $option,
                                'name_en' => $attribute_mechanical_options_en[$attributeKey]['options'][$optionKey],
                                'created_at' => now(),
                                'updated_at' => now(),
                            ]);
                        }
                    }
                }
            } elseif ($sub->slug == 'electric') {
                foreach ($attribute_electric_ar as $attributeKey => $attribute) {
                    $parnetAttribute = Attribute::create([
                        'name_ar' => $attribute,
                        'name_en' => $attribute_electric_en[$attributeKey],
                        'sub_activity_id' => $sub->id,
                        'type' => $attribute_electric_options_ar[$attributeKey]['type'],
                        'created_at' => now(),
                        'updated_at' => now(),
                    ]);
                    if ($attribute_electric_options_ar[$attributeKey]['type'] == 'select') {

                        foreach ($attribute_electric_options_ar[$attributeKey]['options'] as $optionKey => $option) {

                            $parnetAttribute->options()->create([
                                'name_ar' => $option,
                                'name_en' => $attribute_electric_options_en[$attributeKey]['options'][$optionKey],
                                'created_at' => now(),
                                'updated_at' => now(),
                            ]);
                        }
                    }
                }
            } elseif ($sub->slug == 'mechanical-1') {
                foreach ($attribute_mechanical_1_ar as $attributeKey => $attribute) {

                    $parnetAttribute = Attribute::create([
                        'name_ar' => $attribute,
                        'name_en' => $attribute_mechanical_1_en[$attributeKey],
                        'sub_activity_id' => $sub->id,
                        'type' => $attribute_mechanical_1_options_ar[$attributeKey]['type'],
                        'created_at' => now(),
                        'updated_at' => now(),
                    ]);
                    if ($attribute_mechanical_1_options_ar[$attributeKey]['type'] == 'select') {

                        foreach ($attribute_mechanical_1_options_ar[$attributeKey]['options'] as $optionKey => $option) {

                            $parnetAttribute->options()->create([
                                'name_ar' => $option,
                                'name_en' => $attribute_mechanical_1_options_en[$attributeKey]['options'][$optionKey],
                                'created_at' => now(),
                                'updated_at' => now(),
                            ]);
                        }
                    }
                }
            } elseif ($sub->slug == 'electric-1') {
                foreach ($attribute_electric_1_ar as $attributeKey => $attribute) {

                    $parnetAttribute = Attribute::create([
                        'name_ar' => $attribute,
                        'name_en' => $attribute_electric_1_en[$attributeKey],
                        'sub_activity_id' => $sub->id,
                        'type' => $attribute_electric_1_options_ar[$attributeKey]['type'],
                        'created_at' => now(),
                        'updated_at' => now(),
                    ]);
                    if ($attribute_electric_1_options_ar[$attributeKey]['type'] == 'select') {

                        foreach ($attribute_electric_1_options_ar[$attributeKey]['options'] as $optionKey => $option) {

                            $parnetAttribute->options()->create([
                                'name_ar' => $option,
                                'name_en' => $attribute_electric_1_options_en[$attributeKey]['options'][$optionKey],
                                'created_at' => now(),
                                'updated_at' => now(),
                            ]);
                        }
                    }
                }
            } elseif ($sub->slug == 'external-1') {
                foreach ($attribute_external_1_ar as $attributeKey => $attribute) {

                    $parnetAttribute = Attribute::create([
                        'name_ar' => $attribute,
                        'name_en' => $attribute_external_1_en[$attributeKey],
                        'sub_activity_id' => $sub->id,
                        'type' => $attribute_external_1_options_ar[$attributeKey]['type'],
                        'created_at' => now(),
                        'updated_at' => now(),
                    ]);
                    if ($attribute_external_1_options_ar[$attributeKey]['type'] == 'select') {

                        foreach ($attribute_external_1_options_ar[$attributeKey]['options'] as $optionKey => $option) {

                            $parnetAttribute->options()->create([
                                'name_ar' => $option,
                                'name_en' => $attribute_external_1_options_en[$attributeKey]['options'][$optionKey],
                                'created_at' => now(),
                                'updated_at' => now(),
                            ]);
                        }
                    }
                }
            } elseif ($sub->slug == 'internal-1') {
                foreach ($attribute_internal_1_ar as $attributeKey => $attribute) {

                    $parnetAttribute = Attribute::create([
                        'name_ar' => $attribute,
                        'name_en' => $attribute_internal_1_en[$attributeKey],
                        'sub_activity_id' => $sub->id,
                        'type' => $attribute_internal_1_options_ar[$attributeKey]['type'],
                        'created_at' => now(),
                        'updated_at' => now(),
                    ]);
                    if ($attribute_internal_1_options_ar[$attributeKey]['type'] == 'select') {

                        foreach ($attribute_internal_1_options_ar[$attributeKey]['options'] as $optionKey => $option) {

                            $parnetAttribute->options()->create([
                                'name_ar' => $option,
                                'name_en' => $attribute_internal_1_options_en[$attributeKey]['options'][$optionKey],
                                'created_at' => now(),
                                'updated_at' => now(),
                            ]);
                        }
                    }
                }
            } elseif ($sub->slug == 'cars') {
                foreach ($attribute_cars_ar as $attributeKey => $attribute) {

                    $parnetAttribute = Attribute::create([
                        'name_ar' => $attribute,
                        'name_en' => $attribute_cars_en[$attributeKey],
                        'sub_activity_id' => $sub->id,
                        'type' => $attribute_cars_options_ar[$attributeKey]['type'],
                        'min' => $attribute_cars_options_ar[$attributeKey]['type'] == 'range' ? $attribute_cars_options_ar[$attributeKey]['min'] : null,
                        'max' => $attribute_cars_options_ar[$attributeKey]['type'] == 'range' ? $attribute_cars_options_ar[$attributeKey]['max'] : null,
                        'step' => $attribute_cars_options_ar[$attributeKey]['type'] == 'range' ? $attribute_cars_options_ar[$attributeKey]['step'] : null,
                        'created_at' => now(),
                        'updated_at' => now(),
                    ]);
                    if ($attribute_cars_options_ar[$attributeKey]['type'] == 'select') {

                        foreach ($attribute_cars_options_ar[$attributeKey]['options'] as $optionKey => $option) {

                            $parnetAttribute->options()->create([
                                'name_ar' => $option,
                                'name_en' => $attribute_cars_options_en[$attributeKey]['options'][$optionKey],
                                'created_at' => now(),
                                'updated_at' => now(),
                            ]);
                        }
                    }
                }
            } elseif ($sub->slug == 'trucks') {
                foreach ($attribute_trucks_ar as $attributeKey => $attribute) {

                    $parnetAttribute = Attribute::create([
                        'name_ar' => $attribute,
                        'name_en' => $attribute_trucks_en[$attributeKey],
                        'sub_activity_id' => $sub->id,
                        'type' => $attribute_trucks_options_ar[$attributeKey]['type'],
                        'min' => $attribute_trucks_options_ar[$attributeKey]['type'] == 'range' ? $attribute_trucks_options_ar[$attributeKey]['min'] : null,
                        'max' => $attribute_trucks_options_ar[$attributeKey]['type'] == 'range' ? $attribute_trucks_options_ar[$attributeKey]['max'] : null,
                        'step' => $attribute_trucks_options_ar[$attributeKey]['type'] == 'range' ? $attribute_trucks_options_ar[$attributeKey]['step'] : null,
                        'created_at' => now(),
                        'updated_at' => now(),
                    ]);
                    if ($attribute_trucks_options_ar[$attributeKey]['type'] == 'select') {

                        foreach ($attribute_trucks_options_ar[$attributeKey]['options'] as $optionKey => $option) {

                            $parnetAttribute->options()->create([
                                'name_ar' => $option,
                                'name_en' => $attribute_trucks_options_en[$attributeKey]['options'][$optionKey],
                                'created_at' => now(),
                                'updated_at' => now(),
                            ]);
                        }
                    }
                }
            } elseif ($sub->slug == 'agricultural') {
                foreach ($attribute_agricultural_ar as $attributeKey => $attribute) {

                    $parnetAttribute = Attribute::create([
                        'name_ar' => $attribute,
                        'name_en' => $attribute_agricultural_en[$attributeKey],
                        'sub_activity_id' => $sub->id,
                        'type' => $attribute_agricultural_options_ar[$attributeKey]['type'],
                        'min' => $attribute_agricultural_options_ar[$attributeKey]['type'] == 'range' ? $attribute_agricultural_options_ar[$attributeKey]['min'] : null,
                        'max' => $attribute_agricultural_options_ar[$attributeKey]['type'] == 'range' ? $attribute_agricultural_options_ar[$attributeKey]['max'] : null,
                        'step' => $attribute_agricultural_options_ar[$attributeKey]['type'] == 'range' ? $attribute_agricultural_options_ar[$attributeKey]['step'] : null,
                        'created_at' => now(),
                        'updated_at' => now(),
                    ]);
                    if ($attribute_agricultural_options_ar[$attributeKey]['type'] == 'select') {

                        foreach ($attribute_agricultural_options_ar[$attributeKey]['options'] as $optionKey => $option) {

                            $parnetAttribute->options()->create([
                                'name_ar' => $option,
                                'name_en' => $attribute_agricultural_options_en[$attributeKey]['options'][$optionKey],
                                'created_at' => now(),
                                'updated_at' => now(),
                            ]);
                        }
                    }
                }
            } elseif ($sub->slug == 'industrial') {
                foreach ($attribute_industrial_ar as $attributeKey => $attribute) {

                    $parnetAttribute = Attribute::create([
                        'name_ar' => $attribute,
                        'name_en' => $attribute_industrial_en[$attributeKey],
                        'sub_activity_id' => $sub->id,
                        'type' => $attribute_industrial_options_ar[$attributeKey]['type'],
                        'min' => $attribute_industrial_options_ar[$attributeKey]['type'] == 'range' ? $attribute_industrial_options_ar[$attributeKey]['min'] : null,
                        'max' => $attribute_industrial_options_ar[$attributeKey]['type'] == 'range' ? $attribute_industrial_options_ar[$attributeKey]['max'] : null,
                        'step' => $attribute_industrial_options_ar[$attributeKey]['type'] == 'range' ? $attribute_industrial_options_ar[$attributeKey]['step'] : null,
                        'created_at' => now(),
                        'updated_at' => now(),
                    ]);
                    if ($attribute_industrial_options_ar[$attributeKey]['type'] == 'select') {

                        foreach ($attribute_industrial_options_ar[$attributeKey]['options'] as $optionKey => $option) {

                            $parnetAttribute->options()->create([
                                'name_ar' => $option,
                                'name_en' => $attribute_industrial_options_en[$attributeKey]['options'][$optionKey],
                                'created_at' => now(),
                                'updated_at' => now(),
                            ]);
                        }
                    }
                }
            } elseif ($sub->slug == 'cars-1') {
                foreach ($attribute_cars_1_ar as $attributeKey => $attribute) {

                    $parnetAttribute = Attribute::create([
                        'name_ar' => $attribute,
                        'name_en' => $attribute_cars_1_en[$attributeKey],
                        'sub_activity_id' => $sub->id,
                        'type' => $attribute_cars_1_options_ar[$attributeKey]['type'],
                        'min' => $attribute_cars_1_options_ar[$attributeKey]['type'] == 'range' ? $attribute_cars_1_options_ar[$attributeKey]['min'] : null,
                        'max' => $attribute_cars_1_options_ar[$attributeKey]['type'] == 'range' ? $attribute_cars_1_options_ar[$attributeKey]['max'] : null,
                        'step' => $attribute_cars_1_options_ar[$attributeKey]['type'] == 'range' ? $attribute_cars_1_options_ar[$attributeKey]['step'] : null,
                        'created_at' => now(),
                        'updated_at' => now(),
                    ]);
                    if ($attribute_cars_1_options_ar[$attributeKey]['type'] == 'select') {

                        foreach ($attribute_cars_1_options_ar[$attributeKey]['options'] as $optionKey => $option) {

                            $parnetAttribute->options()->create([
                                'name_ar' => $option,
                                'name_en' => $attribute_cars_1_options_en[$attributeKey]['options'][$optionKey],
                                'created_at' => now(),
                                'updated_at' => now(),
                            ]);
                        }
                    }
                }
            } elseif ($sub->slug == 'trucks-1') {
                foreach ($attribute_trucks_1_ar as $attributeKey => $attribute) {

                    $parnetAttribute = Attribute::create([
                        'name_ar' => $attribute,
                        'name_en' => $attribute_trucks_1_en[$attributeKey],
                        'sub_activity_id' => $sub->id,
                        'type' => $attribute_trucks_1_options_ar[$attributeKey]['type'],
                        'min' => $attribute_trucks_1_options_ar[$attributeKey]['type'] == 'range' ? $attribute_trucks_1_options_ar[$attributeKey]['min'] : null,
                        'max' => $attribute_trucks_1_options_ar[$attributeKey]['type'] == 'range' ? $attribute_trucks_1_options_ar[$attributeKey]['max'] : null,
                        'step' => $attribute_trucks_1_options_ar[$attributeKey]['type'] == 'range' ? $attribute_trucks_1_options_ar[$attributeKey]['step'] : null,
                        'created_at' => now(),
                        'updated_at' => now(),
                    ]);
                    if ($attribute_trucks_1_options_ar[$attributeKey]['type'] == 'select') {

                        foreach ($attribute_trucks_1_options_ar[$attributeKey]['options'] as $optionKey => $option) {

                            $parnetAttribute->options()->create([
                                'name_ar' => $option,
                                'name_en' => $attribute_trucks_1_options_en[$attributeKey]['options'][$optionKey],
                                'created_at' => now(),
                                'updated_at' => now(),
                            ]);
                        }
                    }
                }
            } elseif ($sub->slug == 'agricultural-1') {
                foreach ($attribute_agricultural_1_ar as $attributeKey => $attribute) {

                    $parnetAttribute = Attribute::create([
                        'name_ar' => $attribute,
                        'name_en' => $attribute_agricultural_1_en[$attributeKey],
                        'sub_activity_id' => $sub->id,
                        'type' => $attribute_agricultural_1_options_ar[$attributeKey]['type'],
                        'min' => $attribute_agricultural_1_options_ar[$attributeKey]['type'] == 'range' ? $attribute_agricultural_1_options_ar[$attributeKey]['min'] : null,
                        'max' => $attribute_agricultural_1_options_ar[$attributeKey]['type'] == 'range' ? $attribute_agricultural_1_options_ar[$attributeKey]['max'] : null,
                        'step' => $attribute_agricultural_1_options_ar[$attributeKey]['type'] == 'range' ? $attribute_agricultural_1_options_ar[$attributeKey]['step'] : null,
                        'created_at' => now(),
                        'updated_at' => now(),
                    ]);
                    if ($attribute_agricultural_1_options_ar[$attributeKey]['type'] == 'select') {

                        foreach ($attribute_agricultural_1_options_ar[$attributeKey]['options'] as $optionKey => $option) {

                            $parnetAttribute->options()->create([
                                'name_ar' => $option,
                                'name_en' => $attribute_agricultural_1_options_en[$attributeKey]['options'][$optionKey],
                                'created_at' => now(),
                                'updated_at' => now(),
                            ]);
                        }
                    }
                }
            } elseif ($sub->slug == 'industrial-1') {
                foreach ($attribute_industrial_1_ar as $attributeKey => $attribute) {

                    $parnetAttribute = Attribute::create([
                        'name_ar' => $attribute,
                        'name_en' => $attribute_industrial_1_en[$attributeKey],
                        'sub_activity_id' => $sub->id,
                        'type' => $attribute_industrial_1_options_ar[$attributeKey]['type'],
                        'min' => $attribute_industrial_1_options_ar[$attributeKey]['type'] == 'range' ? $attribute_industrial_1_options_ar[$attributeKey]['min'] : null,
                        'max' => $attribute_industrial_1_options_ar[$attributeKey]['type'] == 'range' ? $attribute_industrial_1_options_ar[$attributeKey]['max'] : null,
                        'step' => $attribute_industrial_1_options_ar[$attributeKey]['type'] == 'range' ? $attribute_industrial_1_options_ar[$attributeKey]['step'] : null,
                        'created_at' => now(),
                        'updated_at' => now(),
                    ]);
                    if ($attribute_industrial_1_options_ar[$attributeKey]['type'] == 'select') {

                        foreach ($attribute_industrial_1_options_ar[$attributeKey]['options'] as $optionKey => $option) {

                            $parnetAttribute->options()->create([
                                'name_ar' => $option,
                                'name_en' => $attribute_industrial_1_options_en[$attributeKey]['options'][$optionKey],
                                'created_at' => now(),
                                'updated_at' => now(),
                            ]);
                        }
                    }
                }
            } elseif ($sub->slug == 'engine-oil') {
                foreach ($attribute_engine_oils_ar as $attributeKey => $attribute) {

                    $parnetAttribute = Attribute::create([
                        'name_ar' => $attribute,
                        'name_en' => $attribute_engine_oils_en[$attributeKey],
                        'sub_activity_id' => $sub->id,
                        'type' => $attribute_engine_oils_options_ar[$attributeKey]['type'],
                        'created_at' => now(),
                        'updated_at' => now(),
                    ]);
                    if ($attribute_engine_oils_options_ar[$attributeKey]['type'] == 'select') {

                        foreach ($attribute_engine_oils_options_ar[$attributeKey]['options'] as $optionKey => $option) {

                            $parnetAttribute->options()->create([
                                'name_ar' => $option,
                                'name_en' => $attribute_engine_oils_options_en[$attributeKey]['options'][$optionKey],
                                'created_at' => now(),
                                'updated_at' => now(),
                            ]);
                        }
                    }
                }
            } elseif ($sub->slug == 'bituminous-oil') {
                foreach ($attribute_bituminous_oil_ar as $attributeKey => $attribute) {

                    $parnetAttribute = Attribute::create([
                        'name_ar' => $attribute,
                        'name_en' => $attribute_bituminous_oil_en[$attributeKey],
                        'sub_activity_id' => $sub->id,
                        'type' => $attribute_bituminous_oil_options_ar[$attributeKey]['type'],
                        'created_at' => now(),
                        'updated_at' => now(),
                    ]);
                    if ($attribute_bituminous_oil_options_ar[$attributeKey]['type'] == 'select') {

                        foreach ($attribute_bituminous_oil_options_ar[$attributeKey]['options'] as $optionKey => $option) {

                            $parnetAttribute->options()->create([
                                'name_ar' => $option,
                                'name_en' => $attribute_bituminous_oil_options_en[$attributeKey]['options'][$optionKey],
                                'created_at' => now(),
                                'updated_at' => now(),
                            ]);
                        }
                    }
                }
            } elseif ($sub->slug == 'differential-oil') {
                foreach ($attribute_differential_oil_ar as $attributeKey => $attribute) {

                    $parnetAttribute = Attribute::create([
                        'name_ar' => $attribute,
                        'name_en' => $attribute_differential_oil_en[$attributeKey],
                        'sub_activity_id' => $sub->id,
                        'type' => $attribute_differential_oil_options_ar[$attributeKey]['type'],
                        'created_at' => now(),
                        'updated_at' => now(),
                    ]);
                    if ($attribute_differential_oil_options_ar[$attributeKey]['type'] == 'select') {

                        foreach ($attribute_differential_oil_options_ar[$attributeKey]['options'] as $optionKey => $option) {

                            $parnetAttribute->options()->create([
                                'name_ar' => $option,
                                'name_en' => $attribute_differential_oil_options_en[$attributeKey]['options'][$optionKey],
                                'created_at' => now(),
                                'updated_at' => now(),
                            ]);
                        }
                    }
                }
            } elseif ($sub->slug == 'brake-fluid') {
                foreach ($attribute_brake_fluid_ar as $attributeKey => $attribute) {

                    $parnetAttribute = Attribute::create([
                        'name_ar' => $attribute,
                        'name_en' => $attribute_brake_fluid_en[$attributeKey],
                        'sub_activity_id' => $sub->id,
                        'type' => $attribute_brake_fluid_options_ar[$attributeKey]['type'],
                        'created_at' => now(),
                        'updated_at' => now(),
                    ]);
                    if ($attribute_brake_fluid_options_ar[$attributeKey]['type'] == 'select') {

                        foreach ($attribute_brake_fluid_options_ar[$attributeKey]['options'] as $optionKey => $option) {

                            $parnetAttribute->options()->create([
                                'name_ar' => $option,
                                'name_en' => $attribute_brake_fluid_options_en[$attributeKey]['options'][$optionKey],
                                'created_at' => now(),
                                'updated_at' => now(),
                            ]);
                        }
                    }
                }
            } elseif ($sub->slug == 'derrickson-oil') {
                foreach ($attribute_derrickson_oil_ar as $attributeKey => $attribute) {

                    $parnetAttribute = Attribute::create([
                        'name_ar' => $attribute,
                        'name_en' => $attribute_derrickson_oil_en[$attributeKey],
                        'sub_activity_id' => $sub->id,
                        'type' => $attribute_derrickson_oil_options_ar[$attributeKey]['type'],
                        'created_at' => now(),
                        'updated_at' => now(),
                    ]);
                    if ($attribute_derrickson_oil_options_ar[$attributeKey]['type'] == 'select') {

                        foreach ($attribute_derrickson_oil_options_ar[$attributeKey]['options'] as $optionKey => $option) {

                            $parnetAttribute->options()->create([
                                'name_ar' => $option,
                                'name_en' => $attribute_derrickson_oil_options_en[$attributeKey]['options'][$optionKey],
                                'created_at' => now(),
                                'updated_at' => now(),
                            ]);
                        }
                    }
                }
            } elseif ($sub->slug == 'other') {
                foreach ($attribute_other_ar as $attributeKey => $attribute) {

                    $parnetAttribute = Attribute::create([
                        'name_ar' => $attribute,
                        'name_en' => $attribute_other_en[$attributeKey],
                        'sub_activity_id' => $sub->id,
                        'type' => $attribute_other_options_ar[$attributeKey]['type'],
                        'created_at' => now(),
                        'updated_at' => now(),
                    ]);
                    if ($attribute_other_options_ar[$attributeKey]['type'] == 'select') {

                        foreach ($attribute_other_options_ar[$attributeKey]['options'] as $optionKey => $option) {

                            $parnetAttribute->options()->create([
                                'name_ar' => $option,
                                'name_en' => $attribute_other_options_en[$attributeKey]['options'][$optionKey],
                                'created_at' => now(),
                                'updated_at' => now(),
                            ]);
                        }
                    }
                }
            } elseif ($sub->slug == 'engine-oil-filter') {
                foreach ($attribute_engine_oil_filter_ar as $attributeKey => $attribute) {

                    $parnetAttribute = Attribute::create([
                        'name_ar' => $attribute,
                        'name_en' => $attribute_engine_oil_filter_en[$attributeKey],
                        'sub_activity_id' => $sub->id,
                        'type' => $attribute_engine_oil_filter_options_ar[$attributeKey]['type'],
                        'created_at' => now(),
                        'updated_at' => now(),
                    ]);
                    if ($attribute_engine_oil_filter_options_ar[$attributeKey]['type'] == 'select') {

                        foreach ($attribute_engine_oil_filter_options_ar[$attributeKey]['options'] as $optionKey => $option) {

                            $parnetAttribute->options()->create([
                                'name_ar' => $option,
                                'name_en' => $attribute_engine_oil_filter_options_en[$attributeKey]['options'][$optionKey],
                                'created_at' => now(),
                                'updated_at' => now(),
                            ]);
                        }
                    }
                }
            } elseif ($sub->slug == 'coolant-oil-filter') {
                foreach ($attribute_coolant_oil_filter_ar as $attributeKey => $attribute) {

                    $parnetAttribute = Attribute::create([
                        'name_ar' => $attribute,
                        'name_en' => $attribute_coolant_oil_filter_en[$attributeKey],
                        'sub_activity_id' => $sub->id,
                        'type' => $attribute_coolant_oil_filter_options_ar[$attributeKey]['type'],
                        'created_at' => now(),
                        'updated_at' => now(),
                    ]);
                    if ($attribute_coolant_oil_filter_options_ar[$attributeKey]['type'] == 'select') {

                        foreach ($attribute_coolant_oil_filter_options_ar[$attributeKey]['options'] as $optionKey => $option) {
                            $parnetAttribute->options()->create([
                                'name_ar' => $option,
                                'name_en' => $attribute_coolant_oil_filter_options_en[$attributeKey]['options'][$optionKey],
                                'created_at' => now(),
                                'updated_at' => now(),
                            ]);
                        }
                    }
                }
            } elseif ($sub->slug == 'petrol-filter') {
                foreach ($attribute_petrol_filter_ar as $attributeKey => $attribute) {

                    $parnetAttribute = Attribute::create([
                        'name_ar' => $attribute,
                        'name_en' => $attribute_petrol_filter_en[$attributeKey],
                        'sub_activity_id' => $sub->id,
                        'type' => $attribute_petrol_filter_options_ar[$attributeKey]['type'],
                        'created_at' => now(),
                        'updated_at' => now(),
                    ]);
                    if ($attribute_petrol_filter_options_ar[$attributeKey]['type'] == 'select') {

                        foreach ($attribute_petrol_filter_options_ar[$attributeKey]['options'] as $optionKey => $option) {
                            $parnetAttribute->options()->create([
                                'name_ar' => $option,
                                'name_en' => $attribute_petrol_filter_options_en[$attributeKey]['options'][$optionKey],
                                'created_at' => now(),
                                'updated_at' => now(),
                            ]);
                        }
                    }
                }
            } elseif ($sub->slug == 'diesel-filter') {
                foreach ($attribute_diesel_filter_ar as $attributeKey => $attribute) {

                    $parnetAttribute = Attribute::create([
                        'name_ar' => $attribute,
                        'name_en' => $attribute_diesel_filter_en[$attributeKey],
                        'sub_activity_id' => $sub->id,
                        'type' => $attribute_diesel_filter_options_ar[$attributeKey]['type'],
                        'created_at' => now(),
                        'updated_at' => now(),
                    ]);
                    if ($attribute_diesel_filter_options_ar[$attributeKey]['type'] == 'select') {

                        foreach ($attribute_diesel_filter_options_ar[$attributeKey]['options'] as $optionKey => $option) {
                            $parnetAttribute->options()->create([
                                'name_ar' => $option,
                                'name_en' => $attribute_diesel_filter_options_en[$attributeKey]['options'][$optionKey],
                                'created_at' => now(),
                                'updated_at' => now(),
                            ]);
                        }
                    }
                }
            } elseif ($sub->slug == 'machine-air-filter') {
                foreach ($attribute_machine_air_filter_ar as $attributeKey => $attribute) {

                    $parnetAttribute = Attribute::create([
                        'name_ar' => $attribute,
                        'name_en' => $attribute_machine_air_filter_en[$attributeKey],
                        'sub_activity_id' => $sub->id,
                        'type' => $attribute_machine_air_filter_options_ar[$attributeKey]['type'],
                        'created_at' => now(),
                        'updated_at' => now(),
                    ]);
                    if ($attribute_machine_air_filter_options_ar[$attributeKey]['type'] == 'select') {

                        foreach ($attribute_machine_air_filter_options_ar[$attributeKey]['options'] as $optionKey => $option) {
                            $parnetAttribute->options()->create([
                                'name_ar' => $option,
                                'name_en' => $attribute_machine_air_filter_options_en[$attributeKey]['options'][$optionKey],
                                'created_at' => now(),
                                'updated_at' => now(),
                            ]);
                        }
                    }
                }
            } elseif ($sub->slug == 'air-conditioner-filter') {
                foreach ($attribute_air_conditioner_filter_ar as $attributeKey => $attribute) {

                    $parnetAttribute = Attribute::create([
                        'name_ar' => $attribute,
                        'name_en' => $attribute_air_conditioner_filter_en[$attributeKey],
                        'sub_activity_id' => $sub->id,
                        'type' => $attribute_air_conditioner_filter_options_ar[$attributeKey]['type'],
                        'created_at' => now(),
                        'updated_at' => now(),
                    ]);
                    if ($attribute_air_conditioner_filter_options_ar[$attributeKey]['type'] == 'select') {

                        foreach ($attribute_air_conditioner_filter_options_ar[$attributeKey]['options'] as $optionKey => $option) {
                            $parnetAttribute->options()->create([
                                'name_ar' => $option,
                                'name_en' => $attribute_air_conditioner_filter_options_en[$attributeKey]['options'][$optionKey],
                                'created_at' => now(),
                                'updated_at' => now(),
                            ]);
                        }
                    }
                }
            } elseif ($sub->slug == 'other-1') {
                foreach ($attribute_other_1_ar as $attributeKey => $attribute) {

                    $parnetAttribute = Attribute::create([
                        'name_ar' => $attribute,
                        'name_en' => $attribute_other_1_en[$attributeKey],
                        'sub_activity_id' => $sub->id,
                        'type' => $attribute_other_1_options_ar[$attributeKey]['type'],
                        'created_at' => now(),
                        'updated_at' => now(),
                    ]);
                    if ($attribute_other_1_options_ar[$attributeKey]['type'] == 'select') {

                        foreach ($attribute_other_1_options_ar[$attributeKey]['options'] as $optionKey => $option) {
                            $parnetAttribute->options()->create([
                                'name_ar' => $option,
                                'name_en' => $attribute_other_1_options_en[$attributeKey]['options'][$optionKey],
                                'created_at' => now(),
                                'updated_at' => now(),
                            ]);
                        }
                    }
                }
            } elseif ($sub->slug == 'machine-processor') {
                foreach ($attribute_machine_processor_ar as $attributeKey => $attribute) {

                    $parnetAttribute = Attribute::create([
                        'name_ar' => $attribute,
                        'name_en' => $attribute_machine_processor_en[$attributeKey],
                        'sub_activity_id' => $sub->id,
                        'type' => $attribute_machine_processor_options_ar[$attributeKey]['type'],
                        'created_at' => now(),
                        'updated_at' => now(),
                    ]);
                    if ($attribute_machine_processor_options_ar[$attributeKey]['type'] == 'select') {

                        foreach ($attribute_machine_processor_options_ar[$attributeKey]['options'] as $optionKey => $option) {
                            $parnetAttribute->options()->create([
                                'name_ar' => $option,
                                'name_en' => $attribute_machine_processor_options_en[$attributeKey]['options'][$optionKey],
                                'created_at' => now(),
                                'updated_at' => now(),
                            ]);
                        }
                    }
                }
            } elseif ($sub->slug == 'gear-processor') {
                foreach ($attribute_gear_processor_ar as $attributeKey => $attribute) {

                    $parnetAttribute = Attribute::create([
                        'name_ar' => $attribute,
                        'name_en' => $attribute_gear_processor_en[$attributeKey],
                        'sub_activity_id' => $sub->id,
                        'type' => $attribute_gear_processor_options_ar[$attributeKey]['type'],
                        'created_at' => now(),
                        'updated_at' => now(),
                    ]);
                    if ($attribute_gear_processor_options_ar[$attributeKey]['type'] == 'select') {

                        foreach ($attribute_gear_processor_options_ar[$attributeKey]['options'] as $optionKey => $option) {
                            $parnetAttribute->options()->create([
                                'name_ar' => $option,
                                'name_en' => $attribute_gear_processor_options_en[$attributeKey]['options'][$optionKey],
                                'created_at' => now(),
                                'updated_at' => now(),
                            ]);
                        }
                    }
                }
            } elseif ($sub->slug == 'difference-wizard') {
                foreach ($attribute_difference_wizard_ar as $attributeKey => $attribute) {

                    $parnetAttribute = Attribute::create([
                        'name_ar' => $attribute,
                        'name_en' => $attribute_difference_wizard_en[$attributeKey],
                        'sub_activity_id' => $sub->id,
                        'type' => $attribute_difference_wizard_options_ar[$attributeKey]['type'],
                        'created_at' => now(),
                        'updated_at' => now(),
                    ]);
                    if ($attribute_difference_wizard_options_ar[$attributeKey]['type'] == 'select') {

                        foreach ($attribute_difference_wizard_options_ar[$attributeKey]['options'] as $optionKey => $option) {
                            $parnetAttribute->options()->create([
                                'name_ar' => $option,
                                'name_en' => $attribute_difference_wizard_options_en[$attributeKey]['options'][$optionKey],
                                'created_at' => now(),
                                'updated_at' => now(),
                            ]);
                        }
                    }
                }
            } elseif ($sub->slug == 'drakeson-wizard') {
                foreach ($attribute_drakeson_wizard_ar as $attributeKey => $attribute) {

                    $parnetAttribute = Attribute::create([
                        'name_ar' => $attribute,
                        'name_en' => $attribute_drakeson_wizard_en[$attributeKey],
                        'sub_activity_id' => $sub->id,
                        'type' => $attribute_drakeson_wizard_options_ar[$attributeKey]['type'],
                        'created_at' => now(),
                        'updated_at' => now(),
                    ]);
                    if ($attribute_drakeson_wizard_options_ar[$attributeKey]['type'] == 'select') {

                        foreach ($attribute_drakeson_wizard_options_ar[$attributeKey]['options'] as $optionKey => $option) {
                            $parnetAttribute->options()->create([
                                'name_ar' => $option,
                                'name_en' => $attribute_drakeson_wizard_options_en[$attributeKey]['options'][$optionKey],
                                'created_at' => now(),
                                'updated_at' => now(),
                            ]);
                        }
                    }
                }
            } elseif ($sub->slug == 'other-2') {
                foreach ($attribute_other_2_ar as $attributeKey => $attribute) {

                    $parnetAttribute = Attribute::create([
                        'name_ar' => $attribute,
                        'name_en' => $attribute_other_2_en[$attributeKey],
                        'sub_activity_id' => $sub->id,
                        'type' => $attribute_other_2_options_ar[$attributeKey]['type'],
                        'created_at' => now(),
                        'updated_at' => now(),
                    ]);
                    if ($attribute_other_2_options_ar[$attributeKey]['type'] == 'select') {

                        foreach ($attribute_other_2_options_ar[$attributeKey]['options'] as $optionKey => $option) {
                            $parnetAttribute->options()->create([
                                'name_ar' => $option,
                                'name_en' => $attribute_other_2_options_en[$attributeKey]['options'][$optionKey],
                                'created_at' => now(),
                                'updated_at' => now(),
                            ]);
                        }
                    }
                }
            } elseif ($sub->slug == 'wrenches') {
                foreach ($attribute_wrenches_ar as $attributeKey => $attribute) {

                    $parnetAttribute = Attribute::create([
                        'name_ar' => $attribute,
                        'name_en' => $attribute_wrenches_en[$attributeKey],
                        'sub_activity_id' => $sub->id,
                        'type' => $attribute_wrenches_options_ar[$attributeKey]['type'],
                        'created_at' => now(),
                        'updated_at' => now(),
                    ]);
                    if ($attribute_wrenches_options_ar[$attributeKey]['type'] == 'select') {

                        foreach ($attribute_wrenches_options_ar[$attributeKey]['options'] as $optionKey => $option) {
                            $parnetAttribute->options()->create([
                                'name_ar' => $option,
                                'name_en' => $attribute_wrenches_options_en[$attributeKey]['options'][$optionKey],
                                'created_at' => now(),
                                'updated_at' => now(),
                            ]);
                        }
                    }
                }
            } elseif ($sub->slug == 'screwdrivers') {
                foreach ($attribute_screwdrivers_ar as $attributeKey => $attribute) {

                    $parnetAttribute = Attribute::create([
                        'name_ar' => $attribute,
                        'name_en' => $attribute_screwdrivers_en[$attributeKey],
                        'sub_activity_id' => $sub->id,
                        'type' => $attribute_screwdrivers_options_ar[$attributeKey]['type'],
                        'created_at' => now(),
                        'updated_at' => now(),
                    ]);
                    if ($attribute_screwdrivers_options_ar[$attributeKey]['type'] == 'select') {

                        foreach ($attribute_screwdrivers_options_ar[$attributeKey]['options'] as $optionKey => $option) {
                            $parnetAttribute->options()->create([
                                'name_ar' => $option,
                                'name_en' => $attribute_screwdrivers_options_en[$attributeKey]['options'][$optionKey],
                                'created_at' => now(),
                                'updated_at' => now(),
                            ]);
                        }
                    }
                }
            } elseif ($sub->slug == 'electronics') {
                foreach ($attribute_electronics_ar as $attributeKey => $attribute) {

                    $parnetAttribute = Attribute::create([
                        'name_ar' => $attribute,
                        'name_en' => $attribute_electronics_en[$attributeKey],
                        'sub_activity_id' => $sub->id,
                        'type' => $attribute_electronics_options_ar[$attributeKey]['type'],
                        'created_at' => now(),
                        'updated_at' => now(),
                    ]);
                    if ($attribute_electronics_options_ar[$attributeKey]['type'] == 'select') {

                        foreach ($attribute_electronics_options_ar[$attributeKey]['options'] as $optionKey => $option) {
                            $parnetAttribute->options()->create([
                                'name_ar' => $option,
                                'name_en' => $attribute_electronics_options_en[$attributeKey]['options'][$optionKey],
                                'created_at' => now(),
                                'updated_at' => now(),
                            ]);
                        }
                    }
                }
            } elseif ($sub->slug == 'air-conditioning') {
                foreach ($attribute_air_conditioning_ar as $attributeKey => $attribute) {

                    $parnetAttribute = Attribute::create([
                        'name_ar' => $attribute,
                        'name_en' => $attribute_air_conditioning_en[$attributeKey],
                        'sub_activity_id' => $sub->id,
                        'type' => $attribute_air_conditioning_options_ar[$attributeKey]['type'],
                        'created_at' => now(),
                        'updated_at' => now(),
                    ]);
                    if ($attribute_air_conditioning_options_ar[$attributeKey]['type'] == 'select') {

                        foreach ($attribute_air_conditioning_options_ar[$attributeKey]['options'] as $optionKey => $option) {
                            $parnetAttribute->options()->create([
                                'name_ar' => $option,
                                'name_en' => $attribute_air_conditioning_options_en[$attributeKey]['options'][$optionKey],
                                'created_at' => now(),
                                'updated_at' => now(),
                            ]);
                        }
                    }
                }
            } elseif ($sub->slug == 'other-3') {
                foreach ($attribute_other_3_ar as $attributeKey => $attribute) {

                    $parnetAttribute = Attribute::create([
                        'name_ar' => $attribute,
                        'name_en' => $attribute_other_3_en[$attributeKey],
                        'sub_activity_id' => $sub->id,
                        'type' => $attribute_other_3_options_ar[$attributeKey]['type'],
                        'created_at' => now(),
                        'updated_at' => now(),
                    ]);
                    if ($attribute_other_3_options_ar[$attributeKey]['type'] == 'select') {

                        foreach ($attribute_other_3_options_ar[$attributeKey]['options'] as $optionKey => $option) {
                            $parnetAttribute->options()->create([
                                'name_ar' => $option,
                                'name_en' => $attribute_other_3_options_en[$attributeKey]['options'][$optionKey],
                                'created_at' => now(),
                                'updated_at' => now(),
                            ]);
                        }
                    }
                }
            } elseif ($sub->slug == 'radiator-water') {
                foreach ($attribute_radiator_water_ar as $attributeKey => $attribute) {

                    $parnetAttribute = Attribute::create([
                        'name_ar' => $attribute,
                        'name_en' => $attribute_radiator_water_en[$attributeKey],
                        'sub_activity_id' => $sub->id,
                        'type' => $attribute_radiator_water_options_ar[$attributeKey]['type'],
                        'created_at' => now(),
                        'updated_at' => now(),
                    ]);
                    if ($attribute_radiator_water_options_ar[$attributeKey]['type'] == 'select') {

                        foreach ($attribute_radiator_water_options_ar[$attributeKey]['options'] as $optionKey => $option) {
                            $parnetAttribute->options()->create([
                                'name_ar' => $option,
                                'name_en' => $attribute_radiator_water_options_en[$attributeKey]['options'][$optionKey],
                                'created_at' => now(),
                                'updated_at' => now(),
                            ]);
                        }
                    }
                }
            } elseif ($sub->slug == 'sealant') {
                foreach ($attribute_sealant_ar as $attributeKey => $attribute) {

                    $parnetAttribute = Attribute::create([
                        'name_ar' => $attribute,
                        'name_en' => $attribute_sealant_en[$attributeKey],
                        'sub_activity_id' => $sub->id,
                        'type' => $attribute_sealant_options_ar[$attributeKey]['type'],
                        'created_at' => now(),
                        'updated_at' => now(),
                    ]);
                    if ($attribute_sealant_options_ar[$attributeKey]['type'] == 'select') {

                        foreach ($attribute_sealant_options_ar[$attributeKey]['options'] as $optionKey => $option) {
                            $parnetAttribute->options()->create([
                                'name_ar' => $option,
                                'name_en' => $attribute_sealant_options_en[$attributeKey]['options'][$optionKey],
                                'created_at' => now(),
                                'updated_at' => now(),
                            ]);
                        }
                    }
                }
            } elseif ($sub->slug == 'radiator-cleaner') {
                foreach ($attribute_radiator_cleaner_ar as $attributeKey => $attribute) {

                    $parnetAttribute = Attribute::create([
                        'name_ar' => $attribute,
                        'name_en' => $attribute_radiator_cleaner_en[$attributeKey],
                        'sub_activity_id' => $sub->id,
                        'type' => $attribute_radiator_cleaner_options_ar[$attributeKey]['type'],
                        'created_at' => now(),
                        'updated_at' => now(),
                    ]);
                    if ($attribute_radiator_cleaner_options_ar[$attributeKey]['type'] == 'select') {

                        foreach ($attribute_radiator_cleaner_options_ar[$attributeKey]['options'] as $optionKey => $option) {
                            $parnetAttribute->options()->create([
                                'name_ar' => $option,
                                'name_en' => $attribute_radiator_cleaner_options_en[$attributeKey]['options'][$optionKey],
                                'created_at' => now(),
                                'updated_at' => now(),
                            ]);
                        }
                    }
                }
            } elseif ($sub->slug == 'colent') {
                foreach ($attribute_colent_ar as $attributeKey => $attribute) {

                    $parnetAttribute = Attribute::create([
                        'name_ar' => $attribute,
                        'name_en' => $attribute_colent_en[$attributeKey],
                        'sub_activity_id' => $sub->id,
                        'type' => $attribute_colent_options_ar[$attributeKey]['type'],
                        'created_at' => now(),
                        'updated_at' => now(),
                    ]);
                    if ($attribute_colent_options_ar[$attributeKey]['type'] == 'select') {

                        foreach ($attribute_colent_options_ar[$attributeKey]['options'] as $optionKey => $option) {
                            $parnetAttribute->options()->create([
                                'name_ar' => $option,
                                'name_en' => $attribute_colent_options_en[$attributeKey]['options'][$optionKey],
                                'created_at' => now(),
                                'updated_at' => now(),
                            ]);
                        }
                    }
                }
            } elseif ($sub->slug == 'other-4') {
                foreach ($attribute_other_4_ar as $attributeKey => $attribute) {

                    $parnetAttribute = Attribute::create([
                        'name_ar' => $attribute,
                        'name_en' => $attribute_other_4_en[$attributeKey],
                        'sub_activity_id' => $sub->id,
                        'type' => $attribute_other_4_options_ar[$attributeKey]['type'],
                        'created_at' => now(),
                        'updated_at' => now(),
                    ]);
                    if ($attribute_other_4_options_ar[$attributeKey]['type'] == 'select') {

                        foreach ($attribute_other_4_options_ar[$attributeKey]['options'] as $optionKey => $option) {
                            $parnetAttribute->options()->create([
                                'name_ar' => $option,
                                'name_en' => $attribute_other_4_options_en[$attributeKey]['options'][$optionKey],
                                'created_at' => now(),
                                'updated_at' => now(),
                            ]);
                        }
                    }
                }
            }
        }
    }
}
