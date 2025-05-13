<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class DoctorRequest extends FormRequest
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
            'field' => 'required|string|max:254|min:3',

            'speciality' => 'required|string|max:254|min:3',

            'age' => 'required|integer|min:18|max:100',

            'rfc' => 'required|string|size:13',

            'office' => 'required|string|max:254|min:3',
        ];
    }
}
