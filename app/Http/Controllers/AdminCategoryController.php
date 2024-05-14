<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Inertia\Inertia;

class AdminCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = $request->input('search');
        $order = $request->input('order');

        $categories = Category::with('parent');

        if ($query) {
            $categories->where('name', 'like', '%' . $query . '%');
        }

        if ($order) {
            $parts = explode('_', $order);
            $direction = $parts[1] ?? 'asc';
            $categories->orderBy('name', $direction);
        }

        return Inertia::render('Admin/Categories/Index', [
            'categories' => $categories->paginate(10),
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
        $categories = Category::all();
        return Inertia::render('Admin/Categories/Create', [
        'categories' => $categories
    ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string|max:255',
            'parent_id' => 'nullable|exists:categories,id',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $category = new Category($request->except(['image']));

        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('public/categories');
            $category->image = Str::replaceFirst('public/', '', $path);
        }


        $category->save();

        session()->flash('success', 'Category created successfully.');

        return to_route('admin.categories.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
    //    $category = Category::findOrFail($id);
    //    return Inertia::render('Admin/Categories/Show', ['category' => $category]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $category = Category::find($id);
        $categories = Category::where('parent_id', null)->get();
        return Inertia::render('Admin/Categories/Edit', ['category' => $category, 'categories' => $categories]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string|max:255',
            'parent_id' => 'nullable|exists:categories,id',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $category = Category::findOrFail($id);

        if ($request->hasFile('image')) {
            if ($category->image) {
                Storage::delete('public/' . $category->image);
            }
            $path = $request->file('image')->store('public/categories');
            $validatedData['image'] = Str::replaceFirst('public/', '', $path);
        }

        $category->update($validatedData);

        session()->flash('success', 'Category updated successfully.');

        return redirect()->route('admin.categories.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $category = Category::findOrFail($id);
        $category->delete();

        session()->flash('success', 'Category removed successfully.');

        return to_route('admin.categories.index');
    }

    public function featuredIndex()
    {
        $featuredCategories = Category::where('featured', true)->get();
        return Inertia::render('Admin/Categories/FeaturedIndex', [
            'categories' => $featuredCategories,
            'flash' => [
                'success' => session('success')
            ]
        ]);
    }

    public function featuredManage()
    {
        $allCategories = Category::all();
        $featuredCategories = Category::where('featured', true)->get();
        return Inertia::render('Admin/Categories/FeaturedManage', [
            'categories' => $allCategories,
            'featuredCategories' => $featuredCategories->pluck('id')
        ]);
    }


    public function featuredStore(Request $request)
    {
        $validatedData = $request->validate([
            'featured' => 'required|array|size:3',
            'featured.*' => 'exists:categories,id'
        ]);

        Category::where('featured', true)->update(['featured' => false]);

        foreach ($validatedData['featured'] as $categoryId) {
            $category = Category::findOrFail($categoryId);
            $category->featured = true;
            $category->save();
        }

        session()->flash('success', 'Categories Featured updated successfully.');

        return Inertia::location(route('admin.featured.categories.index'));
    }
}
