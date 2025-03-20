<?php

namespace App\Http\Resources\Reviews;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ReviewseResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            "id"=>$this->id,
            'name'=>$this->name,
            'second_name'=>$this->second_name,
            'email'=>$this->email,
            'review'=>$this->review,
            'created_at'=>$this->created_at->format('d.m.Y'),
        ];
    }
}
