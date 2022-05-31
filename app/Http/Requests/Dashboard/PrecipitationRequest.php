<?php

namespace App\Http\Requests\Dashboard;

use Illuminate\Foundation\Http\FormRequest;

class PrecipitationRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }


    public function rules()
    {
        return [
            'admin_id' => 'required|exists:admins,id',
            'area_id' => 'required|exists:areas,id',
            'state_id' => 'required|exists:states,id',
//            'admin_department_id' => 'required|exists:admin_departments',

            'precipitation_rate' =>'required|numeric',
            'date' => 'required|date',
            'unit_id'=>'required|exists:units,id',


        ];
    }

    public function messages()
    {
        return [

            'admin_id.required' => trans('Admin/validation.required'),
            'area_id.required' => trans('Admin/validation.required'),
            'state_id.required' => trans('Admin/validation.required'),
            'admin_id.exists' => trans('Admin/validation.exists'),
            'area_id.exists' => trans('Admin/validation.exists'),
            'state_id.exists' => trans('Admin/validation.exists'),
            'precipitation_rate.required' => trans('Admin/validation.required'),
            'date.required' => trans('Admin/validation.required'),
            'unit_id.required' => trans('Admin/validation.required'),
            'unit_id.exists' => trans('Admin/validation.exists'),


        ];
    }
}