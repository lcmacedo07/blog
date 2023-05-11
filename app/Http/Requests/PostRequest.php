<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PostRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            
            'category_id' => 'required|numeric',
            'tag_id' => 'required|numeric',
            'title' => 'required|max:120',
			'image' => 'required|mimes:jpeg,bmp,png,jpg',
            'body' => 'required'
        ];
    }

    public function messages()
    {
        return [
            'category_id.required' => 'CATEGORIAS não foi selecionado.',
		    'category_id.numeric' => 'CATEGORIAS deve ser numérco.',
            'tag_id.required' => 'TAGS não foi selecionado.',
		    'tag_id.numeric' => 'TAGS deve ser numérco.',
			'title.required' => 'TITULO nao foi selecionado.',
			'title.max' => 'TITULO deve ter no maximo :max caracteres.',
			'image.required' => 'IMAGEM nao foi selecionado.',
			'body.required' => 'CORPO nao foi selecionado.'
        ];
    }
}
