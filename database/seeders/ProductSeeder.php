<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Product;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $products = [
            [
                'name' => 'product1',
                'description' => 'TEST1 TEST1 TEST1',
                'price' => 10.0,
                'stock' => 10,
                'image' => 'product1.jpg',
            ],
            [
                'name' => 'product2',
                'description' => 'TEST2 TEST2 TEST2',
                'price' => 20.0,
                'stock' => 20,
                'image' => 'product2.jpg',
            ],
            [
                'name' => 'product3',
                'description' => 'TEST3 TEST3 TEST3',
                'price' => 30.0,
                'stock' => 30,
                'image' => 'product3.jpg',
            ],
        ];

        Product::insert($products);
    }
}
