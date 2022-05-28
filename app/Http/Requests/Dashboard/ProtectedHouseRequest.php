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
            'status' => 'required',
            'supported_side'=>'required',
            'unit_id'=>'required|exists:units,id',
            'phone'        => 'required_with:email|string|regex:/^([0-9\s\-\+\(\)]*)$/|min:10|max:11|unique:farmers',
            'email'        => 'required|email|unique:farmers',

        ];
    }

    public function messages()
    {
        return [
            'farmer_id.required' => trans('Admin/validation.required'),
//           'admin_id.required' => trans('Admin/validation.required'),
            'count_protected_house.required'=>trans('Admin/validation.required'),
            'village_id.required' => trans('Admin/validation.required'),
            'average_product_annual.required' => trans('Admin/validation.required'),
            'status.required' => trans('Admin/validation.required'),
            'supported_side.required' => trans('Admin/validation.required'),
            'unit_id.required' => trans('Admin/validation.required'),
            'phone.required' => trans('Admin/validation.required'),
            'email.required' => trans('Admin/validation.required'),


        ];
    }
}