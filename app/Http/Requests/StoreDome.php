<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreDome extends FormRequest
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
            'dom_nombre' => 'required|unique:table,column',
            'dom_estado' => 'required',
            'dom_precio' => 'required',
            'dom_ubicacion' => 'required',
            'dom_descripcion' => 'required',
            'dom_capacidad' => 'required',

        ];
    }

    public function attributes(){

        return [
            'dom_nombre' => 'Nombre del domo',
            'dom_descripcion' => 'Descripcion del domo',
            'dom_precio' => 'Precio del domo',
            'dom_estado' => 'Estado del domo',
        ];

    }

    public function messages(){
        return [
            'descripcion.required'=>'Este domo requiere una descripcion',
            'nombre.required'=>'Este domo requiere un nombre',
            'ubicacion.required'=>'Este domo requiere una localizacion',
            'capacidad.required'=>'Este domo requiere una capacidad',
            'precio.required'=>'Este domo requiere un precio',
            'estado.required'=>'Este domo requiere un estado',
            'precio.numeric'=>'Este valor debe ser un numero',
            'capacidad.numeric'=>'Este valor debe ser un numero',
            'estado.numeric'=>'Este valor debe ser un numero'
        ];
    }
}
