<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            
            'role_id' => 'required|numeric',
            'name' => 'required',
            'username' => 'required|max:155',
            'email' => 'required|max:155',
            'password' => 'required',
			'image' => 'required|mimes:jpeg,bmp,png,jpg',
            'about' => ''
        ];
    }

    public function messages()
    {
        return [
            'role_id.required' => 'PAPEL não foi selecionado.',
		    'role_id.numeric' => 'PAPEL deve ser numérco.',
			'name.required' => 'NOME nao foi selecionado.',
			'username.required' => 'NOME DO USUARIO nao foi selecionado.',
			'username.max' => 'NOME DO USUARIO deve ter no maximo :max caracteres.',
			'email.required' => 'EMAIL nao foi selecionado.',
			'email.max' => 'EMAIL deve ter no maximo :max caracteres.',
			'image.required' => 'IMAGEM nao foi selecionado.',
        ];
    }
}
