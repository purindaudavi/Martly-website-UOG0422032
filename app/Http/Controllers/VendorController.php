<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class VendorController extends Controller
{
    public function dashboard()
    {
        // Get the ID of the currently authenticated vendor
        $vendorId = Auth::id();

        // Fetch all the dashboard data for this vendor
        $totalProducts = Product::where('vendor_id', $vendorId)->count();
        $pendingApproval = Product::where('vendor_id', $vendorId)->where('is_approved', false)->count();

        // Find all delivered orders that contain a product from this vendor
        $deliveredOrders = Order::where('status', 'delivered')
                                ->with(['orderItems.product'])
                                ->get();
                                
        $vendorSales = 0;
        $vendorProfit = 0;

        foreach ($deliveredOrders as $order) {
            foreach ($order->orderItems as $item) {
                // Check if the product in the order belongs to the current vendor
                if ($item->product->vendor_id === $vendorId) {
                    $vendorSales += ($item->price * $item->quantity);
                    $vendorProfit += ($item->product->vendor_price * $item->quantity);
                }
            }
        }
        
        // Pass the data to the view
        return view('vendor.dashboard', compact('totalProducts', 'vendorSales', 'vendorProfit', 'pendingApproval'));
    }
    
    public function myProducts()
    {
        $products = Product::where('vendor_id', Auth::id())->get();
        return view('vendor.my-products', compact('products'));
    }

    public function create()
    {
        return view('vendor.products.create');
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'vendor_price' => 'required|numeric|min:0',
            'quantity' => 'required|integer|min:0',
            'category' => 'required|string',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $imagePath = $request->file('image')->store('products', 'public');

        Auth::user()->products()->create([
            'name' => $validatedData['name'],
            'description' => $validatedData['description'],
            'vendor_price' => $validatedData['vendor_price'],
            'quantity' => $validatedData['quantity'],
            'price' => null,
            'category' => $validatedData['category'],
            'image' => $imagePath,
            'vendor_id' => Auth::id(),
            'is_approved' => false,
        ]);

        return redirect()->route('vendor.products')->with('status', 'Product added successfully and is pending approval!');
    }
    
    public function edit(Product $product)
    {
        if ($product->vendor_id !== Auth::id()) {
            abort(403);
        }
        return view('vendor.products.edit', compact('product'));
    }
    
    public function update(Request $request, Product $product)
    {
        if ($product->vendor_id !== Auth::id()) {
            abort(403);
        }
        
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'vendor_price' => 'required|numeric|min:0',
            'quantity' => 'required|integer|min:0',
            'category' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        if ($request->hasFile('image')) {
            if ($product->image) {
                Storage::disk('public')->delete($product->image);
            }
            $imagePath = $request->file('image')->store('products', 'public');
            $validatedData['image'] = $imagePath;
        }

        $product->update([
            'name' => $validatedData['name'],
            'description' => $validatedData['description'],
            'vendor_price' => $validatedData['vendor_price'],
            'quantity' => $validatedData['quantity'],
            'category' => $validatedData['category'],
            'image' => $validatedData['image'] ?? $product->image,
            'price' => null,
            'is_approved' => false,
        ]);

        return redirect()->route('vendor.products')->with('status', 'Product updated successfully and is pending re-approval!');
    }

    public function destroy(Product $product)
    {
        if ($product->vendor_id !== Auth::id()) {
            abort(403);
        }

        if ($product->image) {
            Storage::disk('public')->delete($product->image);
        }

        $product->delete();

        return redirect()->route('vendor.products')->with('status', 'Product deleted successfully!');
    }
    
    // NEW: Update the method to fetch and prepare sales data for the vendor
    public function mySales()
    {
        $vendorId = Auth::id();

        // Get orders that contain at least one product from this vendor
        $orders = Order::whereHas('orderItems.product', function ($query) use ($vendorId) {
            $query->where('vendor_id', $vendorId);
        })->with(['user', 'orderItems.product'])->latest()->get();

        // Calculate a vendor-specific total for each order
        $orders->each(function ($order) use ($vendorId) {
            $vendorTotal = 0;
            $order->orderItems->each(function ($item) use ($vendorId, &$vendorTotal) {
                if ($item->product->vendor_id === $vendorId) {
                    $vendorTotal += $item->product->vendor_price * $item->quantity;
                }
            });
            $order->vendor_total = $vendorTotal;
        });

        return view('vendor.sales', compact('orders'));
    }
}