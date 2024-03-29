<?php

namespace App\Http\Requests;

use App\Models\Empresa;
use Illuminate\Foundation\Http\FormRequest;

class ProjetoPostRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {

        return auth()->check() &&
                Empresa::find(auth()->user()->empresa_id)->id === auth()->user()->empresa_id;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'titulo' => 'required|string',
            'url_padrao' => 'required|string',
        ];
    }
}
