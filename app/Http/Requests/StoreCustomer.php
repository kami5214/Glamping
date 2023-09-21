<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreCustomer extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return True;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'name' => 'required',
            'last_name' => 'required',
            'email' => 'required',
            'phone_number' => 'required',
            'birthdate' => 'required',
            'city' => 'required',
            'address' => 'required',
            
        ];
    }

    public function attributes(){

        return [
            
        ];

    }

    public function messages(){
        return [
            'last_name.required'=>'El cliente debe tener un apellido',
            'name.required'=>'El cliente requiere un nombre',
            'email.required'=>'El cliente necesita un correo',
            'phone_number.required'=>'Se requiere un numero de telefono',
            'birthdate.required'=>'Se requiere el cumpleaños',
            'city.required'=>'Ciudad necesaria',
            'address.required'=>'Direccion necesaria',
        ];
    }
}
