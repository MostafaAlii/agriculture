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
            'admin_id' => 'required|exists:admins,id',
            'area_id' => 'required|exists:areas,id',
            'state_id' => 'required|exists:states,id',
            'village_id' => 'required|exists:villages,id',

            'average_product_annual' =>'sometimes:nullable|numeric',
            'count_protected_house' =>'required|numeric',
            'status' => 'required|in:active,inactive',
            'supported_side'=>'required|in:private,govermental,international organizations',
            'unit_id'=>'required|exists:units,id',

        ];
    }

    public function messages()
    {
        return [
            'farmer_id.required' => trans('Admin/validation.required'),
           'admin_id.required' => trans('Admin/validation.required'),
            'count_protected_house.required'=>trans('Admin/validation.required'),
            'village_id.required' => trans('Admin/validation.required'),
            'average_product_annual.required' => trans('Admin/validation.required'),
            'status.required' => trans('Admin/validation.required'),
            'supported_side.required' => trans('Admin/validation.required'),
            'unit_id.required' => trans('Admin/validation.required'),



        ];
    }
}