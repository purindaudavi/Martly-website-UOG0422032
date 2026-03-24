<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\Product;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Delete all existing users and products to start fresh
        User::truncate();
        Product::truncate();

        // Create our three main users
        $admin = User::factory()->create([
            'name' => 'Admin User',
            'email' => 'admin@martly.com',
            'password' => Hash::make('password'),
            'role' => 'admin'
        ]);

        $vendor = User::factory()->create([
            'name' => 'Vendor User',
            'email' => 'vendor@martly.com',
            'password' => Hash::make('password'),
            'role' => 'vendor'
        ]);

        $customer = User::factory()->create([
            'name' => 'Customer User',
            'email' => 'customer@martly.com',
            'password' => Hash::make('password'),
            'role' => 'customer'
        ]);

        // Create our products and assign them to the Vendor
        // IMPORTANT: We now include the 'vendor_id' to link the product to the vendor user.
        Product::create([
            'name' => 'Organic Chicken Breast',
            'description' => '100% organic, hormone-free chicken breast.',
            'price' => 12.99,
            'image' => 'organic-chicken.jpg',
            'category' => 'meat-seafood',
            'is_deal' => true,
            'vendor_id' => $vendor->id,
        ]);

        Product::create([
            'name' => 'Atlantic Salmon Fillet',
            'description' => 'Freshly caught Atlantic salmon, rich in Omega-3.',
            'price' => 15.50,
            'image' => 'salmon.jpg',
            'category' => 'meat-seafood',
            'is_deal' => false,
            'vendor_id' => $vendor->id,
        ]);

        Product::create([
            'name' => 'Almond Milk',
            'description' => 'Dairy-free almond milk, great for cereal and smoothies.',
            'price' => 3.99,
            'image' => 'almond-milk.jpg',
            'category' => 'dairy-alternatives',
            'is_deal' => false,
            'vendor_id' => $vendor->id,
        ]);

        Product::create([
            'name' => 'Fresh Strawberries',
            'description' => 'Sweet, juicy strawberries, locally sourced.',
            'price' => 4.50,
            'image' => 'strawberries.jpg',
            'category' => 'fruits-vegetables',
            'is_deal' => true,
            'vendor_id' => $vendor->id,
        ]);

        Product::create([
            'name' => 'Organic Spinach',
            'description' => 'A bunch of crisp, leafy organic spinach.',
            'price' => 2.25,
            'image' => 'spinach.jpg',
            'category' => 'fruits-vegetables',
            'is_deal' => false,
            'vendor_id' => $vendor->id,
        ]);

        Product::create([
            'name' => 'Artisan Bread',
            'description' => 'Freshly baked artisan sourdough bread.',
            'price' => 5.99,
            'image' => 'artisan-bread.jpg',
            'category' => 'bakery',
            'is_deal' => false,
            'vendor_id' => $vendor->id,
        ]);
    }
}