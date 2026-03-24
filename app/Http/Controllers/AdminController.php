<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Product;
use App\Models\Order;
use App\Models\Review; // NEW: Import the Review model
use Illuminate\Support\Facades\Storage;

class AdminController extends Controller
{
    // Define the commission rate for new products
    private $commissionRate = 0.20; // 20% commission

    public function dashboard()
    {
        // Fetch all the dashboard data from the database
        $totalUsers = User::count();
        $totalProducts = Product::count();
        $totalSales = Order::where('status', 'delivered')->sum('total_price');
        $pendingOrders = Order::where('status', 'pending')->count();
        $totalReviews = Review::count(); // NEW: Get the total review count

        // Calculate the total profit for the admin
        $deliveredOrders = Order::where('status', 'delivered')
                                ->with('orderItems.product')
                                ->get();

        $totalProfit = 0;
        foreach ($deliveredOrders as $order) {
            foreach ($order->orderItems as $item) {
                // Profit is the difference between the final price and the vendor's price, multiplied by quantity
                $profitPerItem = ($item->price - ($item->product->vendor_price ?? $item->price)) * $item->quantity;
                $totalProfit += $profitPerItem;
            }
        }
        
        // Pass the data to the view
        return view('admin.dashboard', compact('totalUsers', 'totalProducts', 'totalSales', 'pendingOrders', 'totalProfit', 'totalReviews')); // NEW: Pass the totalReviews count
    }

    public function products()
    {
        $products = Product::with('vendor')->get();
        return view('admin.products', compact('products'));
    }
    
    public function users()
    {
        $users = User::all();
        return view('admin.users', compact('users'));
    }

    public function orders()
    {
        return view('admin.orders');
    }

    public function deals()
    {
        $deals = Product::where('is_deal', true)->with('vendor')->get();
        return view('admin.deals', compact('deals'));
    }

    // NEW: Method to show all reviews for the admin panel
    public function reviews()
    {
        $reviews = Review::with('user', 'product')->latest()->get();
        return view('admin.reviews', compact('reviews'));
    }
    
    // NEW: Method for the admin to delete a review
    public function deleteReview(Review $review)
    {
        $review->delete();
        return back()->with('success', 'Review deleted successfully!');
    }

    public function updateRole(Request $request, User $user)
    {
        $user->role = $request->input('role');
        $user->save();
        return back()->with('success', 'User role updated successfully.');
    }

    public function edit(Product $product)
    {
        return view('admin.products.edit', compact('product'));
    }

    public function update(Request $request, Product $product)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'required|numeric',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'category' => 'required|string',
            'is_deal' => 'nullable|boolean',
            'discount_percentage' => 'nullable|numeric|between:0,100'
        ]);

        if ($request->hasFile('image')) {
            if ($product->image && Storage::disk('public')->exists($product->image)) {
                Storage::disk('public')->delete($product->image);
            }
            $validatedData['image'] = $request->file('image')->store('products', 'public');
        }

        $validatedData['is_deal'] = $request->has('is_deal');
        
        $product->update($validatedData);

        return redirect()->route('admin.products')->with('success', 'Product updated successfully!');
    }

    public function destroy(Product $product)
    {
        if ($product->image && Storage::disk('public')->exists($product->image)) {
            Storage::disk('public')->delete($product->image);
        }

        $product->delete();

        return redirect()->route('admin.products')->with('success', 'Product deleted successfully!');
    }

    public function toggleDealStatus(Product $product)
    {
        $product->is_deal = !$product->is_deal;
        $product->save();
        return back()->with('success', 'Product deal status updated!');
    }
    
    // NEW: Method to handle the modal's AJAX submission
    public function updateDealPercentage(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'discount_percentage' => 'required|numeric|min:1|max:100',
        ]);

        $product = Product::find($request->input('product_id'));
        $product->is_deal = true;
        $product->discount_percentage = $request->input('discount_percentage');
        $product->save();

        return response()->json(['success' => true]);
    }
    
    // NEW: Method to approve a product
    public function approve(Product $product)
    {
        // Calculate the public price with the commission
        $publicPrice = $product->vendor_price + ($product->vendor_price * $this->commissionRate);
        
        $product->price = $publicPrice;
        $product->is_approved = true;
        $product->save();
        
        return back()->with('success', 'Product approved and listed!');
    }
}