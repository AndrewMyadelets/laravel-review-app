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
     * @return int
     */
    public function count(Product $product): int
    {
        return $product->reviews()->count();
    }

    /**
     * Display a listing of the reviews for the product.
     * @return ReviewCollection
     */
    public function index(Request $request, Product $product, Review $review): ReviewCollection
    {
        // dump($request->limit);
        // dump($request->query());
        // dump($review->where('product_id', '=', "{$product->id}")->get());
        // dump($product->reviews()->get());
        // return $review->where('product_id', '=', "{$product->id}")->get();
        // dump($product->reviews()->get());

        // $request->whenHas('limit', function (string $input) {
        //     return ReviewCollection::make($review->where('product_id', $product->id)->limit(3)->get());
        // });

        if ($request->has('limit')) {
            return ReviewCollection::make($review->where('product_id', $product->id)->limit($request->limit)->latest()->get());
        }

        return ReviewCollection::make($review->where('product_id', $product->id)->latest()->get());
    }

    /**
     * Store a new review.
     * @return ReviewResource
     */
    public function store(StoreReviewRequest $request, Product $product): ReviewResource
    {
        return ReviewResource::make($product->reviews()->create($request->all()));

        // return ProductResource::make($product->load('reviews'));
    }

    /**
     * Update an existing review.
     */
    public function update(UpdateReviewRequest $request, Product $product, Review $review): ReviewResource
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
