<?php

namespace App\Http\Requests\Dashboard;

use Illuminate\Foundation\Http\FormRequest;

class FarmerServiceRequest extends FormRequest
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
            'area_id' => 'required|exists:areas,id',
            'state_id' => 'required|exists:states,id',
            'admin_department_id' => 'required',

            'phone'=>'required',
            'email'=>'required',

            'agri_services.*' => [
                'string',
            ],
            'agri_services'   => [
                'required',
                'array',
            ],
            'agrit_services.*' => [
                'string',
            ],
            'agrit_services'   => [
                'required',
                'array',
            ],
            'water_services.*' => [
                'string',
            ],
            'water_services'   => [
                'required',
                'array',
            ],

        ];
    }

    public function messages()
    {
        return [
            'agri_services.*.string'=>trans('Admin/validation.string'),
            'agri_services.required'=>trans('Admin/validation.required'),
            'water_services.*.string'=>trans('Admin/validation.string'),
            'water_services.required'=>trans('Admin/validation.required'),
            'agrit_services.*.string'=>trans('Admin/validation.string'),
            'agrit_services.required'=>trans('Admin/validation.required'),
            'farmer_id.required' => trans('Admin/validation.required'),
            'area_id.required' => trans('Admin/validation.required'),
            'state_id.required' => trans('Admin/validation.required'),
            'village_id.required' => trans('Admin/validation.required'),


            'admin_department_id.required' => trans('Admin/validation.required'),
            'tree_count_per_orchard.required' => trans('Admin/validation.required'),
            'orchard_area.required' => trans('Admin/validation.required'),
            'supported_side_id.required' => trans('Admin/validation.required'),
            'unit_id.required' => trans('Admin/validation.required'),
            'phone.required' => trans('Admin/validation.required'),
            'email.required' => trans('Admin/validation.required'),


        ];
    }
}