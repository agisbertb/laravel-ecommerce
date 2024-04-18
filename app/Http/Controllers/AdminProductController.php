<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\ProductImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;
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

        $products = Product::with('images')
        ->when($query, function ($query, $search) {
            return $query->where('name', 'like', '%' . $search . '%');
        })
            ->when($order, function ($query, $order) {
                [$criteria, $direction] = explode('_', $order);
                $column = $criteria === 'price' ? 'price' : 'stock';
                return $query->orderBy($column, $direction);
            })
            ->paginate(10)
            ->through(function ($product) {
                if ($product->images->isNotEmpty()) {
                    $product->image_url = Storage::url($product->images->first()->image_path);
                }
                return $product;
            });

        return Inertia::render('Admin/Products/Index', [
            'products' => $products,
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
            'stock' => 'required|numeric',
            //'category_id' => 'required|exists:categories,id',
            'images' => 'nullable|array',
            'images.*' => 'image|mimes:jpeg,png,jpg,gif,svg,webp|max:2048'
        ]);

        $product = Product::create($request->except(['images']));

        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $path = $image->store('public/images');
                ProductImage::create([
                    'product_id' => $product->id,
                    'image_path' => $path
                ]);
            }
        }

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
        $product = Product::with('images')->find($id);
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
            'stock' => 'required|numeric',
            //'category_id' => 'required|exists:categories,id',
            'images.*' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'deleteImages' => 'nullable|array',
            'deleteImages.*' => 'exists:product_images,id'
        ]);

        $product = Product::findOrFail($id);
        $product->update($request->only(['name', 'description', 'price', 'stock']));

        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $path = $image->store('public/images');
                $product->images()->create(['image_path' => $path]);
            }
        }

        if ($request->has('deleteImages')) {
            foreach ($request->input('deleteImages') as $imageId) {
                ProductImage::findOrFail($imageId)->delete();
            }
        }

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
