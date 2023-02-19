<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class Maximini extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'max' => 'required|greater_than_field:min',
            'min' => 'required|smaller_than_field:max',
        ];
    }

public function messages()
{
    return [
        'max.greater_than_field'   => 'El numero debe ser mayor que el valor minimo',
        'min.smaller_than_field'   => 'El numero debe ser menor que el valor maximo',
        'max.required'   => 'El valor es obligatorio',
        'min.required'   => 'El valor es obligatorio',
    ];
}
}
