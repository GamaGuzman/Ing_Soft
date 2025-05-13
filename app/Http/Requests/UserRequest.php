<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
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
            'name' => 'required|string|max:254|min:3|regex:/^[A-Za-z\s]+$/',

            'email' => 'required|email|unique:users,email|regex:/^.+@.+$/i',

            'password' => ['required',
            'string',
            'min:8',
            'max:254',
            'regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d).+$/',
            'confirmed'],

            'phone' => 'required|string|size:10',
        ];
    }
}
