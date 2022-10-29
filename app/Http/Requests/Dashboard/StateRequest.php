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
//                'regex:/^[A-Za-z-أ-ي-pL\s\-\ء]+$/u',
            'string',
                'unique:state_translations,name,area_id'.$this->id,


            ],

            'location_x' => 'numeric',
            'location_y' => 'numeric',
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

            'name.string' => trans('Admin\validation.string'),

        ];
    }
}