<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class ProdutoStoreRequest extends FormRequest
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
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'nome' => "required",
            'descricao' => "required",
            'qtd_estoque' => "required | integer",
            'preco' => "required | numeric",
            'importado' => "nullable | boolean"
        ];
    }

    protected function prepareForValidation()
    {
        $this->merge([
            'importado'=>$this->has('importado')
        ]);
    }
}
