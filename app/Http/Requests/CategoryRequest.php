<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CategoryRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            
			'name' => 'required|max:120|unique:categories,name'.$this->id,
			'image' => 'required|mimes:jpeg,bmp,png,jpg',
        ];
    }

    public function messages()
    {
        return [
            
			'name.required' => 'NOME nao foi selecionado.',
			'name.max' => 'NOME deve ter no maximo :max caracteres.',
			'image.required' => 'IMAGEM nao foi selecionado.',
        ];
    }
}
