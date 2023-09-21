<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreDomeCharacteristic extends FormRequest
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
            'dome_id' => 'required',
            'characteristic_id' => 'required',            
        ];
    }

    public function attributes(){

        return [
            
        ];

    }

    public function messages(){
        return [
            'dome_id.required'=>'Debes crear un domo antes de asociar',
            'characteristic_id.required'=>'Debes crear una caracteristica antes de asocia',
        ];
    }
}
