<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreCharacteristic extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'name' => 'required',
            'description' => 'required',
           
        ];
    }

    public function attributes(){

        return [
            'name' => 'Nombre de la caracteristica',
            'description' => 'Descripcion de la caracteristica',
        ];

    }

    public function messages(){
        return [
            'description.required'=>'Esta caracteristica requiere una descripcion',
            'name.required'=>'Esta caracteristica requiere un nombre',
            'price.required'=>'Esta caracteristica requiere un precio',
            'state.required'=>'Esta caracteristica requiere un estado',
            'price.numeric'=>'Esta caracteristica debe ser un numero',
            'state.numeric'=>'Esta caracteristica debe ser un numero'
        ];
    }
}
