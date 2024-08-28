<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Resources\Api\V1\ReviewResource;
use App\Models\Product;
use App\Models\Review;
use Illuminate\Http\Request;
use App\Http\Requests\Api\V1\StoreReviewRequest;
use App\Http\Requests\Api\V1\UpdateReviewRequest;
use App\Http\Resources\Api\V1\ReviewCollection;

class ReviewController extends Controller
{
    /**
     * Display the number of the reviews for the product.
     * 
     * @param \App\Models\Product $product
     * @return int
     */
    public function count(Product $product): int
    {
        return $product->reviews()->count();
    }

    /**
     * Display the product rating.
     * 
     * @param \App\Models\Product $product
     * @return float|int
     */
    public function rating(Product $product): float|int
    {
        $rating = 0;
        foreach ($product->reviews()->get() as $review) {
            $rating += $review->rating;
        }

        if ($rating === 0)
            return 0;

        return round($rating / $this->count($product), 1);

    }

    /**
     * Display a listing of the reviews for the product.
     * 
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Product $product
     * @return \App\Http\Resources\Api\V1\ReviewCollection
     */
    public function index(Request $request, Product $product) : ReviewCollection
    {
        if ($request->has('limit')) {
            return ReviewCollection::make($product->reviews()->limit($request->limit)->latest()->get());
        }

        return ReviewCollection::make($product->reviews()->latest()->get());
    }

    /**
     * Store a new review.
     * 
     * @param \App\Http\Requests\Api\V1\StoreReviewRequest $request
     * @param \App\Models\Product $product
     * @return \App\Http\Resources\Api\V1\ReviewResource
     */
    public function store(StoreReviewRequest $request, Product $product): ReviewResource
    {
        return ReviewResource::make($product->reviews()->create($request->all()));
    }

    /**
     * Update an existing review.
     * 
     * @param \App\Http\Requests\Api\V1\UpdateReviewRequest $request
     * @param \App\Models\Product $product
     * @param \App\Models\Review $review
     * @return \App\Http\Resources\Api\V1\ReviewResource
     */
    public function update(UpdateReviewRequest $request, Product $product, Review $review): ReviewResource
    {
        $product->reviews()->find($review->id)->update($request->all());
        
        return ReviewResource::make($product->reviews()->find($review->id));
    }

    /**
     * Delete an existing review.
     * 
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Product $product
     * @param \App\Models\Review $review
     * @return mixed|\Illuminate\Http\JsonResponse
     */
    public function destroy(Request $request, Product $product, Review $review)
    {
        $review->delete();

        return response()->json([
            'message' => 'Review deleted.'
        ]);
    }
}
