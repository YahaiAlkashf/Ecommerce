<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class StorProductReuest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }


    public function rules(): array
    {
        return [
            'name'=>'required',
            'description'=>'required',
            'price'=>'required',
            'rating'=>'nullable',
            'category_id'=>'required|exists:categories,id',
            'mainImage'=>'image|required|mimes:jpeg,png,jpg,gif|max:2048',
            'images.*' => 'image|nullable|mimes:jpeg,png,jpg,gif',
        ];
    }
    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json([
            'errors' => $validator->errors()
        ], 422));
    }
}
