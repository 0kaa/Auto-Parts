<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Product::insert([
            [
                'name' => 'Product 1',
                'description' => 'Product 1 description',
                'price' => '100',
                'image' => 'product1.jpg',
                'seller_id' => 2,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Product 2',
                'description' => 'Product 2 description',
                'price' => '200',
                'image' => 'product2.jpg',
                'seller_id' => 2,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Product 3',
                'description' => 'Product 3 description',
                'price' => '300',
                'image' => 'product3.jpg',
                'seller_id' => 2,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Product 4',
                'description' => 'Product 4 description',
                'price' => '400',
                'image' => 'product4.jpg',
                'seller_id' => 2,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Product 5',
                'description' => 'Product 5 description',
                'price' => '500',
                'image' => 'product5.jpg',
                'seller_id' => 2,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Product 6',
                'description' => 'Product 6 description',
                'price' => '600',
                'image' => 'product6.jpg',
                'seller_id' => 2,
                'created_at' => now(),
                'updated_at' => now(),
            ],

        ]);
    }
}
