<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\CartDetail;

class CartController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $cart = $user->cart ?? $user->cart()->create(['status' => 'active']);

        $cartDetails = $cart->details()->with('product')->get();

        return Inertia::render('Cart/Index', [
            'cartDetails' => $cartDetails,
        ]);
    }

    public function getCart()
    {
        $user = Auth::user();
        $cart = $user->cart ?? $user->cart()->create(['status' => 'active']);

        $cartDetails = $cart->details()->with('product')->get();

        return response()->json(['cartDetails' => $cartDetails]);
    }

    public function addToCart(Request $request)
    {
        $user = Auth::user();
        $cart = $user->cart ?? $user->cart()->create(['status' => 'active']);

        $detail = $cart->details()->where('product_id', $request->product_id)->first();

        if ($detail) {
            $detail->update(['quantity' => $detail->quantity + $request->quantity]);
        } else {
            $request->merge(['subtotal' => $request->price]);
            $cart->details()->create($request->only(['product_id', 'quantity', 'price', 'subtotal']));
        }
    }

    public function updateCartDetail(Request $request, $detailId)
    {
        $detail = CartDetail::findOrFail($detailId);
        $newQuantity = $request->input('quantity');

        if ($newQuantity > $detail->product->stock) {
            return response()->json(['success' => false, 'message' => 'Not enough stock'], 400);
        }

        $detail->quantity = $newQuantity;
        $detail->save();
    }

    public function destroyCartDetail($detailId)
    {
        $detail = CartDetail::findOrFail($detailId);
        $detail->delete();
    }

    public function clearCart()
    {
        $user = Auth::user();
        $cart = $user->cart;

        if ($cart) {
            $cart->details()->delete();
        }
    }
}
