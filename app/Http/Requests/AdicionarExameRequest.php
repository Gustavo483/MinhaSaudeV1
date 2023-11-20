<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AdicionarExameRequest extends FormRequest
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
            "st_especialidade"=> ['required', 'min:20'],
            "st_descricao"=> ['required'],
            "st_nome_medico"=> ['required'],
            "st_localizacao"=> ['required'],
            "dt_data"=> ['required']
        ];
    }
}
