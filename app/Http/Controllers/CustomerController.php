<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Order;

class CustomerController extends Controller
{
    /**
     * Display a list of all orders for the authenticated user.
     */
    public function myOrders()
    {
        $orders = Auth::user()->orders()->with('orderItems')->latest()->get();
        return view('customer.orders', compact('orders'));
    }

    /**
     * Allows a customer to cancel a pending order.
     */
    public function cancelOrder(Order $order)
    {
        // First, verify the order belongs to the authenticated user
        if ($order->user_id !== Auth::id()) {
            return back()->with('error', 'Unauthorized action!');
        }

        // Only allow cancellation if the order is still in 'pending' status
        if ($order->status !== 'pending') {
            return back()->with('error', 'This order cannot be cancelled as its status is no longer pending.');
        }

        // Update the order status to 'cancelled'
        $order->status = 'cancelled';
        $order->save();

        return back()->with('success', 'Your order has been successfully cancelled!');
    }
}