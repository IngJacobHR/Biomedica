<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LocativeRequest extends FormRequest
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

            'campus_id'=>['required'],
            'location'=>['required'],
            'locativegroups_id'=>['required'],
            'active'=>['required'],
            'locativefails_id'=>['required'],
            'order'=>['required'],
        ];
    }
}
