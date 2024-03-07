<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
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
    }
}