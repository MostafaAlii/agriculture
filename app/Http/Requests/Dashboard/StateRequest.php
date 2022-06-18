<?php

namespace App\Http\Requests\Dashboard;

use Illuminate\Foundation\Http\FormRequest;

class StateRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [

            'name' => [
                'required',
                'regex:/^[A-Za-z-أ-ي-pL\s\-]+$/u',
                'unique:state_translations,name,state_id'.$this->id,


            ],
            'location_x' => 'numeric|regex:/^[0-9]+(\.[0-9][0-9]?)?$/',
            'location_y' => 'numeric|regex:/^[0-9]+(\.[0-9][0-9]?)?$/',
            'area_id' => 'required|exists:areas,id',
            'name.unique'   => trans('Admin\validation.unique'),



        ];
    }

    public function messages()
    {
        return [
            'name.required' => trans('Admin\validation.required'),
            'location_x.numeric' => trans('Admin\validation.numeric'),
            'location_y.numeric' => trans('Admin\validation.numeric'),
            'area_id.required' => trans('Admin\validation.required'),
            'area_id.exists' => trans('Admin\validation.exists'),

            'name.regex' => trans('Admin\validation.regex'),

        ];
    }
}
