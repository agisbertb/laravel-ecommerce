<?php


use App\Models\Address;
use App\Models\Category;
use App\Models\Product;
use App\Models\ShippingOption;
use App\Models\User;
use App\Models\Tag;

use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;


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
    function create_product($suffix = null)
    {
        $suffix = $suffix ?? uniqid();
        $name = 'Product ' . $suffix;
        $product = Product::create([
            'name' => $name,
            'description' => 'Description of ' . $name,
            'price' => 100,
            'stock' => 10,
            'slug' => Str::slug($name),
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
            'slug' => 'category1',
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

    if (!function_exists('create_default_user_and_address')) {
        function create_default_user_and_address()
        {
            $user = User::create([
                'name' => 'User address',
                'email' => 'useraddress@example.com',
                'password' => Hash::make('12345678'),
            ]);

            $address = Address::create([
                'user_id' => $user->id,
                'name' => 'House',
                'type' => 'Shipping',
                'address' => 'Street 123',
                'city' => 'Bcn',
                'state' => 'Cat',
                'country' => 'Spain',
                'zip_code' => '12345',
                'default' => true,
            ]);

            return ['user' => $user, 'address' => $address];
        }
    }

    if (!function_exists('create_address')) {
        function create_address($user)
        {
            $address = Address::create([
                'user_id' => $user->id,
                'name' => 'House',
                'type' => 'Shipping',
                'address' => 'Street 123',
                'city' => 'Bcn',
                'state' => 'Cat',
                'country' => 'Spain',
                'zip_code' => '12345',
                'default' => true,
            ]);

            return $address;
        }
    }

    if (!function_exists('create_shipping_option')) {
        function create_shipping_option($name = 'Standard Shipping')
        {
            return ShippingOption::create([
                'name' => $name,
                'price' => 10.00,
                'estimated_delivery' => '3-5 business days',
            ]);
        }
    }
}
