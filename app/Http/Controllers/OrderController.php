<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    /**
     * Show the order form along with the list of existing orders.
     */
    public function create()
    {
        // Fetch all orders, newest first
        $orders = Order::latest()->get();

        // Pass them to the view
        return view('orders.create', compact('orders'));
    }

    /**
     * Validate the request and save a new order to the database.
     */
    public function store(Request $request)
    {
        // 1. Validate the incoming data
        $validated = $request->validate([
            'customer_name' => 'required|string|max:255',
            'product_name'  => 'required|string|max:255',
            'quantity'      => 'required|integer|min:1',
            'price'         => 'required|numeric|min:0',
        ]);

        // 2. Save to the database using Eloquent
        Order::create($validated);

        // 3. Redirect back with a success message
        return redirect()
            ->route('orders.create')
            ->with('success', 'Order placed successfully!');
    }
}