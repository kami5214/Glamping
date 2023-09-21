<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreService extends FormRequest
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
            'quantity' => 'required|numeric',
            'price' => 'required|numeric',
            'state' => 'required|numeric'
        ];
    }

    public function attributes(){

        return [
            'name' => 'Nombre del servicio',
            'quantity' => 'Cantidad del servicio',
            'price' => 'Precio del servicio',
            'state' => 'Estado del servicio',
        ];

    }

    public function messages(){
        return [
            'quantity.required'=>'La cantidad es requerida',
            'name.required'=>'Este servicio requiere un nombre',
            'price.required'=>'Este servicio requiere un precio',
            'state.required'=>'Este servicio requiere un estado',
            'price.numeric'=>'Este valor debe ser un numero',
            'state.numeric'=>'Este valor debe ser un numero'
        ];
    }
}
