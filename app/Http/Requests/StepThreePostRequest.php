<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StepThreePostRequest extends FormRequest
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
            'step'      => 'required',
            'phone'     => 'required',
            'cellphone' => 'required',
        ];
    }

    /**
     * Get custom messages for validator errors.
     * @return array
     */
    public function messages()
    {
        return [
            'phone.required' => __('Telefone obrigatório'),
            'cellphone.max'  => __('Celular obrigatório'),
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
                'phone' => preg_replace('/[^0-9]/', '', $this->phone),
                'cellphone' => preg_replace('/[^0-9]/', '', $this->cellphone),
            ]
        );
    }
}
