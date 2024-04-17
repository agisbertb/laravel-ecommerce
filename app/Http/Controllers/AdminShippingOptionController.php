<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\ShippingOption;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;

class AdminShippingOptionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = $request->input('search');
        $order = $request->input('order');

        $shippingOptions = ShippingOption::query();

        if ($query) {
            $shippingOptions->where('name', 'like', '%' . $query . '%');
        }

        if ($order) {
            [$criteria, $direction] = explode('_', $order);
            $direction = $direction === 'desc' ? 'desc' : 'asc';

            if (in_array($criteria, ['name', 'price'])) {
                $shippingOptions->orderBy($criteria, $direction);
            }
        }

        return Inertia::render('Admin/ShippingOptions/Index', [
            'shippingOptions' => $shippingOptions->paginate(10),
            'flash' => [
                'success' => session('success')
            ]
        ]);
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return Inertia::render('Admin/ShippingOptions/Create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|numeric',
            'estimated_delivery' => 'required|string|max:255',
        ]);

        ShippingOption::create($request->all());

        session()->flash('success', 'Shipping option created successfully.');

        return to_route('admin.shipping-options.index');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $shippingOption = ShippingOption::findOrFail($id);
        return Inertia::render('Admin/ShippingOptions/Edit', ['shippingOption' => $shippingOption]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|numeric',
            'estimated_delivery' => 'required|string|max:255',
        ]);

        $shippingOption = ShippingOption::findOrFail($id);
        $shippingOption->update($request->all());

        session()->flash('success', 'Shipping option updated successfully.');

        return to_route('admin.shipping-options.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $shippingOption = ShippingOption::findOrFail($id);
        $shippingOption->delete();

        session()->flash('success', 'Shipping option removed successfully.');

        return to_route('admin.shipping-options.index');
    }
}
