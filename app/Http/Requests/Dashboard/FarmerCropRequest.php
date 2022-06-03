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
            'area_id'         => 'required|exists:areas,id',
            'state_id'        => 'required|exists:states,id',
            'admin_id'        => 'required|exists:admins,id',
            'farmer_id'            => 'required|exists:farmers,id',
            'village_id'      => 'required|exists:villages,id',

            'land_category_id' => 'required|exists:land_categories,id',
            'winter_area_crop' => 'sometimes:nullable',
            'summer_area_crop' =>  'sometimes:nullable',
            'date'=>'required|date',

            'phone'        => 'required|string|regex:/^([0-9\s\-\+\(\)]*)$/|min:10|max:11',
            'email'        => 'required|email',

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

            'admin_id.required' => trans('Admin/validation.required'),
            'farmer_id.required' => trans('Admin/validation.required'),
            'area_id.required' => trans('Admin/validation.required'),
            'state_id.required' => trans('Admin/validation.required'),
            'village_id.required' => trans('Admin/validation.required'),
            'farmer_id.exists' => trans('Admin/validation.exists'),
            'admin_id.exists' => trans('Admin/validation.exists'),
            'area_id.exists' => trans('Admin/validation.exists'),
            'state_id.exists' => trans('Admin/validation.exists'),
            'village_id.exists' => trans('Admin/validation.exists'),


            'land_category_id.required' => trans('Admin/validation.required'),

            'phone.required' => trans('Admin/validation.required'),
            'email.required' => trans('Admin/validation.required'),


        ];
    }
}