<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\ReviewResource;
use App\Models\Product;
use App\Models\Review;
use Illuminate\Http\Request;

class ReviewController extends Controller
{
    /**
     * Store a new review.
     */
    public function store(Request $request, Review $review)
    {
        return ReviewResource::make(Review::create($request->all()));


        // $product->reviews()->create([
        //     'title' => $request->title,
        //     'body' => $request->body,
        //     'rating' => $request->rating,
        //     'user_id' => $request->user_id,
        // ]);

        // return ProductResource::make($product->load('reviews'));
    }

    /**
     * Update an existing review.
     */
    public function update(Request $request, Review $review)
    {
        $review->update($request->all());
        return ReviewResource::make($review);
    }

    /**
     * Remove an existing review.
     */
    public function destroy(Review $review)
    {
        $review->delete();
        return response()->json([
            'message' => 'Review removed'
        ]);
    }
}
