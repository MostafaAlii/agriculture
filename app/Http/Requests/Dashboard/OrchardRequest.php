<?php

namespace App\Http\Requests\Dashboard;

use Illuminate\Foundation\Http\FormRequest;

class OrchardRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }


    public function rules()
    {
        return [
            'farmer_id' => 'required|exists:farmers,id',
            'admin_id' => 'required|exists:admins,id',
            'area_id' => 'required|exists:areas,id',
            'state_id' => 'required|exists:states,id',
            'village_id' => 'required|exists:villages,id',

            'land_category_id' => 'required',
            'tree_count_per_orchard' =>'required|numeric',
            'orchard_area' => 'required|string',
            'supported_side'=>'required',
            'unit_id'=>'required|exists:units,id',
            'phone'=>'required',
            'email'=>'required',

        ];
    }

    public function messages()
    {
        return [
            'farmer_id.required' => trans('Admin/validation.required'),
            'admin_id.required' => trans('Admin/validation.required'),
            'area_id.required' => trans('Admin/validation.required'),
            'state_id.required' => trans('Admin/validation.required'),
            'village_id.required' => trans('Admin/validation.required'),

            'land_category_id.required' => trans('Admin/validation.required'),
            'tree_count_per_orchard.required' => trans('Admin/validation.required'),
            'orchard_area.required' => trans('Admin/validation.required'),
            'supported_side.required' => trans('Admin/validation.required'),
            'unit_id.required' => trans('Admin/validation.required'),
            'phone.required' => trans('Admin/validation.required'),
            'email.required' => trans('Admin/validation.required'),


        ];
    }
}