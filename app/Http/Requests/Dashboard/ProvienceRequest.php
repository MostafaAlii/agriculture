<?php

namespace App\Http\Requests\Dashboard;

use Illuminate\Foundation\Http\FormRequest;

class ProvienceRequest extends FormRequest
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
                'unique:province_translations,name,province_id' . $this->id,
                'string'


            ],
            'location_x' => 'numeric|regex:/^[0-9]+(\.[0-9][0-9]?)?$/',
            'location_y' => 'numeric|regex:/^[0-9]+(\.[0-9][0-9]?)?$/',
            'country_id' => 'required|exists:countries,id',
            'name.unique' => trans('Admin\validation.unique'),


        ];
    }

    public function messages()
    {

        return [
            'name.required' => trans('Admin\validation.required'),
            'name.string' => trans('Admin\validation.string'),
            'location_x.numeric' => trans('Admin\validation.numeric'),
            'location_y.numeric' => trans('Admin\validation.numeric'),
            'country_id.required' => trans('Admin\validation.required'),
            'country_id.exists' => trans('Admin\validation.exists'),

        ];
    }
}
