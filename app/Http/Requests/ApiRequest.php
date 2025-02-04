<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class ApiRequest extends FormRequest
{
   public function failedValidation(\Illuminate\Contracts\Validation\Validator $validator)
   {
    throw new HttpResponseException(response()->json([
        'message' => 'validation failed',
        'errors' => $validator->getMessageBag(),
    ],400));

   }
   
}
