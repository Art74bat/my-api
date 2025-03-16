<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class HardWarePriceRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            "category"=>["required","string"],
            "title"=>["string","nullable"],
            "sub_title"=>["string","nullable"],
            "route"=>["required","string"],
            "description"=>["string"],
            "price"=>["required","numeric"],
        ];
    }
}
