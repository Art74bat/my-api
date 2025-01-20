<?php

namespace App\Http\Requests\Product;

use App\Enums\ProductStatus;
use App\Http\Requests\ApiRequest;
use App\Services\DTO\CreateProductDTO;
// use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Enum;

class StoreProductRequest extends ApiRequest
{
    public function rules(): array
    {
        return [
            'name'=>['required','string'],
            'description'=>['string'],
            'price'=>['required','numeric','min:1','max:100000'],
            'count'=>['required','int','min:1','max:1000'],
            'status'=>['required',new Enum(ProductStatus::class)],
            'images.*'=>['image'],
        ];
    }



    // dto 
    public function data($key = null, $default = null)
    {
        return CreateProductDTO::from($this->validated());
        if ($key === null) {
            return CreateProductDTO::from($this->validated());
        }
    }

}
