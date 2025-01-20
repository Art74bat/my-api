<?php

namespace App\Http\Requests\User;

use App\Http\Requests\ApiRequest;
use Illuminate\Foundation\Http\FormRequest;

class LoginRequest extends ApiRequest
{
    public function rules(): array
    {
        return [
            'email'=>['required','email'],
            'password'=>['required'],
        ];
    }
}
