<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TechnologyRequest extends FormRequest
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
                'active'=>['required'],
                'serie'=>['required'],
                'equipment_id'=>['required'],
                'mark'=>['required'],
                'model'=>['required'],
                'location'=>['required'],
                'campus_id'=>['required'],
                'category'=>['required'],
        ];
    }
}
