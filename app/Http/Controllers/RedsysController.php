<?php

namespace App\Http\Controllers;

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

            // Calculem el total de la comanda
            $orderAmount = $cartItems->reduce(function ($carry, $item) {
                return $carry + ($item->quantity * $item->price);
            }, 0);

            // Obtener el costo de envío de la sesión
            $shippingOptionId = session('shipping_option_id');
            $shippingOption = ShippingOption::find($shippingOptionId);
            $shippingCost = $shippingOption ? $shippingOption->price : 0;

            // Sumar el costo de envío al total de la orden
            $totalAmount = $orderAmount + $shippingCost;

            // Creem una nova comanda
            $order = Order::create([
                'user_id' => $user->id,
                'billing_address_id' => session('billing_address_id'), // Updated
                'shipping_address_id' => session('shipping_address_id'), // Updated
                'total' => $totalAmount,
                'status' => 'pending',
            ]);

            // Creem els detalls de la comanda a OrdersDetails
            foreach ($cartItems as $item) {
                OrderDetail::create([
                    'order_id' => $order->id,
                    'product_id' => $item->product_id,
                    'quantity' => $item->quantity,
                    'price' => $item->price,
                ]);
            }

            // Generem un codi d'ordre
            $orderCode = time();

            // Creem un nou pagament
            $payment = Payment::create([
                'order_id' => $order->id,
                'amount' => $totalAmount, // Utilizar el monto total con envío
                'status' => 'pending',
                'method' => 'Redsys',
                'transaction_id' => $orderCode,
            ]);

            // Configuració de Redsys
            $key = config('redsys.key');
            $code = config('redsys.merchantcode');

            Redsys::setAmount($totalAmount); // Utilizar el monto total con envío
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

            // Canviem l'estat del carret a processat
            $cart->update(['status' => 'processed']);

            DB::commit(); // Confirmem la transacció

            return response()->json(['form' => $form]);
        } catch (Exception $e) {
            DB::rollBack(); // Revertim la transacció en caso d'error
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
                'error' => 'No se pudieron obtener los parámetros del comerciante o Ds_Response no está presente.',
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
            return Inertia::render('Checkout/Error', ['error' => 'No se pudo encontrar el pago asociado con el pedido.']);
        }

        if ($payment->status === 'paid') {
            return Inertia::render('Checkout/Error', ['error' => 'Este pago ya ha sido procesado.']);
        }

        // Actualizem l'estat del pagament a pagat
        $payment->status = 'paid';
        $payment->save();

        $order = Order::find($payment->order_id);
        if (!$order || $order->status !== 'pending') {
            return Inertia::render('Checkout/Error', ['error' => 'El pedido no se pudo encontrar o ya ha sido pagado.']);
        }

        // Actualitzem l'estat de la comanda a pagat
        $order->status = 'paid';
        $order->save();

        // Eliminem el carrito de l'usuari
        $cart = Cart::where('user_id', $order->user_id)->first();
        if ($cart) {
            $cart->delete();
        }

        return Inertia::render('Checkout/Success', ['order' => $order]);
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
