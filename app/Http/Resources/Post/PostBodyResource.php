<?php

namespace App\Http\Resources\Post;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @mixin \App\Models\PostBody
 */

class PostBodyResource extends JsonResource
{
   
    public function toArray(Request $request): array
    {
        return [
            'id'=>$this->id,
            'sub_title'=>$this->sub_title,
            'body'=>$this->body,
        ];
    }
}
