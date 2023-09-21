<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorePayment_Method extends FormRequest
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
        ];
    }

    public function attributes(){

        return [
            'name' => 'Nombre del metodo de pago',
        ];

    }

    public function messages(){
        return [
            'name.required'=>'Se requiere un nombre para el metodo de pago',
        ];
    }
}
