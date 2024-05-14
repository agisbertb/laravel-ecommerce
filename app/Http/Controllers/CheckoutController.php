<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class CheckoutController extends Controller
{
    public function address()
    {
        $user = Auth::user();
        $cart = $user->cart;

        $shippingAddresses = $user->addresses()->where('type', 'Shipping')->get();
        $billingAddresses = $user->addresses()->where('type', 'Billing')->get();

        $cartTotal = $cart ? $cart->details->sum('subtotal') : 0;

        return Inertia::render('Checkout/Address', [
            'shippingAddresses' => $shippingAddresses,
            'billingAddresses' => $billingAddresses,
            'cartTotal' => $cartTotal,
        ]);
    }

    public function shipping()
    {
        $user = Auth::user();
        $cart = $user->cart;

        // Fetch cart details to display products
        $cartDetails = $cart->details->map(function ($detail) {
            return [
                'id' => $detail->id,
                'product' => [
                    'name' => $detail->product->name,
                    'price' => $detail->price,
                    'image' => $detail->product->image,
                ],
                'quantity' => $detail->quantity,
                'subtotal' => $detail->subtotal,
            ];
        });

        $cartTotal = $cartDetails->sum('subtotal');


        $shippingOptions = [

        ];

        return Inertia::render('Checkout/Shipping', [
            'cartDetails' => $cartDetails,
            'cartTotal' => $cartTotal,
            'shippingOptions' => $shippingOptions,
        ]);
    }


    public function payment()
    {
        $user = Auth::user();
        $cart = $user->cart;

        $cartTotal = $cart ? $cart->details->sum('subtotal') : 0;

        $paymentMethods = [
            ['id' => 'credit_card', 'name' => 'Credit or debit card'],
            ['id' => 'paypal', 'name' => 'PayPal'],
            ['id' => 'stripe', 'name' => 'Stripe'],
        ];

        return Inertia::render('Checkout/Payment', [
            'cartTotal' => $cartTotal,
            'paymentMethods' => $paymentMethods,
        ]);
    }

    public function review()
    {
        return Inertia::render('Checkout/Review');
    }
}
