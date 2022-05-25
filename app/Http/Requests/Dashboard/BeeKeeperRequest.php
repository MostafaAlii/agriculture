<?php

namespace App\Http\Requests\Dashboard;

use Illuminate\Foundation\Http\FormRequest;

class BeeKeeperRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }


    public function rules()
    {
        return [
            'farmer_id' => 'required|exists:farmers,id',
            'village_id' => 'required|exists:villages,id',
            'cost' => 'required|numeric',
            'admin_id' => 'required',
            'area_id' => 'required',
            'state_id' => 'required',
            'annual_old_product_beehive' =>'required|numeric',
            'annual_new_product_beehive'=>'required|numeric',
            'old_beehive_count' => 'required|numeric',
            'new_beehive_count' => 'required|numeric',
            'supported_side'=>'required',
            'unit_id'=>'required|exists:units,id',
            'phone'=>'required',
            'email'=>'required',
            'died_beehive_count'=>'required|numeric'

        ];
    }

    public function messages()
    {
        return [
            'farmer_id.required' => trans('Admin/validation.required'),
            'admin_id.required' => trans('Admin/validation.required'),
            'area_id.required' => trans('Admin/validation.required'),
            'state_id.required' => trans('Admin/validation.required'),
            'cost.required' => trans('Admin/validation.required'),
            'village_id.required' => trans('Admin/validation.required'),


            'annual_old_product_beehive.required' => trans('Admin/validation.required'),
            'annual_new_product_beehive.required' => trans('Admin/validation.required'),

            'new_beehive_count.required' => trans('Admin/validation.required'),
            'old_beehive_count.required' => trans('Admin/validation.required'),

            'orchard_area.required' => trans('Admin/validation.required'),
            'supported_side_id.required' => trans('Admin/validation.required'),
            'unit_id.required' => trans('Admin/validation.required'),
            'phone.required' => trans('Admin/validation.required'),
            'email.required' => trans('Admin/validation.required'),


        ];
    }
}