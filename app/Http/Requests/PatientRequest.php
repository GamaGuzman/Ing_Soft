<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PatientRequest extends FormRequest
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
            "age" => "required|integer|min:0|max:99"
        ];
    }

    public function messages()
    {
        return [
            "age.required" => "El campo edad es requerido.",
            "age.integer" => "El campo edad debe ser un número entero.",
            "age.min" => "La edad no puede ser menor a 0.",
            "age.max" => "La edad no puede ser mayor a 99."
        ];
    }
}
