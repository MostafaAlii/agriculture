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

            'average_product_annual' =>'sometimes:nullable|numeric',
            'protected_house_count' =>'required|numeric',
            'status' => 'required',
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
//           'admin_id.required' => trans('Admin/validation.required'),
            'protected_house_count.required'=>trans('Admin/validation.required'),
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