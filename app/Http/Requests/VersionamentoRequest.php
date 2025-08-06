<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class VersionamentoRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'modulo' => 'required|string|max:255',
            'descricao' => 'required|string',
            'versao' => 'required|string|max:50',
        ];
    }

    public function messages()
    {
        return [
            'modulo.required' => 'O campo módulo é obrigatório.',
            'descricao.required' => 'O campo descrição é obrigatório.',
            'versao.required' => 'O campo versão é obrigatório.',
            'modulo.max' => 'O módulo deve ter no máximo 255 caracteres.',
            'versao.max' => 'A versão deve ter no máximo 50 caracteres.',
        ];
    }
}
