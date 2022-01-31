<?php

namespace Database\Seeders;

use App\Models\OrderStatus;
use Illuminate\Database\Seeder;

class OrderStatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        OrderStatus::insert([
            [
                'name_en' => 'pending',
                'name_ar' => 'قيد الانتظار',
                'slug' => 'pending',
            ],
            [
                'name_en' => 'accepted',
                'name_ar' => 'تم قبول الطلب',
                'slug' => 'accepted',
            ],
            [
                'name_en' => 'processing',
                'name_ar' => 'تجهيز الطلب',
                'slug' => 'processing',
            ],
            [
                'name_en' => 'completed',
                'name_ar' => 'تم التسليم',
                'slug' => 'completed',
            ],
            [
                'name_en' => 'cancelled',
                'name_ar' => 'تم الغاء الطلب',
                'slug' => 'cancelled',
            ],
        ]);
    }
}
