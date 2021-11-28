<?php

namespace Database\Seeders;

use App\Models\Shipping;
use Illuminate\Database\Seeder;

class ShippingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Shipping::insert(
            [
                [
                    'shipping_name_ar' => 'توصيل إلي المنزل',
                    'shipping_name_en' => 'Home Delivery',
                ],
                [
                    'shipping_name_ar' => 'توصيل إلي الورشة',
                    'shipping_name_en' => 'Delivery to the workshop',
                ],
                [
                    'shipping_name_ar' => 'استلام من الفرع',
                    'shipping_name_en' => 'Receipt from the branch',
                ],
                [
                    'shipping_name_ar' => 'توصيل إلى مكان آخر',
                    'shipping_name_en' => 'Delivery to another place',
                ],
            ]
        );
    }
}
