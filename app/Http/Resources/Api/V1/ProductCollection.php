<?php

namespace App\Http\Resources\Api\V1;

use Illuminate\Http\Request;
use App\Http\Resources\Api\V1\ProductResource;

class ProductCollection extends ProductResource
{
    public static $wrap = 'products';

    /**
     * Transform the resource collection into an array.
     *
     * @return array<int|string, mixed>
     */
    public function toArray(Request $request): array
    {
        return parent::toArray($request);
    }
}
