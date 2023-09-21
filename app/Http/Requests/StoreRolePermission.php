<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreRolePermission extends FormRequest
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
            'permission_id' => 'required',
            'role_id' => 'required',            
        ];
    }

    public function attributes(){

        return [
            
        ];

    }

    public function messages(){
        return [
            'permission_id.required'=>'Debes crear un permiso antes de asociar',
            'role_id.required'=>'Debes crear un rol antes de asocia',
        ];
    }
}
