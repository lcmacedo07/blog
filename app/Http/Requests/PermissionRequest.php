<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PermissionRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [

            'name' => 'required|max:60',
            'description' => 'required|max:2',

        ];
    }

    public function messages()
    {
        return [

            'name.required' => 'NOME nao foi selecionado.',
            'name.max' => 'NOME deve ter no maximo :max caracteres.',
            'description.max' => 'DESCRICAO deve ter no maximo :max caracteres.',
            'description.required' => 'DESCRICAO nao foi selecionado.',

        ];
    }
}