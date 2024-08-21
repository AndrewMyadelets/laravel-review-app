<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Resources\Api\V1\ReviewResource;
use App\Models\Product;
use App\Models\Review;
use Illuminate\Http\Request;
use App\Http\Requests\Api\V1\StoreReviewRequest;
use App\Http\Requests\Api\V1\UpdateReviewRequest;

class ReviewController extends Controller
{
    /**
     * Display a listing of the reviews.
     */
    public function index(Product $product, Review $review)
    {
        // dump($review->where('product_id', '=', "{$product->id}")->get());
        // dump($product->reviews()->get());
        
        return $review->where('product_id', '=', "{$product->id}")->get();
    }

    /**
     * Store a new review.
     */
    public function store(StoreReviewRequest $request, Product $product)
    {
        return ReviewResource::make($product->reviews()->create($request->all()));

        // return ProductResource::make($product->load('reviews'));
    }

    /**
     * Update an existing review.
     */
    public function update(UpdateReviewRequest $request, Product $product, Review $review)
    {
        $review->update($request->all());
        return ReviewResource::make($review);
    }

    /**
     * Remove an existing review.
     */
    public function destroy(Request $request, Product $product, Review $review)
    {
        $review->delete();
        return response()->json([
            'message' => 'Review removed'
        ]);
    }
}
