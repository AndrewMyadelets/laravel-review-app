<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\ProductResource;
use App\Models\Product;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return ProductResource::collection(Product::with('reviews')->latest()->get());
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        // $productMake = ProductResource::make($product->load('reviews'));// with reviews
        // $productNew = new ProductResource($product);// without reviews
        // $productMk = ProductResource::make($product->reviews);

        // dump(ProductResource::make($product->load('reviews'))->reviews);
        // dump(ProductResource::make($product->reviews));

        return ProductResource::make($product->load('reviews'));
    }
}
