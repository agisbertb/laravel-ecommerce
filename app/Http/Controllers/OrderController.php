<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function show($orderId)
    {
        $order = Order::with(['details.product', 'payment', 'shippingAddress', 'billingAddress'])->findOrFail($orderId);

        return inertia('Checkout/Success', [
            'order' => $order,
        ]);
    }

    public function success(Request $request)
    {
        $orderId = $request->session()->get('order_id');
        if (!$orderId) {
            return redirect()->route('cart.index')->with('error', 'No order found in session.');
        }

        $order = Order::with(['details.product', 'payment', 'shippingAddress', 'billingAddress'])->findOrFail($orderId);

        return inertia('Checkout/Success', [
            'order' => $order,
        ]);
    }
}
