<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreOffer extends FormRequest
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
            'discount' => 'required|numeric',
        ];
    }

    public function attributes(){

        return [
            'name' => 'Nombre del descuento',
            'discount' => 'Porcentaje de descuento',
        ];

    }

    public function messages(){
        return [
            'name.required'=>'Este descuento requiere un nombre',
            'discount.required'=>'Este descuento requiere un numero',
            'discount.numeric'=>'Este espacio debe ser un numero',
        ];
    }
}
