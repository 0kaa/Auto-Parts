<?php

namespace Database\Seeders;

use App\Models\PaymentMethod;
use Illuminate\Database\Seeder;

class PaymentMethodsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        PaymentMethod::insert([
            [
                'name_ar' => 'الدفع عند الاستلام',
                'name_en' => 'Payment on delivery',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name_ar' => 'دفع الكتروني',
                'name_en' => 'Payment online',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
