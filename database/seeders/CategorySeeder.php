<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            [
                'name' => 'category1',
                'description' => 'TEST1 TEST1 TEST1',
                'slug' => 'category1',
            ],
            [
                'name' => 'category2',
                'description' => 'TEST2 TEST2 TEST2',
                'slug' => 'category2',
            ],
            [
                'name' => 'category3',
                'description' => 'TEST3 TEST3 TEST3',
                'slug' => 'category3',
            ],
        ];
        Category::insert($categories);
    }
}
