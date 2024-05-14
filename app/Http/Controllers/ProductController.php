<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use App\Models\Product;
use Illuminate\Support\Facades\Storage;
use Inertia\Inertia;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = Category::all();
        $featuredCategories = Category::where('featured', true)->get();
        $favoriteProducts = Product::where('favorite', true)->get();
        $latestProducts = Product::orderBy('created_at', 'desc')->take(4)->get();

        // Charge the category images
        foreach ($categories as $category) {
            $category->image_url = $category->image ? Storage::url($category->image) : null;
        }

        // Charge the favorite products images
        foreach ($favoriteProducts as $product) {
            $product->load('images');
            $product->image_url = $product->images->isNotEmpty() ? Storage::url($product->images->first()->image_path) : null;
        }

        // Charge the latest products images
        foreach ($latestProducts as $product) {
            $product->load('images');
            $product->image_url = $product->images->isNotEmpty() ? Storage::url($product->images->first()->image_path) : null;
        }

        return Inertia::render('Welcome', [
            'categories' => $categories,
            'featuredCategories' => $featuredCategories,
            'favoriteProducts' => $favoriteProducts,
            'latestProducts' => $latestProducts,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $product = Product::with(['images', 'categories', 'tags'])->findOrFail($id);
        return Inertia::render('Products/Show', ['product' => $product]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
