<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request; // Make sure this line is at the top!

class ProductController extends Controller
{
    public function index()
    {
        return view('products.index'); // Your existing index method
    }

    // Helper method to get ALL products as a single, flat list for searching
    private function getAllProducts()
    {
        // This function combines all your dummy product data from ALL categories.
        // In a real application, this would query your database to get all products.
        return [
            // Example: Meat & Seafood Products (ensure ALL your details like 'id', 'category' are here)
            [
                'id' => 1,
                'name' => 'Organic Chicken Breast',
                'category' => 'meat-seafood', // IMPORTANT: Add 'category' key
                'image' => 'chicken-breast.jpg',
                'price' => '$15.99',
                'description' => '2lb pack of fresh, organic chicken breast.',
            ],
            [
                'id' => 2,
                'name' => 'Wild-Caught Salmon Fillet',
                'category' => 'meat-seafood', // IMPORTANT: Add 'category' key
                'image' => 'salmon-fillet.jpg',
                'price' => '$19.50',
                'description' => 'Premium wild-caught salmon, rich in Omega-3s.',
            ],
            [
                'id' => 3,
                'name' => 'Grass-Fed Ground Beef',
                'category' => 'meat-seafood', // IMPORTANT: Add 'category' key
                'image' => 'ground-beef.jpg',
                'price' => '$9.99',
                'description' => '1lb pack, 85/15 lean, pasture-raised.',
            ],
            // Add ALL your 'snacks-bars-treats' products here
            [
                'id' => 4,
                'name' => 'Organic Granola Bars',
                'category' => 'snacks-bars-treats', // IMPORTANT: Add 'category' key
                'image' => 'granola-bars.jpg',
                'price' => '$6.49',
                'description' => '5-pack, gluten-free, energy-boosting.',
            ],
            [
                'id' => 5,
                'name' => 'Almond Butter Filled Pretzels',
                'category' => 'snacks-bars-treats', // IMPORTANT: Add 'category' key
                'image' => 'almond-pretzels.jpg',
                'price' => '$4.99',
                'description' => 'Crunchy pretzels with creamy almond butter.',
            ],
            // Add ALL your 'beverages' products here
            [
                'id' => 6,
                'name' => 'Sparkling Apple Cider',
                'category' => 'beverages', // IMPORTANT: Add 'category' key
                'image' => 'apple-cider.jpg',
                'price' => '$3.00',
                'description' => 'Crisp and refreshing, naturally carbonated.',
            ],
            // Add ALL your 'frozen' products here
            [
                'id' => 7,
                'name' => 'Organic Mixed Berries',
                'category' => 'frozen', // IMPORTANT: Add 'category' key
                'image' => 'mixed-berries.jpg',
                'price' => '$7.99',
                'description' => 'Perfect for smoothies and desserts.',
            ],
            // Add ALL your 'wine' products here
            [
                'id' => 8,
                'name' => 'Organic Red Blend',
                'category' => 'wine', // IMPORTANT: Add 'category' key
                'image' => 'red-wine.jpg',
                'price' => '$18.00',
                'description' => 'Smooth and fruity, perfect for any occasion.',
            ],
            // Add ALL your 'household-cleaning' products here
            [
                'id' => 9,
                'name' => 'Eco-Friendly Laundry Pods',
                'category' => 'household-cleaning', // IMPORTANT: Add 'category' key
                'image' => 'laundry-pods.jpg',
                'price' => '$12.50',
                'description' => 'Plant-based, powerful cleaning, 50 loads.',
            ],
            // Add ALL your 'trending-now' products here
            [
                'id' => 10,
                'name' => 'Keto-Friendly Protein Powder',
                'category' => 'trending-now', // IMPORTANT: Add 'category' key
                'image' => 'protein-powder.jpg',
                'price' => '$29.99',
                'description' => 'Vanilla flavored, 20g protein per serving.',
            ],
            // Add ALL your 'vitamins-supplements' products here
            [
                'id' => 11,
                'name' => 'Vitamin D3 + K2 Complex',
                'category' => 'vitamins-supplements', // IMPORTANT: Add 'category' key
                'image' => 'vitamins-d3k2.jpg',
                'price' => '$18.75',
                'description' => 'Supports bone and immune health, 60 capsules.',
            ],
            // ... CONTINUE ADDING ALL YOUR OTHER DUMMY PRODUCTS HERE IN A FLAT LIST ...
            // Make sure each product has at least 'id', 'name', 'category', 'image', 'price', 'description'
        ];
    }

    // NEW Search Method: Handles product search queries
    public function search(Request $request)
    {
        $query = $request->input('query'); // Get the search term from the input field
        $allProducts = $this->getAllProducts(); // Get all dummy products from the unified list

        $searchResults = [];

        if ($query) {
            $searchResults = array_filter($allProducts, function ($product) use ($query) {
                // Convert both product name/description and query to lowercase for case-insensitive search
                $name = strtolower($product['name']);
                $description = strtolower($product['description']);
                $lowerQuery = strtolower($query);

                // Check if the query is present in the product name or description
                return str_contains($name, $lowerQuery) || str_contains($description, $lowerQuery);
            });
        }

        return view('products.search-results', [
            'products' => $searchResults,
            'searchQuery' => $query,
        ]);
    }

    // Your existing showCategory method:
    public function showCategory($category)
    {
        // This method will now get products by category using the getAllProducts() and filtering it
        $categoryName = ucwords(str_replace('-', ' ', $category));
        $products = array_filter($this->getAllProducts(), fn($product) => $product['category'] === $category);

        return view('products.category', compact('products', 'categoryName'));
    }


    private function getAllDeals()
    {
        return [
            [
                'id' => 1,
                'name' => 'Organic Blueberries (25% OFF)',
                'image' => 'blueberries.jpg', // Make sure you have this image in public/images/products/
                'original_price' => 7.99,
                'discount_percentage' => 25,
                'description' => 'Fresh, organic blueberries. Perfect for snacks or baking.',
                'brand' => 'Berry Farms',
                'rating' => 4.7
            ],
            [
                'id' => 2,
                'name' => 'Almond Milk (10% OFF)',
                'image' => 'almond-milk.jpg', // Make sure you have this image
                'original_price' => 4.50,
                'discount_percentage' => 10,
                'description' => 'Unsweetened almond milk. A dairy-free alternative.',
                'brand' => 'NutriDairy',
                'rating' => 4.2
            ],
            [
                'id' => 3,
                'name' => 'Whole Grain Bread (20% OFF)',
                'image' => 'whole-grain-bread.jpg', // Make sure you have this image
                'original_price' => 3.75,
                'discount_percentage' => 20,
                'description' => 'Freshly baked whole grain bread, great for sandwiches.',
                'brand' => 'Bakery Fresh',
                'rating' => 4.0
            ],
            [
                'id' => 4,
                'name' => 'Sparkling Water Variety Pack (15% OFF)',
                'image' => 'sparkling-water-pack.jpg', // Make sure you have this image
                'original_price' => 12.00,
                'discount_percentage' => 15,
                'description' => '12-pack of assorted flavored sparkling water.',
                'brand' => 'Fizz & Quench',
                'rating' => 4.5
            ],
            // Add more dummy deal products here
        ];
    }

    // NEW Deals Method: Displays the deals page
    public function deals()
    {
        $deals = $this->getAllDeals(); // Get your dummy deal data

        // Calculate discounted price for each deal
        foreach ($deals as &$deal) { // Use & to modify the original array item
            $discountAmount = $deal['original_price'] * ($deal['discount_percentage'] / 100);
            $deal['discounted_price'] = $deal['original_price'] - $discountAmount;
            // Format prices for display (optional, but good practice)
            $deal['formatted_original_price'] = '$' . number_format($deal['original_price'], 2);
            $deal['formatted_discounted_price'] = '$' . number_format($deal['discounted_price'], 2);
        }
        unset($deal); // Break the reference of the last element

        return view('deals.index', compact('deals'));
    }

    // Your existing getProductsByCategory method is no longer needed as getAllProducts handles it
    // You can remove or comment out this entire method if you only use showCategory to display
    // private function getProductsByCategory($category)
    // {
    //     // This method's logic is now integrated into getAllProducts and showCategory filtering.
    //     // You can remove this method.
    // }
}