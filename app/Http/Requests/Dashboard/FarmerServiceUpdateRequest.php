<?php

namespace App\Http\Requests\Dashboard;

use Illuminate\Foundation\Http\FormRequest;

class FarmerServiceUpdateRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }


    public function rules()
    {
        return[
            'admin_id' =>  'required|exists:admins,id',
            'area_id' =>  'required|exists:areas,id',
            'state_id' =>  'required|exists:states,id',
            'farmer_id' => [
                'required',
                'unique:farmer_services,id'.$this->id,
                'exists:farmers,id',


            ],
            'village_id' => 'required|exists:villages,id',


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
            'admin_id.required' => trans('Admin/validation.required'),
            'area_id.required' => trans('Admin/validation.required'),
            'state_id.required' => trans('Admin/validation.required'),
            'farmer_id.exists' => trans('Admin/validation.exists'),
            'admin_id.exists' => trans('Admin/validation.exists'),
            'area_id.exists' => trans('Admin/validation.exists'),
            'state_id.exists' => trans('Admin/validation.exists'),
            'village_id.exists' => trans('Admin/validation.exists'),


        ];
    }
}