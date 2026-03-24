<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;
use Illuminate\Validation\Rule; // NEW: Import Rule for validation

class AdminOrderController extends Controller
{
    /**
     * Display a listing of the orders.
     */
    public function index()
    {
        // Fetch all orders with the associated user and order items to avoid N+1 query problem
        $orders = Order::with('user', 'orderItems.product')->latest()->get();

        return view('admin.orders', compact('orders'));
    }

    /**
     * Display the specified order.
     *
     * @param \App\Models\Order $order
     * @return \Illuminate\View\View
     */
    public function show(Order $order)
    {
        // Use model binding to get the order, and eager load the relationships
        $order->load('user', 'orderItems.product');

        return view('admin.orders.show', compact('order'));
    }

    /**
     * NEW: Update the specified order's status.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Order $order
     * @return \Illuminate\Http\RedirectResponse
     */
    public function updateStatus(Request $request, Order $order)
    {
        // Validate the incoming request data
        $validated = $request->validate([
            'status' => ['required', Rule::in(['pending', 'shipped', 'delivered', 'cancelled'])],
        ]);

        // Update the order's status
        $order->status = $validated['status'];
        $order->save();

        // Redirect back to the order details page with a success message
        return redirect()->route('admin.orders.show', $order)->with('success', 'Order status updated successfully!');
    }
}