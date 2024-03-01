<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Category;
use App\Models\Product;
use App\Models\Tag;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        User::create([
            'name' => 'Admin User',
            'email' => 'agisbert@iesebre.com',
            'password' => Hash::make('12345678'),
            'admin' => 1,
        ]);

        User::create([
            'name' => 'Test User',
            'email' => 'pringao@iesebre.com',
            'password' => Hash::make('12345678'),
            'admin' => null,
        ]);

        $categories = [
            [
                'name' => 'category1',
                'description' => 'TEST1 TEST1 TEST1',
            ],
            [
                'name' => 'category2',
                'description' => 'TEST2 TEST2 TEST2',
            ],
            [
                'name' => 'category3',
                'description' => 'TEST3 TEST3 TEST3',
            ],
        ];
        Category::insert($categories);

        $tags = [
            [
                'name' => 'tag1',
                'description' => 'TEST1 TEST1 TEST1',
            ],
            [
                'name' => 'tag2',
                'description' => 'TEST2 TEST2 TEST2',
            ],
            [
                'name' => 'tag3',
                'description' => 'TEST3 TEST3 TEST3',
            ],
        ];
        Tag::insert($tags);

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
