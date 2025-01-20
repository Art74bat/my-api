<?php

namespace App\Http\Requests\Product;

use App\Http\Requests\ApiRequest;
use Illuminate\Foundation\Http\FormRequest;

class StoreReviewRequest extends ApiRequest
{
    public function rules(): array
    {
        return [
            'text'=>['required','string'],
            'rating'=>['required','integer','min:1','max:5'],
        ];
    }
}
