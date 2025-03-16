<?php

namespace App\Http\Resources\Price;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CorpPriceResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id'=>$this->id,
            'category'=>$this->category,
            'groupe'=>$this->groupe,
            'description'=>$this->description,
            'price'=>$this->price,
        ];
    }
}
