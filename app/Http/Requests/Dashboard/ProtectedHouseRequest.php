<?php

namespace App\Http\Requests\Dashboard;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
class ProtectedHouseRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }


    public function rules()
    {
        return [
//            'farmer_id' => [
//                'required',
//                'unique:protected_houses,farmer_id,id'.$this->id,
//                'exists:farmers,id',
//
//
//            ],
            'farmer_id' => [
                'required',
                Rule::unique('protected_houses')->where(function ($query) {
                    $query->where('farmer_id', $this->farmer_id)
                        ->where('supported_side', $this->supported_side);
                })
            ],
            'admin_id' => 'required|exists:admins,id',
            'area_id' => 'required|exists:areas,id',
            'state_id' => 'required|exists:states,id',
            'village_id' => 'required|exists:villages,id',

            'average_product_annual' =>'sometimes:nullable|numeric',
            'count_protected_house' =>'required|numeric',
            'status' => 'required|in:active,inactive',
            'supported_side' => [
                'required',
                'unique:protected_houses,supported_side,id'.$this->id,
                'in:private,govermental,international organizations',


            ],
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