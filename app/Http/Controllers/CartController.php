<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class CartController extends Controller
{
    /**
     * Add an item to the cart.
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function addToCart(Request $request)
    {
        $productId = $request->input('product_id');
        $productName = $request->input('name');
        $productPrice = $request->input('price');
        $productImage = $request->input('image');
        $quantity = $request->input('quantity', 1); // Default to 1 if not provided

        $cart = Session::get('cart', []); // Get current cart or an empty array

        // Check if item already exists in cart, then update quantity
        if (isset($cart[$productId])) {
            $cart[$productId]['quantity'] += $quantity;
        } else {
            // Add new item to cart
            $cart[$productId] = [
                'id' => $productId,
                'name' => $productName,
                'price' => $productPrice,
                'image' => $productImage,
                'quantity' => $quantity
            ];
        }

        Session::put('cart', $cart); // Save the updated cart back to session

        $cartCount = count($cart); // Get the number of unique items in cart

        // You might want to return a more detailed response for frontend, e.g., total, item added.
        return response()->json([
            'message' => 'Item added to cart successfully!',
            'cartCount' => $cartCount
        ]);
    }

    /**
     * Get the current count of items in the cart.
     * @return \Illuminate\Http\JsonResponse
     */
    public function getCartCount()
    {
        $cart = Session::get('cart', []);
        $count = count($cart); // This counts unique items. If you want total quantity, loop through $cart and sum quantities.

        // Example to get total quantity of all items:
        // $totalQuantity = 0;
        // foreach ($cart as $item) {
        //     $totalQuantity += $item['quantity'];
        // }
        // $count = $totalQuantity;

        return response()->json(['count' => $count]);
    }

    /**
     * Display the shopping cart.
     * (We'll create this view later)
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $cart = Session::get('cart', []);
        return view('cart.index', compact('cart'));
    }

    // You might add methods like updateCartItem, removeCartItem, clearCart later
}