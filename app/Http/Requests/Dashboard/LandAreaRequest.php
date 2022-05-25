<?php

namespace App\Http\Requests\Dashboard;

use Illuminate\Foundation\Http\FormRequest;

class LandAreaRequest extends FormRequest
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
            'village_id' => 'required|exists:villages,id',
            'L_area' =>'required|numeric',
            'land_category_id' => 'required|exists:land_categories,id',
            'unit_id'=>'required|exists:units,id',


        ];
    }

    public function messages()
    {
        return [

            'area_id.required' => trans('Admin/validation.required'),
            'village_id.required' => trans('Admin/validation.required'),
            'state_id.required' => trans('Admin/validation.required'),
            'L_area.required' => trans('Admin/validation.required'),
            'land_category_id.required' => trans('Admin/validation.required'),
            'unit_id.required' => trans('Admin/validation.required'),


        ];
    }
}