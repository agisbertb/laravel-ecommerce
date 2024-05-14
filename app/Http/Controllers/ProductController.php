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
        // Obtener todos los productos
        $products = Product::all();

        // Cargar las imágenes y la URL de la primera imagen para cada producto
        foreach ($products as $product) {
            $product->load('images');
            $product->image_url = $product->images->isNotEmpty() ? Storage::url($product->images->first()->image_path) : null;
        }

        // Obtener las categorías destacadas
        $featuredCategories = Category::where('featured', true)->get();

        // Obtener los productos favoritos
        $favoriteProducts = Product::where('favorite', true)->get();

        // Cargar las imágenes y la URL de la primera imagen para cada producto favorito
        foreach ($favoriteProducts as $product) {
            $product->load('images');
            $product->image_url = $product->images->isNotEmpty() ? Storage::url($product->images->first()->image_path) : null;
        }

        return Inertia::render('Welcome', [
            'products' => $products,
            'featuredCategories' => $featuredCategories,
            'favoriteProducts' => $favoriteProducts,
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
