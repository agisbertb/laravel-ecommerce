<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Inertia\Inertia;

class CategoriesController extends Controller
{
    public function index(Request $request)
    {
        $selectedCategories = $request->input('categories', []);
        $selectedTags = $request->input('tags', []);
        $order = $request->input('order');

        $products = Product::with('images', 'tags', 'categories')
            ->when($order, function ($query, $order) {
                [$criteria, $direction] = explode('_', $order);
                $column = $criteria === 'price' ? 'price' : 'stock';
                return $query->orderBy($column, $direction);
            })
            ->when($selectedCategories, function ($query, $categories) {
                $query->whereHas('categories', function ($query) use ($categories) {
                    $query->whereIn('categories.id', $categories);
                });
            })
            ->when($selectedTags, function ($query, $tags) {
                $query->whereHas('tags', function ($query) use ($tags) {
                    $query->whereIn('tags.id', $tags);
                });
            })
            ->when($selectedCategories && $selectedTags, function ($query) use ($selectedCategories, $selectedTags) {
                $query->where(function ($query) use ($selectedCategories, $selectedTags) {
                    $query->whereHas('categories', function ($query) use ($selectedCategories) {
                        $query->whereIn('categories.id', $selectedCategories);
                    })
                        ->orWhereHas('tags', function ($query) use ($selectedTags) {
                            $query->whereIn('tags.id', $selectedTags);
                        });
                });
            })
            ->get()
            ->map(function ($product) {
                $product->image_url = $product->images->isNotEmpty() ? Storage::url($product->images->first()->image_path) : null;
                $product->tagNames = $product->tags->pluck('name')->toArray();
                $product->categoryNames = $product->categories->pluck('name')->toArray();

                unset($product->images);

                return $product;
            });

        $categories = Category::all();
        $tags = Tag::all();

        return Inertia::render('Categories/Index', [
            'products' => $products,
            'categories' => $categories,
            'tags' => $tags,
            'selectedCategories' => $selectedCategories,
            'selectedTags' => $selectedTags,
            'categoriesOpen' => count($selectedCategories) > 0,
            'tagsOpen' => count($selectedTags) > 0,
        ]);
    }

    public function show(Category $category)
    {
        $order = request()->input('order', 'popularity_desc');
        $products = Product::with('images', 'tags', 'categories')
            ->whereHas('categories', function ($query) use ($category) {
                $query->where('categories.id', $category->id);
            })
            ->when($order, function ($query, $order) {
                [$criteria, $direction] = explode('_', $order);
                if ($criteria === 'newest') {
                    return $query->orderBy('created_at', $direction);
                } elseif ($criteria === 'price') {
                    return $query->orderBy('price', $direction);
                } elseif ($criteria === 'rating') {
                    return $query->orderBy('average_rating', $direction);
                } else {
                    return $query->orderBy('popularity', $direction);
                }
            })
            ->paginate(20)
            ->through(function ($product) {
                $product->image_url = $product->images->isNotEmpty() ? Storage::url($product->images->first()->image_path) : null;
                return $product;
            });

        return Inertia::render('Categories/Show', [
            'category' => $category,
            'products' => $products,
        ]);
    }

}
