<?php

namespace App\Http\Requests\Dashboard;

use Illuminate\Foundation\Http\FormRequest;

class OrchardRequest extends FormRequest
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

            'land_category_id' => 'required',
            'tree_count_per_orchard' =>'required|numeric',
            'orchard_area' => 'required|numeric',
            'supported_side'=>'required|in:govermental,international_organizations,private',
            'unit_id'=>'required|exists:units,id',

        ];
    }

    public function messages()
    {
        return [
            'farmer_id.required' => trans('Admin/validation.required'),
            'admin_id.required' => trans('Admin/validation.required'),
            'area_id.required' => trans('Admin/validation.required'),
            'state_id.required' => trans('Admin/validation.required'),
            'village_id.required' => trans('Admin/validation.required'),

            'farmer_id.exists' => trans('Admin/validation.exists'),
            'admin_id.exists' => trans('Admin/validation.exists'),
            'area_id.exists' => trans('Admin/validation.exists'),
            'state_id.exists' => trans('Admin/validation.exists'),
            'village_id.exists' => trans('Admin/validation.exists'),
            'unit_id.exists' => trans('Admin/validation.exists'),
            'tree_count_per_orchard' => trans('Admin/validation.required'),

            'land_category_id.required' => trans('Admin/validation.required'),
            'tree_count_per_orchard.required' => trans('Admin/validation.required'),
            'orchard_area.required' => trans('Admin/validation.required'),
            'supported_side.required' => trans('Admin/validation.required'),
            'unit_id.required' => trans('Admin/validation.required'),


        ];
    }
}