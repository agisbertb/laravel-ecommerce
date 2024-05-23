<?php

namespace App\Http\Controllers;

use App\Http\Requests\AddressRequest;
use App\Models\Wishlist;
use App\Models\Address;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Inertia\Inertia;

class ProfileController extends Controller
{
    public function index(Request $request)
    {
        $addresses = $request->user()->addresses;
        $orders = $request->user()->orders()->with('details.product.images')->get();
        $wishlists = Wishlist::with('product.images')
            ->where('user_id', $request->user()->id)
            ->get();

        foreach ($wishlists as $wishlist) {
            $wishlist->product->image_url = $wishlist->product->images->isNotEmpty() ? Storage::url($wishlist->product->images->first()->image_path) : null;
        }

        foreach ($orders as $order) {
            foreach ($order->details as $detail) {
                if ($detail->product && $detail->product->images->isNotEmpty()) {
                    $detail->product->image_url = Storage::url($detail->product->images->first()->image_path);
                }
            }
        }

        return Inertia::render('Profile/Index', [
            'user' => $request->user(),
            'addresses' => $addresses,
            'orders' => $orders,
            'wishlist' => $wishlists,
        ]);
    }

    public function orders(Request $request)
    {
        $orders = $request->user()->orders()->with(['details.product'])->get();

        foreach ($orders as $order) {
            foreach ($order->details as $detail) {
                $detail->product->image_url = $detail->product->images->isNotEmpty() ? Storage::url($detail->product->images->first()->image_path) : null;
                $detail->product->href = route('products.show', ['slug' => $detail->product->slug]);
                $detail->product->categoryHref = route('categories.index', ['slug' => $detail->product->category_id]);
            }
        }

        return Inertia::render('Profile/Orders/Index', [
            'orders' => $orders,
        ]);
    }

    public function wishlist(Request $request)
    {
        $wishlists = Wishlist::with('product.images')
            ->where('user_id', $request->user()->id)
            ->get();

        foreach ($wishlists as $wishlist) {
            $wishlist->product->image_url = $wishlist->product->images->isNotEmpty() ? Storage::url($wishlist->product->images->first()->image_path) : null;
        }

        return Inertia::render('Profile/Wishlist/Index', [
            'wishlist' => $wishlists,
        ]);
    }

    public function destroyWishlistItem($id)
    {
        $wishlistItem = Wishlist::findOrFail($id);
        $this->authorize('delete', $wishlistItem);
        $wishlistItem->delete();

        return back()->with('success', 'Item removed from wishlist');
    }

}
