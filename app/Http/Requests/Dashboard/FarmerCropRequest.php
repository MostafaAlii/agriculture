<?php

namespace App\Http\Requests\Dashboard;

use Illuminate\Foundation\Http\FormRequest;

class FarmerCropRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }


    public function rules()
    {
        return [
            'farmer_id' => 'required|exists:farmers,id',
            'admin_id' => 'required',
            'area_id' => 'required',
            'state_id' => 'required',
            'village_id' => 'required|exists:villages,id',

            'land_category_id' => 'required',
            'winter_area_crop' => 'sometimes:nullable',
            'summer_area_crop' =>  'sometimes:nullable',
            'date'=>'required|date',

            'phone'=>'required',
            'email'=>'required',

//            'winter_crops.*' => [
//                'string',
//            ],
//            'winter_crops'   => [
//                'sometimes:nullable',
//                'array',
//            ],
//            'summer_crops.*' => [
//                'string',
//            ],
//            'summer_crops'   => [
////                'required',
//                'sometimes:nullable',
//                'array',
//            ],

        ];
    }

    public function messages()
    {
        return [
//            'winter_crops.*.string'=>trans('Admin/validation.string'),
////            'winter_crops.required'=>trans('Admin/validation.required'),
//            'summer_crops.*.string'=>trans('Admin/validation.string'),
//            'summer_crops.required'=>trans('Admin/validation.required'),
            'summer_area_crop.required' => trans('Admin/validation.required'),
            'winter_area_crop.required' => trans('Admin/validation.required'),
            'date.required' => trans('Admin/validation.required'),

            'farmer_id.required' => trans('Admin/validation.required'),
//            'admin_id.required' => trans('Admin/validation.required'),

            'village_id.required' => trans('Admin/validation.required'),


            'land_category_id.required' => trans('Admin/validation.required'),

            'phone.required' => trans('Admin/validation.required'),
            'email.required' => trans('Admin/validation.required'),


        ];
    }
}