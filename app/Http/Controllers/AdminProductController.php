<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use App\Models\ProductImage;
use App\Models\Tag;
use Illuminate\Http\Request;
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

        $products = Product::with('images', 'tags', 'categories')
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
                $product->image_url = $product->images->isNotEmpty() ? Storage::url($product->images->first()->image_path) : null;
                $product->tagNames = $product->tags->pluck('name')->toArray();
                $product->categoryNames = $product->categories->pluck('name')->toArray();

                unset($product->images);

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
        $tags = Tag::all();
        $categories = Category::all();

        return Inertia::render('Admin/Products/Create', [
            'tags' => $tags,
            'categories' => $categories
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string|max:255',
            'price' => 'required|numeric',
            'stock' => 'required|numeric',
            'categories' => 'required|array',
            'categories.*' => 'exists:categories,id',
            'images' => 'nullable|array',
            'images.*' => 'image|mimes:jpeg,png,jpg,gif,svg,webp|max:2048',
            'tags' => 'nullable|array',
            'tags.*' => 'exists:tags,id',
        ]);

        $product = Product::create($validated);

        if ($request->has('categories')) {
            $product->categories()->sync($validated['categories']);
        }

        if ($request->has('tags')) {
            $product->tags()->sync($validated['tags']);
        }

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
        $product = Product::with('images', 'tags')->findOrFail($id);
        $tags = Tag::all();
        $categories = Category::all();
        $productTags = $product->tags->pluck('id');
        $prouctCategories = $product->categories->pluck('id');

        return Inertia::render('Admin/Products/Edit', [
            'product' => $product,
            'tags' => $tags,
            'categories' => $categories,
            'productTags' => $productTags,
            'productCategories' => $prouctCategories,
        ]);
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
            'categories' => 'required|array',
            'categories.*' => 'exists:categories,id',
            'images.*' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'deleteImages' => 'nullable|array',
            'deleteImages.*' => 'exists:product_images,id',
            'tags' => 'nullable|array',
            'tags.*' => 'exists:tags,id'
        ]);

        $product = Product::findOrFail($id);
        $product->update($request->only(['name', 'description', 'price', 'stock']));

        if ($request->has('categories')) {
            $product->categories()->sync($request->input('categories'));
        }

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

        if ($request->has('tags')) {
            $product->tags()->sync($request->tags);
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

    public function favoriteIndex()
    {
        $favoriteProducts = Product::where('favorite', true)->get();
        return Inertia::render('Admin/Products/FavoriteIndex', [
            'products' => $favoriteProducts,
            'flash' => [
                'success' => session('success')
            ]
        ]);
    }

    public function favoriteManage()
    {
        $allProducts = Product::all();
        $favoriteProducts = Product::where('favorite', true)->get();
        return Inertia::render('Admin/Products/FavoriteManage', [
            'products' => $allProducts,
            'favoriteProducts' => $favoriteProducts->pluck('id')
        ]);
    }

    public function favoriteStore(Request $request)
    {
        $validatedData = $request->validate([
            'favorite' => 'required|array|size:3',
            'favorite.*' => 'exists:products,id'
        ]);

        Product::where('favorite', true)->update(['favorite' => false]);

        foreach ($validatedData['favorite'] as $productId) {
            $product = Product::findOrFail($productId);
            $product->favorite = true;
            $product->save();
        }

        session()->flash('success', 'Favorite products updated successfully.');

        return Inertia::location(route('admin.favorite.products.index'));
    }
}
