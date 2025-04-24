<?php

namespace App\Http\Requests;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;
class LoginRequest extends FormRequest
{

    public function authorize(): bool
    {
        return true;
    }



    public function rules(): array
    {
        return [
                'email'=>'required|email',
                'password'=>'required|min:6',
        ];
    }
    public function messages(): array
    {
        return[
            'email.required' => 'The email field is required.',
            'email.email' => 'please Enter',
            'password.required' => 'The password field is required.',
            'password.min' => 'Password must be at least 6 characters.',

        ];
    }

    public function failedValidation(Validator $validator){
        throw new HttpResponseException(
             response()->json([
                'status' => false,
                'message' => 'Validation errors',
                'errors' => $validator->errors()
            ],422)
        );
    }
}
