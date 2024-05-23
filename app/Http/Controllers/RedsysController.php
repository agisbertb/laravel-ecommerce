<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\ShippingOption;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Inertia\Inertia;
use Ssheduardo\Redsys\Facades\Redsys;
use Illuminate\Support\Facades\Auth;
use App\Models\Cart;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\Payment;
use Illuminate\Support\Facades\DB;

class RedsysController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $cart = Cart::where('user_id', $user->id)->first();

        if (!$cart) {
            return response()->json(['error' => 'No active cart found for the user.'], 404);
        }

        DB::beginTransaction();

        try {
            $cartItems = $cart->details;

            // Calculate the total amount of the order
            $orderAmount = $cartItems->reduce(function ($carry, $item) {
                return $carry + ($item->quantity * $item->price);
            }, 0);

            // Get the shipping cost
            $shippingOptionId = session('shipping_option_id');
            $shippingOption = ShippingOption::find($shippingOptionId);
            $shippingCost = $shippingOption ? $shippingOption->price : 0;

            // Add the shipping cost to the total amount
            $totalAmount = $orderAmount + $shippingCost;

            // Create the order
            $order = Order::create([
                'user_id' => $user->id,
                'billing_address_id' => session('billing_address_id'),
                'shipping_address_id' => session('shipping_address_id'),
                'total' => $totalAmount,
                'status' => 'pending',
            ]);

            // Create the order details
            foreach ($cartItems as $item) {
                OrderDetail::create([
                    'order_id' => $order->id,
                    'product_id' => $item->product_id,
                    'quantity' => $item->quantity,
                    'price' => $item->price,
                ]);
            }

            // Generate a unique order code
            $orderCode = time();

            $payment = Payment::create([
                'order_id' => $order->id,
                'amount' => $totalAmount,
                'status' => 'pending',
                'method' => 'Redsys',
                'transaction_id' => $orderCode,
            ]);

            // Redsys payment gateway
            $key = config('redsys.key');
            $code = config('redsys.merchantcode');

            Redsys::setAmount($totalAmount);
            Redsys::setOrder(time());
            Redsys::setMerchantcode($code);
            Redsys::setCurrency('978');
            Redsys::setTransactiontype('0');
            Redsys::setTerminal('1');
            Redsys::setMethod('T');
            Redsys::setNotification(config('redsys.url_notification'));
            Redsys::setUrlOk(config('redsys.url_ok'));
            Redsys::setUrlKo(config('redsys.url_ko'));
            Redsys::setVersion('HMAC_SHA256_V1');
            Redsys::setTradeName('Tienda S.L');
            Redsys::setTitular('Andreu Test');
            Redsys::setProductDescription('Compras varias');
            Redsys::setEnviroment('test');

            $signature = Redsys::generateMerchantSignature($key);
            Redsys::setMerchantSignature($signature);
            $form = Redsys::createForm();

            // Change the status of the cart to processed
            $cart->update(['status' => 'processed']);

            DB::commit();

            return response()->json(['form' => $form]);
        } catch (Exception $e) {
            DB::rollBack();
            Log::error('Error in RedsysController@index: ' . $e->getMessage());
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function success(Request $request)
    {
        $key = config('redsys.key');
        $parameters = Redsys::getMerchantParameters($request->input('Ds_MerchantParameters'));

        if (is_null($parameters) || !isset($parameters["Ds_Response"])) {
            return Inertia::render('Checkout/Error', [
                'error' => 'Could not get merchant parameters or Ds_Response is not present.',
                'parameters' => $parameters
            ]);
        }

        $DsResponse = (int) $parameters["Ds_Response"];
        $DsOrder = $parameters["Ds_Order"];

        if (!Redsys::check($key, $request->input()) || $DsResponse > 99) {
            return $this->error($request);
        }

        $payment = Payment::where('transaction_id', $DsOrder)->first();
        if (!$payment) {
            return Inertia::render('Checkout/Error', ['error' => 'The payment associated with the order could not be found.']);
        }

        if ($payment->status === 'paid') {
            return Inertia::render('Checkout/Error', ['error' => 'This payment has already been processed.']);
        }

        // Update the payment status to paid
        $payment->status = 'paid';
        $payment->save();

        $order = Order::find($payment->order_id);
        if (!$order || $order->status !== 'pending') {
            return Inertia::render('Checkout/Error', ['error' => 'The order could not be found or has already been paid for.']);
        }

        // Update the order status to paid
        $order->status = 'paid';
        $order->save();

        // Update the stock of the products in the order
        foreach ($order->details as $item) {
            $product = Product::find($item->product_id);
            if ($product) {
                $product->stock -= $item->quantity;
                $product->save();
            }
        }

        $cart = Cart::where('user_id', $order->user_id)->first();
        if ($cart) {
            $cart->delete();
        }

        $request->session()->put('order_id', $order->id);

        return redirect()->route('cart.success');
    }



    public function error(Request $request)
    {
        $key = config('redsys.key');
        $parameters = Redsys::getMerchantParameters($request->input('Ds_MerchantParameters'));

        if (is_null($parameters)) {
            return Inertia::render('Checkout/Error');
        }

        $DsResponse = (int) $parameters["Ds_Response"];
        $DsOrder = $parameters["Ds_Order"];
        $payment = Payment::where('transaction_id', $DsOrder)->first();

        if (!$payment) {
            return Inertia::render('Checkout/Error');
        }

        return Inertia::render('Checkout/Error');
    }
}
