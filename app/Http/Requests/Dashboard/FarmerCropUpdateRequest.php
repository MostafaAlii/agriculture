<?php

namespace App\Http\Requests\Dashboard;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class FarmerCropUpdateRequest extends FormRequest
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
            'farmer_id' => [
                'required',
                'unique:farmer_crops,id'.$this->id,
                'exists:farmers,id',


            ],
            'village_id'      => 'required|exists:villages,id',
            'land_category_id' => [
                'required',
                'unique:farmer_crops,land_category_id,id'.$this->id,
                'exists:land_categories,id',


            ],
            'land_category_id' => 'required|exists:land_categories,id',
            'winter_area_crop' => 'sometimes:nullable|numeric',
            'summer_area_crop' =>  'sometimes:nullable|numeric',
//            'date'=>'required|date',
            'date' => [
                'required',
                'unique:farmer_crops,id'.$this->id,
                'date',


            ],


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