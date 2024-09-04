<?php

namespace App\Http\Controllers;

use App\Models\ShippingOption;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Inertia\Inertia;
use Illuminate\Http\Request;

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

    public function saveAddress(Request $request)
    {
        $request->validate([
            'shipping_address_id' => 'required|exists:addresses,id',
            'billing_address_id' => 'required|exists:addresses,id',
        ]);

        // save addresses on the session
        session([
            'shipping_address_id' => $request->input('shipping_address_id'),
            'billing_address_id' => $request->input('billing_address_id'),
        ]);

        return redirect()->route('cart.shipping');
    }

    public function shipping()
    {
        $user = Auth::user();
        $cart = $user->cart;

        // Fetch cart details to display products
        $cartDetails = $cart->details->map(function ($detail) {
            $price = $detail->product->price ?? 0;
            return [
                'id' => $detail->id,
                'product' => [
                    'name' => $detail->product->name,
                    'price' => is_numeric($price) ? (float) $price : 0,
                    'image' => $detail->product->image_url = $detail->product->images->isNotEmpty() ? Storage::url($detail->product->images->first()->image_path) : null,
                    'stock' => $detail->product->stock,
                ],
                'quantity' => $detail->quantity,
                'subtotal' => $detail->subtotal,
            ];
        });

        $cartTotal = $cartDetails->sum('subtotal');
        $shippingOptions = ShippingOption::all()->map(function ($option) {
            $price = $option->price ?? 0;
            $estimated_delivery = $option->estimated_delivery ?? 'N/A';
            return [
                'id' => $option->id,
                'name' => $option->name,
                'price' => is_numeric($price) ? (float) $price : 0,
                'estimated_delivery' => $estimated_delivery,
            ];
        });

        return Inertia::render('Checkout/Shipping', [
            'cartDetails' => $cartDetails,
            'cartTotal' => $cartTotal,
            'shippingOptions' => $shippingOptions,
        ]);
    }

    public function saveShippingOption(Request $request)
    {
        $request->validate([
            'shipping_option_id' => 'required|exists:shipping_options,id',
        ]);

        $shippingOption = ShippingOption::find($request->input('shipping_option_id'));
        $shippingPrice = $shippingOption ? $shippingOption->price : 0;

        session([
            'shipping_option_id' => $request->input('shipping_option_id'),
            'shipping_price' => $shippingPrice
        ]);

        return redirect()->route('cart.payment');
    }

    public function payment()
    {
        $user = Auth::user();
        $cart = $user->cart;

        $cartTotal = $cart ? $cart->details->sum('subtotal') : 0;
        $shippingPrice = session('shipping_price', 0);

        if (!is_numeric($shippingPrice)) {
            $shippingPrice = 0;
        }
        $paymentMethods = [
            ['id' => 'credit_card', 'name' => 'Credit or debit card']
        ];

        return Inertia::render('Checkout/Payment', [
            'cartTotal' => (float)$cartTotal,
            'shippingPrice' => (float)$shippingPrice,
            'paymentMethods' => $paymentMethods,
        ]);
    }

    public function review()
    {
        return Inertia::render('Checkout/Review');
    }
}
