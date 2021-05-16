<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Class StepOnePostRequest
 * @package App\Http\Requests
 */
class StepOnePostRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     * @return array
     */
    public function rules()
    {
        return [
            'full_name'  => 'required|max:50',
            'birth_date' => 'required',
            'step'       => 'required',
        ];
    }

    /**
     * Get custom messages for validator errors.
     * @return array
     */
    public function messages()
    {
        return [
            'full_name.required'  => __('Nome obrigatório'),
            'full_name.max'       => __('Nome deve conter no máximo 50 caracteres'),
            'birth_date.required' => __('Data de Nascimento obrigatória'),
        ];
    }
}
