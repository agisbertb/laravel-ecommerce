<?php

namespace Database\Seeders;

use App\Models\Tag;
use Illuminate\Database\Seeder;

class TagSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
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
    }
}
