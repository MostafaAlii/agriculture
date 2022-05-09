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
            'phone'=>'required',
            'email'=>'required',

            'agri_services.*' => [
                'string',
            ],
            'agri_services'   => [
                'sometimes:nullable',
                'array',
            ],
            'agri_t_services.*' => [
                'string',
            ],
            'agri_t_services'   => [
                'sometimes:nullable',
                'array',
            ],
            'water_services.*' => [
                'sometimes:nullable',
            ],
            'water_services'   => [
                'sometimes:nullable',
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
            'village_id.required' => trans('Admin/validation.required'),
            'phone.required' => trans('Admin/validation.required'),
            'email.required' => trans('Admin/validation.required'),


        ];
    }
}