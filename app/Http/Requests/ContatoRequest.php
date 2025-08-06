<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ContatoRequest extends FormRequest
{
    public function authorize()
    {
        return true;  
    }

    public function rules()
    {
        return [
            'nome' => 'required|string|max:150',
            'telefone' => 'nullable|string|max:30',
            'email' => 'required|email|max:150',
            'assunto' => 'required|string|max:150',
            'descricao' => 'required|string',
        ];
    }

    public function messages()
    {
        return [
            'nome.required' => 'O campo nome é obrigatório.',
            'email.required' => 'O campo email é obrigatório.',
            'email.email' => 'Informe um email válido.',
            'assunto.required' => 'O campo assunto é obrigatório.',
            'descricao.required' => 'O campo descrição é obrigatório.',
        ];
    }
}
