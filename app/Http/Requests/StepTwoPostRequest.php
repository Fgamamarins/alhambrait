<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Class StepTwoPostRequest
 * @package App\Http\Requests
 */
class StepTwoPostRequest extends FormRequest
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
            'step'   => 'required',
            'cep'    => 'required',
            'state'  => 'required',
            'city'   => 'required',
            'street' => 'required',
            'number' => 'required',
        ];
    }

    /**
     * Get custom messages for validator errors.
     * @return array
     */
    public function messages()
    {
        return [
            'cep.required'    => __('CEP obrigatório'),
            'state.max'       => __('Estado obrigatório'),
            'city.required'   => __('Cidade obrigatória'),
            'street.required' => __('Rua obrigatória'),
            'number.required' => __('Número obrigatório'),
        ];
    }

    /**
     * Prepare the data for validation.
     * @return void
     */
    protected function prepareForValidation()
    {
        $this->merge(
            [
                'cep' => preg_replace('/[^0-9]/', '', $this->cep),
            ]
        );
    }
}
