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

            'email' => 'required|email|unique:users,email|regex:/^[\w\.-]+@[\w\.-]+\.[a-z]{2,}$/i',
            "age" => "required|integer|min:18|max:99",
            'password' => ['required',
            'string',
            'min:8',
            'max:254',
            'regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d).+$/',
            'confirmed'],

            'phone' => 'required|string|size:10',

            'terms' => 'required|boolean',

            /* 'rfc' => 'required|string|size:13',

            'days' => ['required', 'array', 'min:3'], // 👈 Aquí se exige mínimo 3 días */
        ];
    }

    public function messages(){
        return [
            "name.required" => "El campo nombre es requerido.",
            "name.max" => "El nombre no puede tener más de 255 carácteres.",
            "name.min" => "El nombre debe tener minimo 3 carácteres.",
            "name.regex" => "El campo nombre solo puede contener letras y espacios.",
            "email.required" => "El campo email es requerido.",
            "email.regex" => "El formato del email no es correcto, ingrese un correo válido.",
            "email.unique" => "Lo sentimos, este correo ya esta registrado, ingrese otro correo.",
            "password.required" => "El campo contraseña es requerido.",
            "password.confirmed" => "La contraseña debe ser la misma que en el campo de confirmación.",
            "password.min" => "La contraseña debe de tener minimo 8 carácteres.",
            "password.max" => "La contraseña no puede tener más de 255 carácteres.",
            "password.regex" => "La contraseña debe contener al menos: Una mayúscula, una minúscula y un número.",
            "phone.required" => "El campo teléfono es requerido.",
            "phone.size" => "El teléfono debe de tener solo 10 números.",
            "age.required" => "El campo edad es requerido.",
            "age.integer" => "El campo edad debe ser un número entero.",
            "age.min" => "Debes ser mayor de edad para registrarte.",
            "age.max" => "La edad no puede ser mayor a 99.",
            "terms.required" => "Debes aceptar los términos y condiciones para registrarte.",
            "rfc.required" => "El campo RFC es requerido.",
            "rfc.size" => "El RFC debe de tener solo 13 carácteres.",
            "rfc.regex" => "El formato del RFC no es correcto, ingrese un RFC válido.",
            'days.required' => 'Debes seleccionar al menos 3 días.',
            'days.min' => 'Debes seleccionar al menos 3 días.',

        ];
    }

}
