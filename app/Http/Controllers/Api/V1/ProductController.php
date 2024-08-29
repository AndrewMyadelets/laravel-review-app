<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Resources\Api\V1\ProductResource;
use App\Http\Resources\Api\V1\ProductCollection;

use App\Models\Product;

class ProductController extends Controller
{
    /**
     * Display a listing of the products.
     * 
     * @return \App\Http\Resources\Api\V1\ProductCollection
     */
    public function index(): ProductCollection
    {
        return ProductCollection::make(Product::all());
    }

    /**
     * Display the specified product.
     * 
     * @param \App\Models\Product $product
     * @return \App\Http\Resources\Api\V1\ProductResource
     */
    public function show(Product $product): ProductResource
    {
        return ProductResource::make($product);
    }
}
