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
            [
                'name_en' => 'paid',
                'name_ar' => 'تم الدفع',
                'slug'    => 'paid'
            ],
            [
                'name_en' => 'unpaid',
                'name_ar' => 'لم يتم الدفع',
                'slug'    => 'unpaid'
            ],
            [
                'name_en' => 'seller accepted order',
                'name_ar' => 'تم قبول الطلب من البائع',
                'slug'    => 'seller_accepted'
            ],
            [
                'name_en' => 'seller rejected order',
                'name_ar' => 'تم رفض الطلب من البائع',
                'slug'    => 'seller_rejected'
            ],
            [
                'name_en' => 'rejected',
                'name_ar' => 'تم رفض الطلب',
                'slug'    => 'rejected'
            ],
            [
                'name_en' => 'not found',
                'name_ar' => 'لم يتم العثور على الطلب',
                'slug'    => 'not_found'
            ]
        ]);
    }
}
