<?php

namespace App\Http\Controllers;

use App\Http\Requests\AddressRequest;
use App\Models\Address;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Inertia\Inertia;

class AddressController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    public function index()
    {
        $addresses = Address::where('user_id', Auth::id())->get();

        return Inertia::render('Addresses/Index', [
            'addresses' => $addresses
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */

    public function create($type = null)
    {
        return Inertia::render('Addresses/Create', [
            'type' => $type
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */

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

        return to_route('addresses.index');
    }

    /**
     * Show the form for editing the specified resource.
     */

    public function edit(string $id)
    {
        $address = Address::find($id);
        $this->authorize('view', $address);

        return Inertia::render('Addresses/Edit', [
            'address' => $address
        ]);
    }

    /**
     * Update the specified resource in storage.
     */

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

        return to_route('addresses.index');
    }

    /**
     * Remove the specified resource from storage.
     */

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
        return to_route('addresses.index');
    }
}
