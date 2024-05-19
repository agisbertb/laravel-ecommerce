<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use App\Models\SiteSetting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Inertia\Inertia;

class SiteController extends Controller
{
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

        // Load site settings
        $siteSettings = SiteSetting::all()->pluck('value', 'key')->toArray();

        return Inertia::render('Welcome', [
            'categories' => $categories,
            'featuredCategories' => $featuredCategories,
            'favoriteProducts' => $favoriteProducts,
            'latestProducts' => $latestProducts,
            'siteSettings' => $siteSettings,
        ]);
    }
}
