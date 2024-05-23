<?php

namespace App\Http\Controllers;

use App\Models\ProductReview;
use Illuminate\Http\Request;

class ProductReviewController extends Controller
{
    public function store(Request $request, $productId)
    {
        $request->validate([
            'rating' => 'required|integer|between:1,5',
            'comment' => 'required|string|max:500',
        ]);

        $user = auth()->user();
        $existingReview = ProductReview::where('product_id', $productId)
            ->where('user_id', $user->id)
            ->first();

        if ($existingReview) {
            return redirect()->back()->with('error', 'You have already reviewed this product.');
        }

        $review = new ProductReview([
            'product_id' => $productId,
            'user_id' => $user->id,
            'rating' => $request->input('rating'),
            'comment' => $request->input('comment'),
        ]);
        $review->save();

        return redirect()->back()->with('success', 'Review added successfully!');
    }

    public function update(Request $request, $productId, ProductReview $review)
    {
        $request->validate([
            'rating' => 'required|integer|between:1,5',
            'comment' => 'required|string|max:500',
        ]);

        if ($review->user_id !== auth()->id()) {
            abort(403);
        }

        $review->update($request->only(['rating', 'comment']));
        return redirect()->back()->with('success', 'Review updated successfully!');
    }

    public function destroy($productId, ProductReview $review)
    {
        if ($review->user_id !== auth()->id()) {
            abort(403);
        }

        $review->delete();
        return redirect()->back()->with('success', 'Review deleted successfully!');
    }
}
