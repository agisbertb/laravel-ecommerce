<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\SiteSetting;
use App\Models\Tag;
use Illuminate\Http\Request;
use App\Models\Product;
use Illuminate\Support\Facades\Storage;
use Inertia\Inertia;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
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

        return Inertia::render('Products/Index', [
            'products' => $products,
            'categories' => $categories,
            'tags' => $tags,
            'selectedCategories' => $selectedCategories,
            'selectedTags' => $selectedTags,
            'categoriesOpen' => count($selectedCategories) > 0,
            'tagsOpen' => count($selectedTags) > 0,
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
    public function show($slug)
    {
        $product = Product::with(['images', 'categories', 'tags', 'reviews', 'reviews.user'])
            ->where('slug', $slug)
            ->firstOrFail();

        $reviews = $product->reviews;
        $averageRating = $reviews->avg('rating');
        $totalCount = $reviews->count();
        $ratingsCount = [];

        for ($i = 1; $i <= 5; $i++) {
            $ratingsCount[] = [
                'rating' => $i,
                'count' => $reviews->where('rating', $i)->count()
            ];
        }

        $userReview = $reviews->where('user_id', auth()->id())->first();
        $featuredReviews = $reviews->take(5);

        $relatedProducts = Product::with('images')
            ->whereHas('categories', function ($query) use ($product) {
                return $query->whereIn('categories.id', $product->categories->pluck('id'));
            })
            ->where('id', '!=', $product->id)
            ->take(4)
            ->get()
            ->map(function ($relatedProduct) {
                return [
                    'id' => $relatedProduct->id,
                    'name' => $relatedProduct->name,
                    'href' => route('products.show', $relatedProduct->slug),
                    'imageSrc' => $relatedProduct->images->first() ? Storage::url($relatedProduct->images->first()->image_path) : null,
                    'imageAlt' => $relatedProduct->name,
                    'price' => $relatedProduct->price,
                ];
            });

        return Inertia::render('Products/Show', [
            'product' => $product,
            'reviews' => [
                'average' => $averageRating,
                'totalCount' => $totalCount,
                'counts' => $ratingsCount,
                'featured' => $featuredReviews,
                'userReview' => $userReview
            ],
            'relatedProducts' => $relatedProducts,
        ]);
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
