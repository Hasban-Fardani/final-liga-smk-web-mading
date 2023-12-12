<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LoginRequest extends FormRequest
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
        // validation rules
        return [
            "identity" => "required",
            "password" => "required",
            "type" => "required",
        ];
    }

    /**
     * Retrieves the error messages for the validation rules.
     *
     * @return array The array of error messages.
     */
    public function messages()
    {
        return [
            "identity.required" => "The identity field is required.",
            "password.required" => "The password field is required.",
            "type.required" => "The type field is required.",
        ];
    }
}
