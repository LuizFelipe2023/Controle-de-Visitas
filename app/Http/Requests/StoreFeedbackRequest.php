<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreFeedbackRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true; 
    }

    public function rules(): array
    {
        return [
            'nome' => 'required|string|max:255',
            'cpf' => 'required|string|size:14',
            'nivel_satisfacao' => 'required|integer|min:1|max:5',
            'visita_id' => 'nullable|exists:visitas,id',
        ];
    }

    public function messages(): array
    {
        return [
            'nome.required' => 'O campo nome é obrigatório.',
            'nome.string' => 'O nome deve ser um texto.',
            'nome.max' => 'O nome não pode ter mais que 255 caracteres.',

            'cpf.required' => 'O campo CPF é obrigatório.',
            'cpf.string' => 'O CPF deve ser uma sequência de texto.',
            'cpf.size' => 'O CPF deve ter exatamente 14 caracteres (formato 000.000.000-00).',

            'nivel_satisfacao.required' => 'Você precisa informar o nível de satisfação.',
            'nivel_satisfacao.integer' => 'O nível de satisfação deve ser um número.',
            'nivel_satisfacao.min' => 'O nível de satisfação mínimo é 1.',
            'nivel_satisfacao.max' => 'O nível de satisfação máximo é 5.',

            'visita_id.exists' => 'A visita selecionada não foi encontrada.',
        ];
    }
}
