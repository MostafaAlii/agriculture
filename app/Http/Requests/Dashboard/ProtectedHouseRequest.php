<?php

namespace App\Http\Requests\Dashboard;

use Illuminate\Foundation\Http\FormRequest;

class ProtectedHouseRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }


    public function rules()
    {
        return [
            'farmer_id' => 'required|exists:farmers,id',
//            'admin_id' => 'required|exists:admins,id',
            'village_id' => 'required|exists:villages,id',
            'area_id' => 'required|exists:areas,id',
            'state_id' => 'required|exists:states,id',
            'admin_department_id' => 'required',
            'average_product_annual' =>'required|numeric',
            'status' => 'required',
            'supported_side_id'=>'required|exists:supported_sides,id',
            'unit_id'=>'required|exists:units,id',
            'phone'=>'required',
            'email'=>'required',

        ];
    }

    public function messages()
    {
        return [
            'farmer_id.required' => trans('Admin/validation.required'),
//            'admin_id.required' => trans('Admin/validation.required'),
            'area_id.required' => trans('Admin/validation.required'),
            'state_id.required' => trans('Admin/validation.required'),
            'village_id.required' => trans('Admin/validation.required'),
            'average_product_annual.required' => trans('Admin/validation.required'),
            'status.required' => trans('Admin/validation.required'),

            'admin_department_id.required' => trans('Admin/validation.required'),
            'land_category_id.required' => trans('Admin/validation.required'),
            'tree_count_per_orchard.required' => trans('Admin/validation.required'),
            'orchard_area.required' => trans('Admin/validation.required'),
            'supported_side_id.required' => trans('Admin/validation.required'),
            'unit_id.required' => trans('Admin/validation.required'),
            'phone.required' => trans('Admin/validation.required'),
            'email.required' => trans('Admin/validation.required'),


        ];
    }
}