<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RoleUserRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [

            'role_id' => 'required|numeric',
            'user_id' => 'required|numeric',

        ];
    }

    public function messages()
    {
        return [

            'role_id.required' => 'PERFIS nao foi selecionado.',
            'role_id.numeric' => 'PERFIS deve ser numerico.',
            'user_id.required' => 'USUARIOS nao foi selecionado.',
            'user_id.numeric' => 'USUARIOS deve ser numerico.',

        ];
    }
}