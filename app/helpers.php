<?php


use App\Models\Category;
use App\Models\Product;
use App\Models\User;
use App\Models\Tag;

use Illuminate\Support\Facades\Hash;


if (!function_exists('create_admin_user')) {
    function create_admin_user()
    {
        $adminUser = User::factory()->create([
            'name' => 'Admin User',
            'email' => 'admin@admin.com',
            'password' => Hash::make('12345678'),
            'admin' => 1,
        ]);

        $adminUser->save();
        return $adminUser;
    }
}

if (!function_exists('create_default_user')) {
    function create_default_user()
    {
        $regularUser = User::factory()->create([
            'name' => 'Regular User',
            'email' => 'user@example.com',
            'password' => Hash::make('12345678'),
            'admin' => 0,
        ]);

        $regularUser->save();
        return $regularUser;
    }
}

if (!function_exists('create_product')) {
    function create_product()
    {
        $product = Product::create([
            'name' => 'Product 1',
            'description' => 'Description of product 1',
            'price' => 100,
            'stock' => 10,
        ]);

        $product->save();
        return $product;
    }
}

if (!function_exists('create_category')) {
    function create_category()
    {
        $category = Category::create([
            'name' => 'Category 1',
            'description' => 'Description of category 1',
        ]);

        $category->save();
        return $category;
    }
}

if (!function_exists('create_tag')) {
    function create_tag()
    {
        $tag = Tag::create([
            'name' => 'Tag 1',
            'description' => 'Description of tag 1',
        ]);

        $tag->save();
        return $tag;
    }
}

if (!function_exists('create_user')) {
    function create_user()
    {
        $user = User::create([
            'name' => 'User',
            'email' => 'user1@example.com',
            'password' => Hash::make('12345678'),
            'admin' => 0,
        ]);

        $user->save();
        return $user;
    }
}