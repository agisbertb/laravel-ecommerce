<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;

class AdminProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = $request->input('search');
        $order = $request->input('order');

        $products = Product::query();

        if ($query) {
            $products->where('name', 'like', '%' . $query . '%');
        }

        if ($order) {
            [$criteria, $direction] = explode('_', $order);
            $column = $criteria === 'price' ? 'price' : 'stock';
            $products->orderBy($column, $direction);
        }

        return Inertia::render('Admin/Products/Index', [
            'products' => $products->paginate(10),
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
        return Inertia::render('Admin/Products/Create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string|max:255',
            'price' => 'required|numeric',
        //    'category_id' => 'required|exists:categories,id',
            'stock' => 'required|numeric',
            'image' => 'nullable|string|max:1024', //TODO change to image
        ]);

        Product::create($request->all());

        session()->flash('success', 'Product created successfully.');

        return to_route('admin.products.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //    $tag = Tag::findOrFail($id);
        //    return Inertia::render('Admin/Products/Show', ['product' => $product]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $product = Product::find($id);
        return Inertia::render('Admin/Products/Edit', ['product' => $product]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string|max:255',
            'price' => 'required|numeric',
        //    'category_id' => 'required|exists:categories,id',
            'stock' => 'required|numeric',
            'image' => 'nullable|string|max:1024', //TODO change to image
        ]);

        $product = Product::findOrFail($id);
        $product->update($request->all());

        session()->flash('success', 'Product updated successfully.');

        return to_route('admin.products.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $product = Product::findOrFail($id);
        $product->delete();

        session()->flash('success', 'Product removed successfully.');

        return to_route('admin.products.index');
    }
}
