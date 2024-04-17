<?php

namespace App\Http\Controllers;

use App\Models\ShippingOption;
use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;

class AdminTagController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = $request->input('search');
        $order = $request->input('order');

        $tags = Tag::query();

        if ($query) {
            $tags->where('name', 'like', '%' . $query . '%');
        }

        if ($order) {
            $parts = explode('_', $order);
            $direction = $parts[1] ?? 'asc';
            $tags->orderBy('name', $direction);
        }

        return Inertia::render('Admin/Tags/Index', [
            'tags' => $tags->paginate(10),
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
        return Inertia::render('Admin/Tags/Create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string|max:255',
        ]);

        Tag::create($request->all());

        session()->flash('success', 'Tag created successfully.');

        return to_route('admin.tags.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
    //    $tag = Tag::findOrFail($id);
    //    return Inertia::render('Admin/Tags/Show', ['tag' => $tag]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
     $tag = Tag::find($id);
     return Inertia::render('Admin/Tags/Edit', ['tag' => $tag]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string|max:255',
        ]);

        $tag = Tag::findOrFail($id);
        $tag->update($request->all());

        session()->flash('success', 'Tag updated successfully.');

        return to_route('admin.tags.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $tag = Tag::findOrFail($id);
        $tag->delete();

        session()->flash('success', 'Tag removed successfully.');

        return to_route('admin.tags.index');
    }
}
