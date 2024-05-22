<?php

namespace App\Http\Controllers;

use App\Http\Requests\AddressRequest;
use App\Models\Address;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Inertia\Inertia;

class AddressController extends Controller
{
    public function index()
    {
        $addresses = Address::where('user_id', Auth::id())->get();

        return Inertia::render('Profile/Addresses/Index', [
            'addresses' => $addresses
        ]);
    }

    public function create($type = null)
    {
        return Inertia::render('Profile/Addresses/Create', [
            'type' => $type
        ]);
    }

    public function store(AddressRequest $request)
    {
        $userId = auth()->id();
        $validated = $request->validated();

        $userHasAddresses = Address::where('user_id', $userId)->exists();

        $validated['user_id'] = $userId;

        if (!$userHasAddresses) {
            $types = ['Shipping', 'Billing'];

            foreach ($types as $type) {
                Address::create(array_merge($validated, ['type' => $type]));
            }
        } else {
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
        }

        return to_route('profile.addresses.index');
    }

    public function edit(string $id)
    {
        $address = Address::find($id);
        $this->authorize('view', $address);

        return Inertia::render('Profile/Addresses/Edit', [
            'address' => $address
        ]);
    }

    public function update(AddressRequest $request, string $id)
    {
        if ($request['default']) {
            $userId = auth()->id();
            Address::where('type', $request['type'])
                ->where('user_id', $userId)
                ->update(['default' => false]);
        }

        $address = Address::findOrFail($id);
        $this->authorize('update', $address);
        $address->update($request->all());

        return to_route('profile.addresses.index');
    }

    public function destroy(string $id)
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
        return to_route('profile.addresses.index');
    }
}
