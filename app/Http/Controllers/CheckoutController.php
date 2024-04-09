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

        $defaultShippingAddress = $user->addresses()->where('type', 'Shipping')->where('default', true)->get();
        $defaultBillingAddress = $user->addresses()->where('type', 'Billing')->where('default', true)->get();

        $cartTotal = $cart ? $cart->details->sum('subtotal') : 0;

        return Inertia::render('Checkout/Address', [
            'defaultShippingAddress' => $defaultShippingAddress,
            'defaultBillingAddress' => $defaultBillingAddress,
            'cartTotal' => $cartTotal,
        ]);
    }

    public function shipping()
    {
        return Inertia::render('Checkout/Shipping');
    }

    public function payment()
    {
        return Inertia::render('Checkout/Payment');
    }

    public function review()
    {
        return Inertia::render('Checkout/Review');
    }
}
