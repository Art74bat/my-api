<?php

namespace App\Http\Resources\Product;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */

    /**
     * @mixin \App\Models\Product
     */
    public function toArray(Request $request): array
    {
        return [
        'id' => $this->id,
        'name' => $this->name,
        'price' => $this->price,
        'rating'=>$this->rating(),
        'count'=>$this->count,
        'images'=>$this->imageListPath(),
        'reviews' => ProductReviewResource::collection($this->reviews),
        ];
    }
}
