<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Inertia\Inertia;
use App\Models\Address;

class ProfileController extends Controller
{
    public function index(Request $request)
    {
        $addresses = $request->user()->addresses;
        $orders = $request->user()->orders()->with('details')->get();


        return Inertia::render('Profile/Index', [
            'user' => $request->user(),
            'addresses' => $addresses,
            'orders' => $orders,

        ]);
    }

    public function orders(Request $request)
    {
        $orders = $request->user()->orders()->with(['details.product'])->get();

        return Inertia::render('Profile/Orders/Index', [
            'orders' => $orders,

        ]);
    }


    public function addresses(Request $request)
    {
        $addresses = Address::where('user_id', $request->user()->id)->get();
        return Inertia::render('Profile/Addresses/Index', [
            'addresses' => $addresses
        ]);
    }

    public function createAddress(Request $request, $type = null)
    {
        return Inertia::render('Profile/Addresses/Create', [
            'type' => $type
        ]);
    }

    public function storeAddress(Request $request)
    {
        $userId = auth()->id();
        $validated = $request->validate([
            'type' => 'required|string',
            'name' => 'required|string|max:255',
            'address' => 'required|string|max:255',
            'city' => 'required|string|max:255',
            'state' => 'required|string|max:255',
            'country' => 'required|string|max:255',
            'zip_code' => 'required|string|max:10',
            'default' => 'sometimes|boolean',
        ]);

        $validated['user_id'] = $userId;

        $hasAddressOfType = Address::where('user_id', $userId)
            ->where('type', $validated['type'])
            ->exists();

        if (!$hasAddressOfType) {
            $validated['default'] = true;
        } elseif (isset($validated['default']) && $validated['default']) {
            Address::where('type', $validated['type'])
                ->where('user_id', $userId)
                ->update(['default' => false]);
        }

        Address::create($validated);

        return redirect()->route('profile.addresses.index');
    }

    public function editAddress(Request $request, $id)
    {
        $address = Address::where('user_id', $request->user()->id)->findOrFail($id);
        return Inertia::render('Profile/Addresses/Edit', [
            'address' => $address
        ]);
    }

    public function updateAddress(Request $request, $id)
    {
        $userId = auth()->id();
        $address = Address::where('user_id', $userId)->findOrFail($id);

        $validated = $request->validate([
            'type' => 'required|string',
            'name' => 'required|string|max:255',
            'address' => 'required|string|max:255',
            'city' => 'required|string|max:255',
            'state' => 'required|string|max:255',
            'country' => 'required|string|max:255',
            'zip_code' => 'required|string|max:10',
            'default' => 'sometimes|boolean',
        ]);

        if (isset($validated['default']) && $validated['default']) {
            Address::where('type', $validated['type'])
                ->where('user_id', $userId)
                ->update(['default' => false]);
        }

        $address->update($validated);

        return redirect()->route('profile.addresses.index');
    }

    public function destroyAddress($id)
    {
        $address = Address::findOrFail($id);
        $this->authorize('delete', $address);

        if ($address->default) {
            DB::transaction(function () use ($address) {
                $address->delete();

                $nextDefaultAddress = Address::where('user_id', $address->user_id)
                    ->where('type', $address->type)
                    ->first();

                if ($nextDefaultAddress) {
                    $nextDefaultAddress->default = true;
                    $nextDefaultAddress->save();
                }
            });
        } else {
            $address->delete();
        }

        return redirect()->route('profile.addresses.index');
    }

    public function wishlist(Request $request)
    {
        // Implement your wishlist logic here
        return Inertia::render('Profile/Wishlist');
    }

}
