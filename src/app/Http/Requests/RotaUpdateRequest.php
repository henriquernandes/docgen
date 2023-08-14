<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RotaUpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return auth()->user() != null;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'rota' => 'required|string|max:255',
            'titulo' => 'required|string|max:255',
            'descricao' => 'required|string|max:255',
            'projeto_id' => 'required|integer|exists:projetos,id',
            'rota_id' => 'nullable|integer|exists:rotas,id'
        ];
    }
}
