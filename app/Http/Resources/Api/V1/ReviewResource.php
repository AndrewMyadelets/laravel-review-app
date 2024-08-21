<?php

namespace App\Http\Resources\Api\V1;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ReviewResource extends JsonResource
{
    public static $wrap = 'review';

    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'rating' => $this->rating,
            'body' => $this->body,
            'product_id' => $this->product_id,
            'user_id' => $this->user_id,
            'created' => Carbon::parse($this->created_at)->format('Y-m-d H:i:s'),
            'updated' => Carbon::parse($this->updated)->format('Y-m-d H:i:s'),
        ];
    }
}