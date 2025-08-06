<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class InsertVisita extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'nome' => 'required|string|max:255',
            'cpf' => 'nullable|string|max:14',
            'rg' => 'nullable|string|max:20',
            'instituicao' => 'nullable|string|max:255',
            'foto' => 'nullable|file|mimes:jpg,jpeg,png,gif|max:10240',  // até 10MB
            'status' => 'nullable|string',
            'telefone' => 'nullable|string|max:20',
            'motivo' => 'nullable|string|max:255',
        ];
    }

    /**
     * Get custom messages for validator errors.
     *
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            'nome.required' => 'O campo nome é obrigatório.',
            'nome.string' => 'O campo nome deve ser um texto.',
            'nome.max' => 'O campo nome não pode ter mais que 255 caracteres.',

            'cpf.string' => 'O campo CPF deve ser um texto.',
            'cpf.max' => 'O campo CPF não pode ter mais que 14 caracteres.',

            'rg.string' => 'O campo RG deve ser um texto.',
            'rg.max' => 'O campo RG não pode ter mais que 20 caracteres.',

            'instituicao.string' => 'O campo instituição deve ser um texto.',
            'instituicao.max' => 'O campo instituição não pode ter mais que 255 caracteres.',

            'foto.file' => 'O campo foto deve ser um arquivo.',
            'foto.mimes' => 'A foto deve ser do tipo: jpg, jpeg, png ou gif.',
            'foto.max' => 'A foto não pode ter mais que 10MB.',

            'status.string' => 'O campo status deve ser um texto.',

            'telefone.string' => 'O campo telefone deve ser um texto.',
            'telefone.max' => 'O campo telefone não pode ter mais que 20 caracteres.',

            'motivo.string' => 'O campo motivo deve ser um texto.',
            'motivo.max' => 'O campo motivo não pode ter mais que 255 caracteres.',
        ];
    }
}
