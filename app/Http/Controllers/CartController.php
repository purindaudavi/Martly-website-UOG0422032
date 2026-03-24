<?php

namespace App\Http\Controllers;

use App\Models\Order; // NEW: Import the Order model
use App\Models\OrderItem; // NEW: Import the OrderItem model
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use App\Models\Product;
use Illuminate\Support\Facades\Auth; // NEW: Import the Auth facade

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
        $quantityToAdd = $request->input('quantity', 1);

        $product = Product::find($productId);
        if (!$product || $product->quantity < $quantityToAdd) {
            return response()->json([
                'message' => 'Sorry, there is not enough stock for this item. Only ' . ($product ? $product->quantity : 0) . ' remaining.'
            ], 400);
        }

        $cart = Session::get('cart', []);

        if (isset($cart[$productId])) {
            $currentCartQuantity = $cart[$productId]['quantity'];
            $totalRequestedQuantity = $currentCartQuantity + $quantityToAdd;
            
            if ($product->quantity < $totalRequestedQuantity) {
                return response()->json([
                    'message' => 'Sorry, you cannot add more of this item. You already have ' . $currentCartQuantity . ' in your cart and only ' . ($product->quantity - $currentCartQuantity) . ' more are available.'
                ], 400);
            }
            
            $cart[$productId]['quantity'] = $totalRequestedQuantity;
            $message = 'Quantity updated in cart!';
        } else {
            $cart[$productId] = [
                'id' => $productId,
                'name' => $productName,
                'price' => $productPrice,
                'image' => $productImage,
                'quantity' => $quantityToAdd
            ];
            $message = 'Item added to cart!';
        }

        Session::put('cart', $cart);

        $cartCount = array_sum(array_column($cart, 'quantity'));

        return response()->json([
            'message' => $message,
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
        $count = array_sum(array_column($cart, 'quantity'));
        return response()->json(['count' => $count]);
    }

    /**
     * Display the shopping cart.
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $cart = Session::get('cart', []);
        return view('cart.index', compact('cart'));
    }

    /**
     * Remove an item from the cart.
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function removeCartItem(Request $request)
    {
        $productId = $request->input('product_id');
        $cart = Session::get('cart', []);

        if (isset($cart[$productId])) {
            unset($cart[$productId]);
            Session::put('cart', $cart);
            
            $cartCount = array_sum(array_column($cart, 'quantity'));

            return response()->json([
                'success' => true,
                'message' => 'Item removed from cart!',
                'cartCount' => $cartCount
            ]);
        }

        return response()->json([
            'success' => false,
            'message' => 'Item not found in cart.'
        ], 404);
    }

    public function checkout()
    {
        $cart = Session::get('cart', []);

        if (empty($cart)) {
            return redirect()->route('cart.index')->with('status', 'Your cart is empty! Please add items before checking out.');
        }

        $grandTotal = 0;
        foreach ($cart as $item) {
            $grandTotal += $item['price'] * $item['quantity'];
        }

        return view('checkout.index', compact('cart', 'grandTotal'));
    }

    public function processCheckout(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => ['required', 'string', 'max:255'],
            'address' => ['required', 'string', 'max:255'],
            'city' => ['required', 'string', 'max:255'],
            'postal_code' => ['required', 'string', 'max:20'],
            'payment_method' => ['required', Rule::in(['visa'])],
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $cart = Session::get('cart', []);
        if (empty($cart)) {
            return redirect()->route('cart.index')->with('status', 'Your cart is empty! Cannot proceed with checkout.');
        }

        $paymentSuccess = true;

        if ($paymentSuccess) {
            $grandTotal = 0;
            foreach ($cart as $item) {
                $grandTotal += $item['price'] * $item['quantity'];
            }
            
            $order = Order::create([
                'user_id' => Auth::id(),
                'status' => 'pending',
                'total_price' => $grandTotal,
            ]);
            
            foreach ($cart as $productId => $item) {
                OrderItem::create([
                    'order_id' => $order->id,
                    'product_id' => $productId,
                    'quantity' => $item['quantity'],
                    'price' => $item['price'],
                ]);

                $product = Product::find($productId);
                if ($product) {
                    $product->quantity -= $item['quantity'];
                    $product->save();
                }
            }

            Session::forget('cart');

            return redirect()->route('thankyou')->with('status', 'Your order has been placed successfully!');
        } else {
            return redirect()->back()->withInput()->with('error', 'Payment failed. Please try again.');
        }
    }
}